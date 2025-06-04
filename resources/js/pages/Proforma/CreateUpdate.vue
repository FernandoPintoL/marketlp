<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { onMounted, reactive, ref, computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import AlertService from '@/Services/AlertService.js';
import Loader from '@/Componentes/Loader.vue';
import axios from 'axios';

const props = defineProps({
    isEditing: {
        type: Boolean,
        default: false
    },
    proforma: {
        type: Object,
        default: null
    },
    auth: Object
});

const breadcrumbs = computed(() => {
    const items: BreadcrumbItem[] = [
        {
            title: 'Proformas',
            href: '/proforma',
        }
    ];

    if (props.isEditing) {
        items.push({
            title: 'Editar Proforma',
            href: `/proforma/${props.proforma.id}/edit`,
        });
    } else {
        items.push({
            title: 'Nueva Proforma',
            href: '/proforma/create',
        });
    }

    return items;
});

const userType = ref('customer'); // 'customer' or 'cashier'
const isLoading = ref(false);
const clientes = ref([]);
const items = ref([]);
const monedas = ref([]);
const tiposProforma = ref([]);

// Form for the proforma
const form = useForm({
    codigo: '',
    fecha: new Date().toISOString().split('T')[0],
    fecha_validez: new Date(new Date().setDate(new Date().getDate() + 30)).toISOString().split('T')[0], // 30 days validity
    total: 0,
    cambio: 0,
    descuento: 0,
    estado: 'pendiente',
    observaciones: '',
    tasa_cambio: 1,
    total_moneda_origen: 0,
    moneda_id: null,
    cliente_id: null,
    empleado_id: null,
    tipo_proforma_id: null,
    detalles: []
});

// Item being added to the proforma
const currentItem = reactive({
    item_id: null,
    item: null,
    cantidad: 1,
    precio_unitario: 0,
    subtotal: 0,
    descuento: 0,
    total: 0
});

onMounted(async () => {
    isLoading.value = true;

    try {
        // Check if user has cashier role
        if (props.auth && props.auth.user && props.auth.user.roles) {
            const roles = props.auth.user.roles;
            if (roles.some(role => role.name === 'cajero' || role.name === 'admin')) {
                userType.value = 'cashier';
            }
        }

        // Load necessary data
        await Promise.all([
            loadClientes(),
            loadItems(),
            loadMonedas(),
            loadTiposProforma()
        ]);

        // If editing, populate the form
        if (props.isEditing && props.proforma) {
            populateForm();
        } else {
            // Generate a new code for the proforma
            form.codigo = generateCode();
        }
    } catch (error) {
        console.error('Error loading data:', error);
        AlertService.error('Error al cargar los datos necesarios');
    } finally {
        isLoading.value = false;
    }
});

const loadClientes = async () => {
    try {
        const response = await axios.post('/cliente/query', { per_page: 100 });
        if (response.data.isSuccess) {
            clientes.value = response.data.data.data;
        }
    } catch (error) {
        console.error('Error loading clientes:', error);
    }
};

const loadItems = async () => {
    try {
        const response = await axios.post('/item/query', { per_page: 100 });
        if (response.data.isSuccess) {
            items.value = response.data.data.data;
        }
    } catch (error) {
        console.error('Error loading items:', error);
    }
};

const loadMonedas = async () => {
    try {
        const response = await axios.post('/moneda/query', { per_page: 100 });
        if (response.data.isSuccess) {
            monedas.value = response.data.data.data;
            // Set default moneda if available
            if (monedas.value.length > 0 && !form.moneda_id) {
                form.moneda_id = monedas.value[0].id;
            }
        }
    } catch (error) {
        console.error('Error loading monedas:', error);
    }
};

const loadTiposProforma = async () => {
    try {
        const response = await axios.post('/tipo-proforma/query', { per_page: 100 });
        if (response.data.isSuccess) {
            tiposProforma.value = response.data.data.data;
            // Set default tipo proforma if available
            if (tiposProforma.value.length > 0 && !form.tipo_proforma_id) {
                form.tipo_proforma_id = tiposProforma.value[0].id;
            }
        }
    } catch (error) {
        console.error('Error loading tipos de proforma:', error);
    }
};

const populateForm = () => {
    const proforma = props.proforma;

    form.codigo = proforma.codigo;
    form.fecha = proforma.fecha;
    form.fecha_validez = proforma.fecha_validez;
    form.total = proforma.total;
    form.cambio = proforma.cambio;
    form.descuento = proforma.descuento;
    form.estado = proforma.estado;
    form.observaciones = proforma.observaciones;
    form.tasa_cambio = proforma.tasa_cambio;
    form.total_moneda_origen = proforma.total_moneda_origen;
    form.moneda_id = proforma.moneda_id;
    form.cliente_id = proforma.cliente_id;
    form.empleado_id = proforma.empleado_id;
    form.tipo_proforma_id = proforma.tipo_proforma_id;

    // Load detalles
    if (proforma.detalles && proforma.detalles.length > 0) {
        form.detalles = proforma.detalles.map(detalle => ({
            item_id: detalle.item_id,
            item: detalle.item,
            cantidad: detalle.cantidad,
            precio_unitario: detalle.precio_unitario,
            subtotal: detalle.subtotal,
            descuento: detalle.descuento,
            total: detalle.total
        }));
    }
};

const generateCode = () => {
    const date = new Date();
    const year = date.getFullYear().toString().substr(-2);
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const day = date.getDate().toString().padStart(2, '0');
    const random = Math.floor(Math.random() * 10000).toString().padStart(4, '0');

    return `P${year}${month}${day}-${random}`;
};

const selectItem = (itemId) => {
    const item = items.value.find(i => i.id === itemId);
    if (item) {
        currentItem.item_id = item.id;
        currentItem.item = item;

        // Get the price from the first price item (assuming it's the default price)
        if (item.precioItems && item.precioItems.length > 0) {
            currentItem.precio_unitario = item.precioItems[0].precio;
        }

        calculateItemTotal();
    }
};

const calculateItemTotal = () => {
    currentItem.subtotal = currentItem.cantidad * currentItem.precio_unitario;
    currentItem.total = currentItem.subtotal - currentItem.descuento;
};

const addItemToProforma = () => {
    if (!currentItem.item_id) {
        AlertService.error('Debe seleccionar un producto');
        return;
    }

    if (currentItem.cantidad <= 0) {
        AlertService.error('La cantidad debe ser mayor a 0');
        return;
    }

    // Add the item to the detalles array
    form.detalles.push({
        item_id: currentItem.item_id,
        item: currentItem.item,
        cantidad: currentItem.cantidad,
        precio_unitario: currentItem.precio_unitario,
        subtotal: currentItem.subtotal,
        descuento: currentItem.descuento,
        total: currentItem.total
    });

    // Reset the current item
    currentItem.item_id = null;
    currentItem.item = null;
    currentItem.cantidad = 1;
    currentItem.precio_unitario = 0;
    currentItem.subtotal = 0;
    currentItem.descuento = 0;
    currentItem.total = 0;

    // Recalculate the total
    calculateTotal();
};

const removeItemFromProforma = (index) => {
    form.detalles.splice(index, 1);
    calculateTotal();
};

const calculateTotal = () => {
    let total = 0;
    let descuento = 0;

    form.detalles.forEach(detalle => {
        total += detalle.total;
        descuento += detalle.descuento;
    });

    form.total = total;
    form.descuento = descuento;
    form.total_moneda_origen = total / form.tasa_cambio;
};

const handleSubmit = () => {
    if (form.detalles.length === 0) {
        AlertService.error('Debe agregar al menos un producto a la proforma');
        return;
    }

    if (!form.cliente_id) {
        AlertService.error('Debe seleccionar un cliente');
        return;
    }

    if (!form.moneda_id) {
        AlertService.error('Debe seleccionar una moneda');
        return;
    }

    if (!form.tipo_proforma_id) {
        AlertService.error('Debe seleccionar un tipo de proforma');
        return;
    }

    // If cashier, set the employee_id to the current user's employee
    if (userType.value === 'cashier' && props.auth && props.auth.user) {
        // This would need to be adjusted based on how employees are linked to users
        // form.empleado_id = props.auth.user.empleado_id;
    }

    if (props.isEditing) {
        form.put(route('proforma.update', props.proforma.id), {
            onSuccess: () => {
                AlertService.success('Proforma actualizada exitosamente');
                window.location.href = route('proforma.index');
            },
            onError: (errors) => {
                console.error('Error updating proforma:', errors);
                AlertService.error('Error al actualizar la proforma');
            }
        });
    } else {
        form.post(route('proforma.store'), {
            onSuccess: () => {
                AlertService.success('Proforma creada exitosamente');
                window.location.href = route('proforma.index');
            },
            onError: (errors) => {
                console.error('Error creating proforma:', errors);
                AlertService.error('Error al crear la proforma');
            }
        });
    }
};

const formatCurrency = (value) => {
    if (!value) return '0.00';
    return parseFloat(value).toFixed(2);
};
</script>

<template>
    <Head :title="isEditing ? 'Editar Proforma' : 'Nueva Proforma'" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">{{ isEditing ? 'Editar Proforma' : 'Nueva Proforma' }}</h1>
                <div class="flex gap-2">
                    <Link :href="route('proforma.index')" class="btn btn-secondary">
                        Volver
                    </Link>
                </div>
            </div>

            <Loader v-if="isLoading" />

            <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left column - Proforma details -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Detalles de la Proforma</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="form-group">
                            <label for="codigo" class="form-label">Código</label>
                            <input
                                type="text"
                                id="codigo"
                                v-model="form.codigo"
                                class="form-input"
                                readonly
                            />
                        </div>

                        <div class="form-group">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input
                                type="date"
                                id="fecha"
                                v-model="form.fecha"
                                class="form-input"
                            />
                        </div>

                        <div class="form-group">
                            <label for="fecha_validez" class="form-label">Fecha de Validez</label>
                            <input
                                type="date"
                                id="fecha_validez"
                                v-model="form.fecha_validez"
                                class="form-input"
                            />
                        </div>

                        <div class="form-group">
                            <label for="cliente" class="form-label">Cliente</label>
                            <select
                                id="cliente"
                                v-model="form.cliente_id"
                                class="form-input"
                            >
                                <option value="">Seleccione un cliente</option>
                                <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
                                    {{ cliente.nombre }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tipo_proforma" class="form-label">Tipo de Proforma</label>
                            <select
                                id="tipo_proforma"
                                v-model="form.tipo_proforma_id"
                                class="form-input"
                            >
                                <option value="">Seleccione un tipo de proforma</option>
                                <option v-for="tipoProforma in tiposProforma" :key="tipoProforma.id" :value="tipoProforma.id">
                                    {{ tipoProforma.nombre }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="moneda" class="form-label">Moneda</label>
                            <select
                                id="moneda"
                                v-model="form.moneda_id"
                                class="form-input"
                            >
                                <option value="">Seleccione una moneda</option>
                                <option v-for="moneda in monedas" :key="moneda.id" :value="moneda.id">
                                    {{ moneda.nombre }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tasa_cambio" class="form-label">Tasa de Cambio</label>
                            <input
                                type="number"
                                id="tasa_cambio"
                                v-model="form.tasa_cambio"
                                class="form-input"
                                step="0.01"
                                min="0.01"
                                @input="calculateTotal"
                            />
                        </div>

                        <div class="form-group">
                            <label for="estado" class="form-label">Estado</label>
                            <select
                                id="estado"
                                v-model="form.estado"
                                class="form-input"
                            >
                                <option value="pendiente">Pendiente</option>
                                <option value="aprobado">Aprobado</option>
                                <option value="rechazado">Rechazado</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea
                                id="observaciones"
                                v-model="form.observaciones"
                                class="form-input"
                                rows="2"
                            ></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="form-group">
                            <label class="form-label">Total</label>
                            <div class="form-value">{{ formatCurrency(form.total) }}</div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Descuento</label>
                            <div class="form-value">{{ formatCurrency(form.descuento) }}</div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="handleSubmit"
                        >
                            {{ isEditing ? 'Actualizar Proforma' : 'Crear Proforma' }}
                        </button>
                    </div>
                </div>

                <!-- Right column - Items -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-4">Productos</h2>

                    <div class="grid grid-cols-1 gap-4 mb-4">
                        <div class="form-group">
                            <label for="item" class="form-label">Producto</label>
                            <select
                                id="item"
                                v-model="currentItem.item_id"
                                class="form-input"
                                @change="selectItem(currentItem.item_id)"
                            >
                                <option value="">Seleccione un producto</option>
                                <option v-for="item in items" :key="item.id" :value="item.id">
                                    {{ item.nombre }}
                                </option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="form-group">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input
                                    type="number"
                                    id="cantidad"
                                    v-model="currentItem.cantidad"
                                    class="form-input"
                                    min="1"
                                    step="1"
                                    @input="calculateItemTotal"
                                />
                            </div>

                            <div class="form-group">
                                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                                <input
                                    type="number"
                                    id="precio_unitario"
                                    v-model="currentItem.precio_unitario"
                                    class="form-input"
                                    step="0.01"
                                    min="0"
                                    @input="calculateItemTotal"
                                />
                            </div>

                            <div class="form-group">
                                <label for="descuento_item" class="form-label">Descuento</label>
                                <input
                                    type="number"
                                    id="descuento_item"
                                    v-model="currentItem.descuento"
                                    class="form-input"
                                    step="0.01"
                                    min="0"
                                    @input="calculateItemTotal"
                                />
                            </div>

                            <div class="form-group">
                                <label for="total_item" class="form-label">Total</label>
                                <div class="form-value">{{ formatCurrency(currentItem.total) }}</div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                @click="addItemToProforma"
                            >
                                Agregar Producto
                            </button>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-2">Productos Agregados</h3>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 text-left">Producto</th>
                                        <th class="px-4 py-2 text-right">Cantidad</th>
                                        <th class="px-4 py-2 text-right">Precio</th>
                                        <th class="px-4 py-2 text-right">Subtotal</th>
                                        <th class="px-4 py-2 text-right">Descuento</th>
                                        <th class="px-4 py-2 text-right">Total</th>
                                        <th class="px-4 py-2 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(detalle, index) in form.detalles" :key="index" class="border-b">
                                        <td class="px-4 py-2">{{ detalle.item ? detalle.item.nombre : 'N/A' }}</td>
                                        <td class="px-4 py-2 text-right">{{ detalle.cantidad }}</td>
                                        <td class="px-4 py-2 text-right">{{ formatCurrency(detalle.precio_unitario) }}</td>
                                        <td class="px-4 py-2 text-right">{{ formatCurrency(detalle.subtotal) }}</td>
                                        <td class="px-4 py-2 text-right">{{ formatCurrency(detalle.descuento) }}</td>
                                        <td class="px-4 py-2 text-right">{{ formatCurrency(detalle.total) }}</td>
                                        <td class="px-4 py-2 text-center">
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger"
                                                @click="removeItemFromProforma(index)"
                                            >
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="form.detalles.length === 0">
                                        <td colspan="7" class="px-4 py-2 text-center">No hay productos agregados</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.btn {
    @apply px-4 py-2 rounded-md text-white font-medium;
}
.btn-primary {
    @apply bg-blue-600 hover:bg-blue-700;
}
.btn-secondary {
    @apply bg-green-600 hover:bg-green-700;
}
.btn-sm {
    @apply px-2 py-1 text-sm;
}
.btn-danger {
    @apply bg-red-500 hover:bg-red-600;
}
.form-group {
    @apply mb-4;
}
.form-label {
    @apply block text-sm font-medium text-gray-700 mb-1;
}
.form-input {
    @apply block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm;
}
.form-value {
    @apply block w-full py-2 px-3 bg-gray-100 rounded-md text-gray-700 font-medium;
}
</style>
