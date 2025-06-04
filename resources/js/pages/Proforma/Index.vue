<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { onMounted, reactive, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import AlertService from '@/Services/AlertService.js';
import SearchInput from '@/Componentes/SearchInput.vue';
import Loader from '@/Componentes/Loader.vue';
import TableLayout from '@/Componentes/TableLayout.vue';
import Pagination from '@/Componentes/Pagination.vue';
import axios from 'axios';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Proformas',
        href: '/proforma',
    },
];

const props = defineProps({
    auth: Object,
});

const datas = reactive({
    list: [],
    isLoad: false,
    messageList: '',
    currentPage: 1,
    lastPages: 1,
    totalItems: 0,
    totalPages: 1,
    perPage: 10,
    userType: 'customer', // 'customer' or 'cashier'
});

onMounted(() => {
    fetchList();
    // Check if user has cashier role
    if (props.auth && props.auth.user && props.auth.user.roles) {
        const roles = props.auth.user.roles;
        if (roles.some(role => role.name === 'cajero' || role.name === 'admin')) {
            datas.userType = 'cashier';
        }
    }
});

const query = ref('');

const fetchList = async (page = 1) => {
    datas.isLoad = true;
    try {
        const response = await axios.post('/proforma/query', {
            search: query.value,
            page: page,
            per_page: datas.perPage
        });

        if (response.data.isSuccess) {
            datas.list = response.data.data.data;
            datas.messageList = response.data.message;
            datas.currentPage = response.data.data.current_page;
            datas.lastPages = response.data.data.last_page;
            datas.totalPages = response.data.data.last_page;
            datas.totalItems = response.data.data.total;
        } else {
            datas.list = [];
            AlertService.error(response.data.message);
        }
    } catch (error) {
        console.error('Error fetching proformas:', error);
        AlertService.error('Error al cargar las proformas');
    } finally {
        datas.isLoad = false;
    }
};

const queryList = async (consulta) => {
    query.value = consulta;
    await fetchList();
};

const destroyItem = (id) => {
    AlertService.confirm('Esta información ya no podrá ser recuperada').then(async (result) => {
        if (result.isConfirmed) {
            datas.isLoad = true;
            try {
                const response = await axios.delete(`/proforma/${id}`);
                if (response.data.isSuccess) {
                    await AlertService.success('La proforma se eliminó exitosamente!.');
                    await queryList('');
                } else {
                    await AlertService.error(response.data.message);
                }
            } catch (error) {
                console.error('Error deleting proforma:', error);
                AlertService.error('Error al eliminar la proforma');
            } finally {
                datas.isLoad = false;
            }
        }
    });
};

const convertToVenta = (id) => {
    AlertService.confirm('¿Desea convertir esta proforma en una venta?').then(async (result) => {
        if (result.isConfirmed) {
            datas.isLoad = true;
            try {
                const response = await axios.post(`/proforma/${id}/convert-to-venta`);
                if (response.data.isSuccess) {
                    await AlertService.success('La proforma se convirtió en venta exitosamente!.');
                    window.location.href = route('venta.index');
                } else {
                    await AlertService.error(response.data.message);
                }
            } catch (error) {
                console.error('Error converting proforma to venta:', error);
                AlertService.error('Error al convertir la proforma en venta');
            } finally {
                datas.isLoad = false;
            }
        }
    });
};

const formatDate = (dateString) => {
    if (!dateString) return '';
    const date = new Date(dateString);
    return date.toLocaleDateString();
};

const formatCurrency = (value) => {
    if (!value) return '0.00';
    return parseFloat(value).toFixed(2);
};
</script>

<template>
    <Head title="Proformas" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Proformas</h1>
                <div class="flex gap-2">
                    <Link v-if="datas.userType === 'cashier'" :href="route('proforma.create')" class="btn btn-primary">
                        Nueva Proforma (Cajero)
                    </Link>
                    <Link :href="route('proforma.create')" class="btn btn-secondary">
                        Nueva Proforma (Cliente)
                    </Link>
                </div>
            </div>

            <div class="flex justify-between items-center mb-4">
                <SearchInput @search="queryList" />
            </div>

            <Loader v-if="datas.isLoad" />

            <TableLayout v-else>
                <template #header>
                    <tr>
                        <th class="px-4 py-2">Código</th>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Cliente</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </template>
                <template #body>
                    <tr v-for="item in datas.list" :key="item.id" class="border-b">
                        <td class="px-4 py-2">{{ item.codigo }}</td>
                        <td class="px-4 py-2">{{ formatDate(item.fecha) }}</td>
                        <td class="px-4 py-2">{{ item.cliente ? item.cliente.nombre : 'N/A' }}</td>
                        <td class="px-4 py-2">{{ formatCurrency(item.total) }}</td>
                        <td class="px-4 py-2">
                            <span
                                :class="{
                                    'bg-green-100 text-green-800': item.estado === 'aprobado',
                                    'bg-yellow-100 text-yellow-800': item.estado === 'pendiente',
                                    'bg-red-100 text-red-800': item.estado === 'rechazado'
                                }"
                                class="px-2 py-1 rounded-full text-xs font-medium"
                            >
                                {{ item.estado }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex gap-2">
                                <Link :href="route('proforma.show', item.id)" class="btn btn-sm btn-info">
                                    Ver
                                </Link>
                                <Link :href="route('proforma.edit', item.id)" class="btn btn-sm btn-warning">
                                    Editar
                                </Link>
                                <button @click="destroyItem(item.id)" class="btn btn-sm btn-danger">
                                    Eliminar
                                </button>
                                <button @click="convertToVenta(item.id)" class="btn btn-sm btn-success">
                                    Convertir a Venta
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="datas.list.length === 0">
                        <td colspan="6" class="px-4 py-2 text-center">No hay proformas registradas</td>
                    </tr>
                </template>
            </TableLayout>

            <Pagination
                v-if="datas.list.length > 0"
                :current-page="datas.currentPage"
                :last-page="datas.lastPages"
                @page-changed="fetchList"
            />
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
.btn-info {
    @apply bg-blue-500 hover:bg-blue-600;
}
.btn-warning {
    @apply bg-yellow-500 hover:bg-yellow-600;
}
.btn-danger {
    @apply bg-red-500 hover:bg-red-600;
}
.btn-success {
    @apply bg-indigo-500 hover:bg-indigo-600;
}
</style>
