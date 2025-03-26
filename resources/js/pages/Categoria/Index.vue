<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { onMounted, reactive, ref } from 'vue';
import HeaderIndex from '@/Componentes/HeaderIndex.vue';
import Alert from '@/Componentes/Alert.vue';
import { Head } from '@inertiajs/vue3';
import CategoriaService from '@/Services/CategoriaService.js';
import UtilsServices from '@/Services/UtilsServices.js';
import AlertService from '@/Services/AlertService.js';
import AlertInfo from '@/Componentes/Alert-Info.vue';
import SearchInput from '@/Componentes/SearchInput.vue';
import Loader from '@/Componentes/Loader.vue';
import TdTable from '@/Componentes/Td-Table.vue';
import { type BreadcrumbItem } from '@/types';
import ActionsButtons from '@/Componentes/ActionsButtons.vue';
import TableLayout from '@/Componentes/TableLayout.vue';
import ButtonsAdd from '@/Componentes/ButtonsAdd.vue';

const model_service = CategoriaService;
const model_path = model_service.path_url;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: model_path.toUpperCase(),
        href: '/'.model_path,
    },
];

const props = defineProps({
    listado: {
        type: Array,
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

onMounted(() => {
    console.log(props.listado);
    datas.list = props.listado;
});

const datas = reactive({
    list: [],
    isLoad: false,
    dateStart: '',
    dateEnd: '',
    messageList: '',
    metodoList: '',
    siglaError: '',
    detalleError: '',
});

const query = ref('');

const queryList = async (consulta) => {
    query.value = consulta;
    datas.isLoad = true;
    const response = await model_service.query(consulta);
    if (response.data.isSuccess) {
        datas.list = response.data.data;
        datas.messageList = response.data.message;
        datas.metodoList = consulta.length > 0 ? ' con: ' + consulta : '';
    } else {
        datas.list = [];
    }
    datas.isLoad = false;
};

const destroyMessage = (id) => {
    AlertService.confirm('Esta información ya no podrá ser recuperada').then((result) => {
        if (result.isConfirmed) {
            datas.isLoad = true;
            destroyData(id);
            datas.isLoad = false;
        }
    });
};

const destroyData = async (id) => {
    const response = await model_service.destroy(id);
    if (response.data.isSuccess) {
        await AlertService.success('La operación se completo exitosamente!.');
        await queryList('');
    } else {
        await AlertService.error(response.data.message);
    }
};
</script>

<template>
    <Head :title="model_path" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 sm:flex lg:mt-1.5">
            <div class="mb-1 w-full">
                <HeaderIndex :title="model_path" />
                <div class="flex flex-wrap items-end dark:divide-gray-700 sm:flex md:divide-x md:divide-gray-100">
                    <SearchInput :model-path="model_path" v-model="query" @update:query="queryList" />
                    <ButtonsAdd :model_path="model_path" :crear="props.crear"/>
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
            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden shadow">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>
