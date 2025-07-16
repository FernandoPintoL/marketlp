<script setup lang="ts">
import HeaderForm from '@/Componentes/Header-Form.vue';
import type { Categoria } from '@/Data/Categoria';
import type { Unidad } from '@/Data/Unidad';
import AlertService from '@/Services/AlertService.js';
import { ItemNegocio } from '@/Negocio/ItemNegocio';
import UtilsServices from '@/Services/UtilsServices';
import InputError from '@/components/InputError.vue';
import SelectSearch from '@/components/SelectSearch.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import QRCode from '@chenfengyuan/vue-qrcode';
import { Head, useForm } from '@inertiajs/vue3';
import { Barcode, DiamondPlus, Pencil, QrCode } from 'lucide-vue-next';
import { onMounted, reactive, ref } from 'vue';
import { route } from 'ziggy-js';
import { Item } from '@/Data/Item';

const negocio = new ItemNegocio();
const model_path = negocio.model;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: model_path.toUpperCase(),
        href: '/' + model_path,
    },
];

const props = defineProps({
    model: Object,
    isCreate: {
        type: Boolean,
        default: false, // Valor por defecto puede ser true o false
    },
    crear: {
        type: Boolean,
        default: false, // Valor por defecto puede ser true o false
    },
    editar: {
        type: Boolean,
        default: false, // Valor por defecto puede ser true o false
    },
    eliminar: {
        type: Boolean,
        default: false, // Valor por defecto puede ser true o false
    },
});

const datas = reactive({
    isLoad: false,
    cod_barraError: '',
    nameError: '',
    descripcionError: '',
    photo_pathError: '',
    categoria_idError: '',
    unidad_idError: '',
    generalError: '',
    categorias: [] as Array<Categoria>,
    unidades: [] as Array<Unidad>,
    photoPreview: null as string | null,
    maxFileSize: 1024, // 1MB in KB
    showQRCode: false,
    showBarcode: false,
    qrValue: '',
    barcodeValue: '',
});

// Refs for barcode and QR code functionality
const qrCodeRef = ref(null);
const barcodeRef = ref(null);

const form = useForm<{
    id: string | number | null;
    cod_barra: string;
    name: string;
    descripcion: string;
    photo_path: File | string | null;
    categoria_id: number | string | null;
    unidad_id: string | number | null;
    current_photo: string | null;
}>({
    id: props.model != null ? props.model.id : '',
    cod_barra: props.model != null ? props.model.cod_barra : '',
    name: props.model != null ? props.model.name : '',
    descripcion: props.model != null ? props.model.descripcion : '',
    photo_path: null,
    categoria_id: props.model != null ? props.model.categoria_id : '',
    unidad_id: props.model != null ? props.model.unidad_id : '',
    current_photo: props.model != null ? props.model.photo_path : null,
});

let item : Item;
function cargarModel(){
    item = {
        id: Number(form.id) ?? 0,
        name: form.name,
        descripcion: form.descripcion,
        categoria_id: Number(form.categoria_id) ?? 0,
        unidad_id: Number(form.unidad_id) ?? 0,
    };
}

onMounted(() => {
    if (props.model != null) {
        form.id = props.model.id;
        form.cod_barra = props.model.cod_barra;
        form.name = props.model.name;
        form.descripcion = props.model.descripcion;
        form.categoria_id = props.model.categoria_id;
        form.unidad_id = props.model.unidad_id;
        form.current_photo = props.model.photo_path;

        // If there's a barcode, set it as the barcode value
        if (form.cod_barra) {
            datas.barcodeValue = form.cod_barra;
        }
    }

    // Load categorias and unidades for dropdowns
    loadCategorias();
    loadUnidades();

    // Load jsbarcode script dynamically
    const script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js';
    script.async = true;
    script.onload = () => {
        // Initialize barcode if value exists
        if (datas.barcodeValue && barcodeRef.value) {
            try {
                // Choose appropriate format based on input
                let format = 'CODE128'; // Default format that accepts any length
                let barcodeValue = datas.barcodeValue;

                // If it's a numeric value and either 12 or 13 digits, use EAN13
                if (/^\d+$/.test(barcodeValue)) {
                    if (barcodeValue.length === 13) {
                        format = 'EAN13';
                    } else if (barcodeValue.length === 12) {
                        // For 12 digits, calculate check digit and use EAN13
                        let sum = 0;
                        for (let i = 0; i < 12; i++) {
                            sum += parseInt(barcodeValue[i]) * (i % 2 === 0 ? 1 : 3);
                        }
                        const checkDigit = (10 - (sum % 10)) % 10;
                        barcodeValue = barcodeValue + checkDigit;
                        format = 'EAN13';
                    }
                }

                // @ts-expect-error JsBarcode is loaded dynamically
                JsBarcode(barcodeRef.value, barcodeValue, {
                    format: format,
                    displayValue: true,
                    fontSize: 16,
                    margin: 10,
                });
            } catch (error) {
                console.error('Error initializing barcode:', error);
                // Don't show alert on initial load to avoid disrupting user experience
            }
        }
    };
    document.head.appendChild(script);
});

const loadCategorias = async () => {
    try {
        const response = await negocio.cargarCategorias();
        datas.categorias = response || [];
    } catch (error) {
        console.error('Error loading categorias:', error);
    }
};
const loadUnidades = async () => {
    try {
        const response = await negocio.cargarUnidades();
        datas.unidades = response || [];
    } catch (error) {
        console.error('Error loading unidades:', error);
    }
};
const handlePhotoUpload = (e: Event) => {
    const target = e.target as HTMLInputElement;
    const file = target.files?.[0];

    if (!file) {
        return;
    }

    // Check file size (max 1MB)
    if (file.size > datas.maxFileSize * 1024) {
        datas.photo_pathError = `El tamaño de la imagen no debe exceder ${datas.maxFileSize}KB (1MB).`;
        target.value = '';
        return;
    }

    // Check a file type
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    if (!allowedTypes.includes(file.type)) {
        datas.photo_pathError = 'Solo se permiten archivos de imagen (jpeg, png, jpg, gif).';
        target.value = '';
        return;
    }

    form.photo_path = file;
    datas.photo_pathError = '';

    // Create preview
    const reader = new FileReader();
    reader.onload = (e) => {
        datas.photoPreview = e.target?.result as string;
    };
    reader.readAsDataURL(file);
};
const create_model = async () => {
    try {
        cargarModel()
        const response = await negocio.guardar(item);
        console.log(response.data);
        if (response.data.isSuccess) {
            await AlertService.success('La operación se completó con éxito.').then(() => {
                window.location.href = route(model_path + '.index');
            });
            form.reset();
        } else {
            await AlertService.error(response.data.message);
        }
    } catch (error) {
        handleErrors(error);
    }
};
const editar_model = async () => {
    try {
        cargarModel()
        const response = await negocio.actualizar(item, form.id ?? 0);
        if (response.data.isSuccess) {
            await AlertService.success('La operación se completó con éxito.').then(() => {
                window.location.href = route(model_path + '.index');
            });
        } else {
            await AlertService.error(response.data.message);
        }
    } catch (error) {
        handleErrors(error);
    }
};
const submit_create = async () => {
    // Validate required fields
    let hasErrors = false;

    if (!form.name || form.name.length < 2) {
        datas.nameError = 'El nombre es requerido y debe tener al menos 2 caracteres.';
        hasErrors = true;
    }

    if (!form.categoria_id) {
        datas.categoria_idError = 'La categoría es requerida.';
        hasErrors = true;
    }

    if (!form.unidad_id) {
        datas.unidad_idError = 'La unidad es requerida.';
        hasErrors = true;
    }

    if (hasErrors) {
        return;
    }

    if (props.isCreate) {
        await create_model();
    } else {
        await editar_model();
    }
};
// Generate QR code for the item
const generateQRCode = () => {
    // Use the item's ID or code as the QR code value
    datas.qrValue = form.cod_barra || form.id?.toString() || form.name;
    datas.showQRCode = true;
    datas.showBarcode = false; // Hide barcode when showing QR code
};

// Generate barcode for the item
const generateBarcode = () => {
    // Use the item's barcode or ID as the barcode value
    datas.barcodeValue = form.cod_barra || form.id?.toString() || '';
    datas.showBarcode = true;
    datas.showQRCode = false; // Hide QR code when showing barcode

    // Wait for the DOM to update
    setTimeout(() => {
        if (datas.barcodeValue && barcodeRef.value) {
            try {
                // Choose appropriate format based on input
                let format = 'CODE128'; // Default format that accepts any length
                let barcodeValue = datas.barcodeValue;

                // If it's a numeric value and either 12 or 13 digits, use EAN13
                if (/^\d+$/.test(barcodeValue)) {
                    if (barcodeValue.length === 13) {
                        format = 'EAN13';
                    } else if (barcodeValue.length === 12) {
                        // For 12 digits, calculate a check digit and use EAN13
                        let sum = 0;
                        for (let i = 0; i < 12; i++) {
                            sum += parseInt(barcodeValue[i]) * (i % 2 === 0 ? 1 : 3);
                        }
                        const checkDigit = (10 - (sum % 10)) % 10;
                        barcodeValue = barcodeValue + checkDigit;
                        format = 'EAN13';
                    }
                }

                // @ts-expect-error JsBarcode is loaded dynamically
                JsBarcode(barcodeRef.value, barcodeValue, {
                    format: format,
                    displayValue: true,
                    fontSize: 16,
                    margin: 10,
                });
            } catch (error) {
                console.error('Error generating barcode:', error);
                AlertService.error('Error al generar el código de barras. Asegúrese de que el código sea válido.');
            }
        }
    }, 100);
};

// Generate random barcode
const generateRandomBarcode = () => {
    // Generate a random 13-digit EAN-13 barcode
    const randomBarcode = Array.from({ length: 12 }, () => Math.floor(Math.random() * 10)).join('');
    // Calculate check digit
    let sum = 0;
    for (let i = 0; i < 12; i++) {
        sum += parseInt(randomBarcode[i]) * (i % 2 === 0 ? 1 : 3);
    }
    const checkDigit = (10 - (sum % 10)) % 10;
    const fullBarcode = randomBarcode + checkDigit;

    form.cod_barra = fullBarcode;
    datas.barcodeValue = fullBarcode;
    datas.showBarcode = true;
    datas.showQRCode = false;

    // Wait for the DOM to update
    setTimeout(() => {
        if (barcodeRef.value) {
            try {
                // For random generation, we know it's a valid EAN13 format
                // @ts-expect-error JsBarcode is loaded dynamically
                JsBarcode(barcodeRef.value, fullBarcode, {
                    format: 'EAN13',
                    displayValue: true,
                    fontSize: 16,
                    margin: 10,
                });
            } catch (error) {
                console.error('Error generating barcode:', error);
                AlertService.error('Error al generar el código de barras.');
            }
        }
    }, 100);
};

const handleErrors = (error: any) => {
    if (error.response.status === 403) {
        AlertService.error('No tiene permiso para realizar esta acción.');
        return;
    }
    if (error.response.data && error.response.data.statusCode === 422) {
        const errors = error.response.data.messageError;
        datas.cod_barraError = errors.cod_barra ? errors.cod_barra[0] : '';
        datas.nameError = errors.name ? errors.name[0] : '';
        datas.descripcionError = errors.descripcion ? errors.descripcion[0] : '';
        datas.photo_pathError = errors.photo_path ? errors.photo_path[0] : '';
        datas.categoria_idError = errors.categoria_id ? errors.categoria_id[0] : '';
        datas.unidad_idError = errors.unidad_id ? errors.unidad_id[0] : '';
    } else {
        AlertService.error(error.response.data.message);
        datas.generalError = 'Ocurrió un error inesperado. Por favor, inténtelo de nuevo.';
    }
};

const handleFieldValidation = (field: string, value: string | number | Event) => {
    const result = negocio.validateField(field, value);

    // Actualizar el formulario y los errores
    if (field in form) {
        (form as any)[field] = result.value;
    }

    if (field + 'Error' in datas) {
        (datas as any)[field + 'Error'] = result.error;
    }
};

</script>

<template>
    <Head :title="UtilsServices.capitalizeFirstLetter(model_path)" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="w-full px-11 py-6">
            <HeaderForm
                :model_path="model_path"
                :fecha_creado="props.model ? props.model.created_at : ''"
                :fecha_actualizado="props.model ? props.model.updated_at : ''"
                :isCreate="props.isCreate"
                :id_model="props.model ? props.model.id.toString() : ''"
            />
            <br />
            <hr class="mb-4" />
            <div>
                <!-- Código de Barras -->
                <div v-show="!props.isCreate" class="mb-4">
                    <label
                        for="cod_barra"
                        :class="{ 'label-error': datas.cod_barraError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Código de Barras</label
                    >
                    <div class="flex gap-2">
                        <input
                            type="text"
                            name="cod_barra"
                            id="cod_barra"
                            v-model="form.cod_barra"
                            @input="(e) => handleFieldValidation('cod_barra', e)"
                            :class="{ 'input-error': datas.cod_barraError }"
                            class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                            placeholder="Código de Barras"
                        />
                        <button
                            type="button"
                            @click="generateRandomBarcode"
                            class="flex items-center gap-2 rounded-lg bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
                        >
                            <Barcode class="h-4 w-4" />
                            Generar
                        </button>
                    </div>
                    <InputError class="mt-2" :message="datas.cod_barraError" />

                    <!-- Barcode and QR Code Buttons -->
                    <div class="mt-2 flex gap-2">
                        <button
                            type="button"
                            @click="generateBarcode"
                            class="flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-gray-800 hover:bg-gray-300"
                        >
                            <Barcode class="h-4 w-4" />
                            Ver Código de Barras
                        </button>
                        <button
                            type="button"
                            @click="generateQRCode"
                            class="flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-gray-800 hover:bg-gray-300"
                        >
                            <QrCode class="h-4 w-4" />
                            Ver QR
                        </button>
                    </div>

                    <!-- Barcode Display -->
                    <div v-if="datas.showBarcode && datas.barcodeValue" class="mt-4 flex flex-col items-center rounded-lg border bg-white p-4">
                        <h3 class="mb-2 text-lg font-semibold">Código de Barras</h3>
                        <svg ref="barcodeRef" class="w-full max-w-xs"></svg>
                        <p class="mt-2 text-sm text-gray-600">{{ datas.barcodeValue }}</p>
                    </div>

                    <!-- QR Code Display -->
                    <div v-if="datas.showQRCode && datas.qrValue" class="mt-4 flex flex-col items-center rounded-lg border bg-white p-4">
                        <h3 class="mb-2 text-lg font-semibold">Código QR</h3>
                        <QRCode :value="datas.qrValue" :options="{ width: 200 }" ref="qrCodeRef" />
                        <p class="mt-2 text-sm text-gray-600">{{ datas.qrValue }}</p>
                    </div>
                </div>
                <!-- Nombre -->
                <div class="mb-4">
                    <label for="name" :class="{ 'label-error': datas.nameError }" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Nombre *</label
                    >
                    <input
                        type="text"
                        name="name"
                        id="name"
                        v-model="form.name"
                        @input="(e) => handleFieldValidation('name', e)"
                        :class="{ 'input-error': datas.nameError }"
                        class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="Nombre del producto"
                        required
                    />
                    <InputError class="mt-2" :message="datas.nameError" />
                </div>
                <div class="mb-4 flex gap-4">
                    <!-- Categoría -->
                    <div class="w-1/2">
                        <div class="mb-4">
                            <label
                                for="categoria_id"
                                :class="{ 'label-error': datas.categoria_idError }"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                >Categoria *</label
                            >

                            <SelectSearch
                                id="categoria_id"
                                v-model="form.categoria_id"
                                :options="datas.categorias.filter(cat => cat.id !== undefined).map((cat) => ({ id: Number(cat.id?.toString()), text: cat.detalle }))"
                                placeholder="Seleccione una categoría"
                                @change="(e : any) => handleFieldValidation('categoria_id', e)"
                                :class="{ 'input-error': datas.categoria_idError }"
                                :searchable="true"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg"
                            />
                            <InputError class="mt-2" :message="datas.categoria_idError" />
                        </div>
                    </div>
                    <!-- Unidad -->
                    <div class="w-1/2">
                        <div class="mb-4">
                            <label
                                for="unidad_id"
                                :class="{ 'label-error': datas.unidad_idError }"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                >Unidad *</label
                            >
                            <SelectSearch
                                id="unidad_id"
                                v-model="form.unidad_id"
                                :searchable="true"
                                :options="datas.unidades.filter(cat => cat.id !== undefined).map((unit) => ({ id: Number(unit.id?.toString()), text: unit.detalle }))"
                                placeholder="Seleccione una unidad"
                                @change="(e: any) => handleFieldValidation('unidad_id', e)"
                                :class="{ 'input-error': datas.unidad_idError }"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg"
                            />
                            <InputError class="mt-2" :message="datas.unidad_idError" />
                        </div>
                    </div>
                </div>

                <!-- Imagen -->
                <div class="mb-4">
                    <label
                        for="photo_path"
                        :class="{ 'label-error': datas.photo_pathError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Imagen (Max: 1MB)</label
                    >
                    <input
                        type="file"
                        name="photo_path"
                        id="photo_path"
                        @change="handlePhotoUpload"
                        :class="{ 'input-error': datas.photo_pathError }"
                        class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        accept="image/jpeg,image/png,image/jpg,image/gif"
                    />
                    <InputError class="mt-2" :message="datas.photo_pathError" />

                    <!-- Image Preview -->
                    <div v-if="datas.photoPreview || form.current_photo" class="mt-2">
                        <img
                            :src="datas.photoPreview || '/storage/' + form.current_photo"
                            alt="Preview"
                            class="max-w-xs rounded-lg border border-gray-300"
                        />
                    </div>
                </div>
                <!-- Descripción -->
                <div class="mb-4">
                    <label
                        for="descripcion"
                        :class="{ 'label-error': datas.descripcionError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Descripción</label
                    >
                    <textarea
                        id="descripcion"
                        rows="4"
                        v-model="form.descripcion"
                        @input="(e) => handleFieldValidation('descripcion', e)"
                        :class="{ 'input-error': datas.descripcionError }"
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="Ingrese la descripción aquí"
                    ></textarea>
                    <InputError class="mt-2" :message="datas.descripcionError" />
                </div>
                <button
                    type="submit"
                    @click="submit_create"
                    :class="[
                        'me-2 mb-2 flex items-center justify-center gap-2 rounded-full px-5 py-2.5 text-center text-sm font-medium text-white focus:ring-4 focus:outline-none',
                        isCreate
                            ? 'bg-blue-700 hover:bg-blue-800 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'
                            : 'bg-green-700 hover:bg-green-800 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800',
                    ]"
                >
                    {{ isCreate ? 'Crear' : 'Editar' }} {{ model_path }}
                    <DiamondPlus v-if="isCreate" class="text-white-800 h-4 w-4 dark:text-white" />
                    <Pencil v-else class="text-white-800 h-4 w-4 dark:text-white" />
                </button>
            </div>
        </div>
    </AppLayout>
</template>
