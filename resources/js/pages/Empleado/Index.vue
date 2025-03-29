<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { onMounted, reactive, ref } from 'vue';
import HeaderIndex from '@/Componentes/HeaderIndex.vue';
import Alert from '@/Componentes/Alert.vue';
import { Head } from '@inertiajs/vue3';
import UtilsServices from '@/Services/UtilsServices.js';
import AlertService from '@/Services/AlertService.js';
import AlertInfo from '@/Componentes/Alert-Info.vue';
import SearchInput from '@/Componentes/SearchInput.vue';
import Loader from '@/Componentes/Loader.vue';
import TdTable from '@/Componentes/Td-Table.vue';
import { type BreadcrumbItem } from '@/types';
import TableLayout from '@/Componentes/TableLayout.vue';
import ButtonsAdd from '@/Componentes/ButtonsAdd.vue';
import Pagination from '@/Componentes/Pagination.vue';
import EmpleadoService from '@/Services/EmpleadoService';

const model_service = EmpleadoService;
const model_path = model_service.path_url;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: model_path.toUpperCase(),
        href: '/'+model_path,
    },
];

const props = defineProps({
    listado: {
        type: Array as () => Array<{ id: number, sigla: string, detalle: string, created_at: string, updated_at: string }>,
        default: () => [],
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
    list: [] as Array<{ id: number, sigla: string, detalle: string, created_at: string, updated_at: string }>,
    isLoad: false,
    dateStart: '',
    dateEnd: '',
    messageList: '',
    metodoList: '',
    siglaError: '',
    detalleError: '',
    currentPage: 1,
    lastPages: 1,
    totalItems: 0,
    totalPages: 1,
    perPage: 5,
});

onMounted(() => {
    fetchList();
});


const query = ref('');

const fetchList = async (page = 1) => {
    datas.isLoad = true;
    const response = await model_service.query(query.value, page, datas.perPage);
    if (response.data.isSuccess) {
        datas.list = response.data.data.data;
        datas.messageList = response.data.message;
        datas.metodoList = query.value.length > 0 ? ' con: ' + query.value : '';
        datas.currentPage = response.data.data.current_page;
        datas.lastPages = response.data.data.last_page;
        datas.totalPages = response.data.data.last_page;
        datas.totalItems = response.data.data.total;
    } else {
        datas.list = [];
    }
    datas.isLoad = false;
};

const queryList = async (consulta: string) => {
    query.value = consulta;
    await fetchList();
};

const destroyMessage = (id: number) => {
    AlertService.confirm('Esta información ya no podrá ser recuperada').then((result) => {
        if (result.isConfirmed) {
            datas.isLoad = true;
            destroyData(id);
            datas.isLoad = false;
        }
    });
};

const destroyData = async (id: number) => {
    const response = await model_service.destroy(id);
    if (response.data.isSuccess) {
        await AlertService.success('La operación se completo exitosamente!.');
        await queryList('');
    } else {
        await AlertService.error(response.data.message);
    }
};

const handlePerPageChange = (perPage: number) => {
    datas.perPage = perPage;
    fetchList(1);
};

const refreshTable = () => {
    query.value = '';
    datas.perPage = 5;
    datas.currentPage = 1;
    datas.lastPages = 1;
    datas.totalItems = 0;
    datas.totalPages = 1;
    fetchList(datas.currentPage);
};
</script>

<template>
    <Head :title="UtilsServices.capitalizeFirstLetter(model_path)" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 sm:flex lg:mt-1.5">
            <div class="mb-1 w-full">
                <HeaderIndex :title="model_path" />
                <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                    <SearchInput
                        :model-path="model_path"
                        v-model="query"
                        @update:query="queryList"
                        @refresh="refreshTable"
                    />
                    <ButtonsAdd
                        :model_path="model_path"
                        :crear="props.crear"/>
                </div>
            </div>
        </div>
        <div v-if="datas.isLoad">
            <Loader />
        </div>
        <div v-if="datas.list.length === 0">
            <Alert v-if="query.length === 0" :message="'No se encontraron registros'" :path="model_path + '.create'" />
            <Alert-Info v-else :message="'No se encontraron registros con: ' + query" />
        </div>
        <div v-else>
            <TableLayout :mostrarfoot="datas.list.length > 10">
                <template #thead>
                    <tr>
                        <th scope="col" class="p-4 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                            ID
                        </th>
                        <th scope="col" class="p-4 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                            Sigla
                        </th>
                        <th scope="col" class="p-4 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                            Detalle
                        </th>
                        <th scope="col" class="p-4 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-400">
                            Acciones
                        </th>
                    </tr>
                </template>
                <template #tbody>
                    <tr v-for="item in datas.list" :key="item.id"
                        class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="whitespace-nowrap p-4 text-base font-medium text-gray-900 dark:text-white">
                            {{ item.id }}
                        </td>
                        <td class="whitespace-nowrap p-4 text-base font-medium text-gray-900 dark:text-white">
                            {{ item.sigla }}
                        </td>
                        <td class="whitespace-nowrap p-4 text-base font-medium text-gray-900 dark:text-white">
                            {{ item.detalle }}
                        </td>
                        <TdTable
                            :creado="UtilsServices.fecha(item.created_at)"
                            :actualizado="UtilsServices.fecha(item.updated_at)"
                            :model_path="model_path"
                            :itemId="item.id"
                            :onDelete="destroyMessage"
                        ></TdTable>
                    </tr>
                </template>
            </TableLayout>
            <Pagination
                :current-page="datas.currentPage"
                :total-pages="datas.totalPages"
                :total-items="datas.totalItems"
                :last-pages="datas.lastPages"
                :per-page="datas.perPage"
                @page-changed="fetchList"
                @per-page-changed="handlePerPageChange"
            />
        </div>
    </AppLayout>
</template>

<style scoped></style>
