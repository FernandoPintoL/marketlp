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
import { CategoriaNegocio } from '@/Negocio/CategoriaNegocio';
import UtilsServices from '@/Services/UtilsServices.js';
import { type BreadcrumbItem } from '@/types';
import { attributesHead, Categoria, getDefaultAttributes, selectedAttributes } from '@/Data/Categoria';
import { Head } from '@inertiajs/vue3';
import { Search } from 'lucide-vue-next';
import { onMounted, reactive, ref } from 'vue';
import { ParamsConsulta } from '@/Data/PaginacionLaravel';

const model_service = new CategoriaNegocio();
const modelName = model_service.model;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: modelName.toUpperCase(),
        href: '/' + modelName,
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
    // datas.list = props.listado;
});

const query = ref('');
const dateStart = ref('');
const dateEnd = ref('');
const attributesHeadReactive = attributesHead;
let selectedAttributesReactive = reactive(selectedAttributes);

const fetchList = async (page = 1) => {
    if (selectedAttributesReactive['created_at'] || selectedAttributesReactive['updated_at']) {
        if (dateStart.value.length == 0 && dateEnd.value.length == 0) {
            AlertService.error('Fecha de inicio y fecha final deben ser rellenadas');
            return;
        }
        if (dateStart.value > dateEnd.value) {
            AlertService.error('La fecha de inicio no puede ser mayor a la fecha de fin');
            return;
        }
    }
    datas.isLoad = true;
    const attributes = Object.keys(selectedAttributesReactive).filter((attr) => selectedAttributesReactive[attr]);
    const params: ParamsConsulta = {
        query: query.value,
        is_query_table: true,
        page: page,
        perPage: datas.perPage,
        attributes: attributes.length > 0 ? attributes : undefined,
        dateStart: dateStart.value,
        dateEnd: dateEnd.value,
    };
    const response = await model_service.consultar(params);
    if (response === undefined || response.data === undefined) {
        AlertService.error('Error al obtener los datos');
        datas.isLoad = false;
        return;
    }
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
    const response = await model_service.eliminar(id);
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
    dateStart.value = '';
    dateEnd.value = '';
    datas.perPage = 5;
    datas.currentPage = 1;
    datas.lastPages = 1;
    datas.totalItems = 0;
    datas.totalPages = 1;
    selectedAttributesReactive = reactive({ ...getDefaultAttributes() });
    fetchList(datas.currentPage);
};
</script>

<template>

    <Head :title="UtilsServices.capitalizeFirstLetter(modelName)" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="mt-2 mb-1 w-full">
                <HeaderIndex :title="modelName" />
                <div class="flex flex-nowrap justify-start gap-6">
                    <SearchInput :model-path="modelName" v-model="query" @update:query="queryList"
                        @refresh="refreshTable" />
                    <ButtonsAdd :model_path="modelName" :crear="props.crear" />
                </div>
                <hr class="mt-2" />
                <div class="space-y-2 p-2 sm:flex sm:flex-nowrap sm:justify-start sm:gap-6">
                    <div>
                        <h3 class="font-semibold text-pretty">BUSQUEDA POR FECHAS</h3>
                        <!--                        <input
                                                    type="checkbox"
                                                    id="created_at"
                                                    class="peer hidden"
                                                    v-model="selectedAttributesReactive['created_at']"
                                                />
                                                <label
                                                    for="created_at"
                                                    class="mb-2 flex cursor-pointer items-center text-sm font-medium text-gray-900 peer-checked:text-indigo-600 dark:peer-checked:text-indigo-400"
                                                >
                                                    <div
                                                        class="w-5 h-5 rounded-md border border-gray-300 bg-white peer-checked:border-indigo-600 peer-checked:bg-indigo-600 peer-checked:ring-2 peer-checked:ring-indigo-400"
                                                    ></div>
                                                    <span class="ml-2">Busqueda fecha de creación</span>
                                                </label>-->
                        <div class="mt-1.5 flex flex-nowrap justify-start gap-2">
                            <div class="appearance-none">
                                <label for="created_at"
                                    class="mb-2 flex cursor-pointer items-center text-sm font-medium peer-checked:text-indigo-600 dark:peer-checked:text-indigo-400">
                                    <input type="checkbox" id="created_at"
                                        class="h-5 w-5 appearance-none rounded-md border-2 border-gray-300 checked:border-indigo-600 checked:bg-indigo-600 focus:ring-2 focus:ring-indigo-500"
                                        v-model="selectedAttributesReactive['created_at']" />
                                    <span
                                        class="ml-2 peer-checked:text-indigo-600 dark:peer-checked:text-indigo-400">Busqueda
                                        fecha de creación</span>
                                </label>
                            </div>
                            <div>
                                <input type="checkbox"
                                    class="rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                                    id="updated_at" v-model="selectedAttributesReactive['updated_at']" />
                                <label for="updated_at" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Busqueda fecha de actualización
                                </label>
                            </div>
                        </div>
                    </div>
                    <div v-show="selectedAttributesReactive['created_at'] || selectedAttributesReactive['updated_at']"
                        class="flex flex-nowrap justify-start gap-6">
                        <div>
                            <label for="start-time" class="text-sm font-medium text-gray-900 dark:text-white"> Fecha
                                Inicio: </label>
                            <input type="date" v-model="dateStart" id="start-time"
                                class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm leading-none text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" />
                        </div>
                        <div>
                            <label for="end-time" class="text-sm font-medium text-gray-900 dark:text-white"> Fecha Fin:
                            </label>
                            <input type="date" v-model="dateEnd" id="end-time"
                                class="w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm leading-none text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500" />
                        </div>
                        <button type="button" @click="fetchList(1)"
                            class="rounded-md border border-blue-700 px-2 text-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:ring-blue-300 focus:outline-none dark:border-blue-500 dark:text-blue-500 dark:hover:bg-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                            <Search class="h-4 w-4" />
                        </button>
                    </div>
                </div>
                <hr />
            </div>
            <div v-if="datas.isLoad">
                <Loader />
            </div>
            <TableLayout>
                <template #thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th v-for="attr in attributesHeadReactive" :key="attr.key" scope="col"
                            class="px-2 py-2 text-left">
                            <p v-if="!attr.isSearch">{{ attr.label }}</p>
                            <label v-else>
                                <input type="checkbox"
                                    class="rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                                    :id="attr.key" :disabled="!attr.isSearch"
                                    v-model="selectedAttributesReactive[attr.key]" />
                                {{ attr.label }}
                            </label>
                        </th>
                    </tr>
                </template>

                <template #tbody>
                    <tr v-for="item in datas.list" :key="item.id" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="p-4 text-base font-medium whitespace-nowrap text-gray-900 dark:text-white">
                            {{ item.id }}
                        </td>
                        <td class="p-4 text-base font-medium whitespace-nowrap text-gray-900 dark:text-white">
                            {{ item.sigla }}
                        </td>
                        <td class="p-4 text-base font-medium whitespace-nowrap text-gray-900 dark:text-white">
                            {{ item.detalle }}
                        </td>
                        <TdTable :creado="UtilsServices.fecha(item.created_at)"
                            :actualizado="UtilsServices.fecha(item.updated_at)" :model_path="modelName"
                            :itemId="item.id ?? ''" :onDelete="destroyMessage"></TdTable>
                    </tr>
                </template>
            </TableLayout>
            <Pagination v-show="datas.list.length > 0" :current-page="datas.currentPage" :total-pages="datas.totalPages"
                :total-items="datas.totalItems" :last-pages="datas.lastPages" :per-page="datas.perPage"
                @page-changed="fetchList" @per-page-changed="handlePerPageChange" />
            <div v-if="datas.list.length === 0">
                <Alert v-if="query.length === 0" :message="'No se encontraron registros'"
                    :path="modelName + '.create'" />
                <Alert-Info v-else :message="'No se encontraron registros con: ' + query" />
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>
