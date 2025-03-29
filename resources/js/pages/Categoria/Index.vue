<script setup lang="ts">
import AlertInfo from '@/Componentes/Alert-Info.vue';
import Alert from '@/Componentes/Alert.vue';
import ButtonsAdd from '@/Componentes/ButtonsAdd.vue';
import HeaderIndex from '@/Componentes/HeaderIndex.vue';
import Loader from '@/Componentes/Loader.vue';
import Pagination from '@/Componentes/Pagination.vue';
import SearchInput from '@/Componentes/SearchInput.vue';
import TableLayout from '@/Componentes/TableLayout.vue';
import TdTable from '@/Componentes/Td-Table.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import AlertService from '@/Services/AlertService.js';
import CategoriaService from '@/Services/CategoriaService.js';
import UtilsServices from '@/Services/UtilsServices.js';
import { type BreadcrumbItem } from '@/types';
import { Categoria } from '@/types/Categoria';
import { Head } from '@inertiajs/vue3';
import { onMounted, reactive, ref } from 'vue';

const model_service = CategoriaService;
const model_path = model_service.path_url;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: model_path.toUpperCase(),
        href: '/' + model_path,
    },
];

const props = defineProps({
    listado: {
        type: Array as () => Array<Categoria>,
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
    list: [] as Array<Categoria>,
    isLoad: false,
    dateStart: '',
    dateEnd: '',
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

const selectedAttributes = reactive({
    id: true,
    sigla: true,
    detalle: true,
    created_at: false,
    updated_at: false,
} as Record<string, boolean>);

const attributes = [
    { key: 'id', label: 'ID', isSearch: true },
    { key: 'sigla', label: 'Sigla', isSearch: true },
    { key: 'detalle', label: 'Detalle', isSearch: true },
    { key: 'acciones', label: 'Acciones', isSearch: false },
];

const fetchList = async (page = 1) => {
    datas.isLoad = true;
    const attributes = Object.keys(selectedAttributes).filter((attr) => selectedAttributes[attr]);
    const response = await model_service.query(query.value, page, datas.perPage, attributes);
    console.log('response', response);
    if (response.data.isSuccess) {
        datas.list = response.data.data.data;
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
                <div class="block items-center justify-between dark:divide-gray-700 sm:flex md:divide-x md:divide-gray-100">
                    <SearchInput :model-path="model_path" v-model="query" @update:query="queryList" @refresh="refreshTable" />
                    <ButtonsAdd :model_path="model_path" :crear="props.crear" />
                </div>
                <div class="mt-3 block items-center sm:flex md:divide-x md:divide-gray-100">
                    <div class="mr-2 inline-flex gap-2">

                    </div>
                </div>
            </div>
        </div>
        <div v-if="datas.isLoad">
            <Loader />
        </div>
        <TableLayout>
            <template #thead>
                <tr>
                    <th
                        v-for="attr in attributes"
                        :key="attr.key"
                        scope="col"
                        class="px-2 py-2 text-left"
                    >

                        <p v-if="!attr.isSearch">{{ attr.label }}</p>
                        <label v-else >
                            <input
                                type="checkbox"
                                class="rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                                :id="attr.key"
                                :disabled="!attr.isSearch"
                                v-model="selectedAttributes[attr.key]" />
                            {{ attr.label }}
                        </label>
                    </th>
                </tr>
            </template>

            <template #tbody>
                <tr v-for="item in datas.list" :key="item.id" class="hover:bg-gray-100 dark:hover:bg-gray-700">
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
            v-show="datas.list.length > 0"
            :current-page="datas.currentPage"
            :total-pages="datas.totalPages"
            :total-items="datas.totalItems"
            :last-pages="datas.lastPages"
            :per-page="datas.perPage"
            @page-changed="fetchList"
            @per-page-changed="handlePerPageChange"
        />
        <div v-if="datas.list.length === 0">
            <Alert v-if="query.length === 0" :message="'No se encontraron registros'" :path="model_path + '.create'" />
            <Alert-Info v-else :message="'No se encontraron registros con: ' + query" />
        </div>
    </AppLayout>
</template>

<style scoped></style>
