<script setup lang="ts">
import HeaderForm from '@/Componentes/Header-Form.vue';
import AlertService from '@/Services/AlertService.js';
import UtilsServices from '@/Services/UtilsServices';
import ValidacionService from '@/Services/ValidacionService.js';
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, reactive } from 'vue';
import { route } from 'ziggy-js';
import { Pencil, DiamondPlus } from 'lucide-vue-next';
import MenuService from '@/Services/MenuService';
import type { Menu } from '@/Data/Menu';

const model_service = MenuService;
const model_path = model_service.path_url;
const validacion = ValidacionService;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: model_path.toUpperCase(),
        href: '/' + model_path,
    },
];

const props = defineProps({
    model: Object as () => Menu,
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

const form = useForm({
    id: props.model != null ? props.model.id : '',
    title: props.model?.title != null ? props.model.title : '',
    href: props.model?.href != null ? props.model.href : '',
});

onMounted(() => {
    if (props.model != null) {
        form.id = props.model.id;
        form.title = props.model.title;
        form.href = props.model.href;
    }
});

const datas = reactive({
    isLoad: false,
    titleError: '',
    hrefError: '',
    generalError: '',
});

const validateTitle = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.value.length === 0) {
        return;
    }
    if (!validacion.validarSigla(target.value)) {
        datas.titleError = 'La sigla debe tener más de 2 caracteres y no contener caracteres especiales.';
    } else {
        form.title = target.value;
        datas.titleError = '';
    }
};

const validateHref = (e: Event) => {
    const target = e.target as HTMLTextAreaElement;
    if (target.value.length === 0) {
        return;
    }
    if (!validacion.validarDetalle(target.value)) {
        datas.hrefError = 'El detalle debe tener más de 2 caracteres, sin caracteres especiales.';
    } else {
        form.href = target.value;
        datas.hrefError = '';
    }
};

const create_model = async () => {
    try {
        const response = await model_service.store(form);
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
        const response = await model_service.update(form, form.id);
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
    if (form.title.length < 2) {
        datas.titleError = 'La sigla debe tener más de 2 caracteres y no contener caracteres especiales.';
        return;
    }
    if (props.isCreate) {
        await create_model();
    } else {
        await editar_model();
    }
};

const handleErrors = (error: any) => {
    if (error.response.status === 403) {
        AlertService.error('No tiene permiso para realizar esta acción.');
        return;
    }
    if (error.response.data && error.response.data.statusCode === 422) {
        const errors = error.response.data.messageError;
        datas.titleError = errors.sigla ? errors.sigla[0] : '';
        datas.hrefError = errors.detalle ? errors.detalle[0] : '';
    } else {
        AlertService.error(error.response.data.message);
        datas.generalError = 'Ocurrió un error inesperado. Por favor, inténtelo de nuevo.';
    }
};
</script>

<template>
    <Head :title="UtilsServices.capitalizeFirstLetter(model_path)" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="w-full px-11 py-6">
            <HeaderForm
                :model_path="model_path"
                :fecha_creado="props.model ? props.model.created_at.toString() : ''"
                :fecha_actualizado="props.model ? props.model.updated_at.toString() : ''"
                :isCreate="props.isCreate"
                :id_model="props.model ? props.model.id.toString() : ''"
            />
            <br />
            <hr class="mb-4" />
            <div>
                <div class="mb-4">
                    <label
                        :for="'sigla-' + model_path"
                        :class="{ 'label-error': datas.titleError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Sigla</label
                    >
                    <input
                        type="text"
                        name="sigla"
                        :id="'sigla-' + model_path"
                        v-model="form.title"
                        @input="validateTitle"
                        :class="{ 'input-error': datas.titleError }"
                        class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="Sigla"
                        required
                    />
                    <InputError class="mt-2" :message="datas.titleError.toUpperCase()" />
                </div>
                <div class="mb-4">
                    <label
                        :for="'detalle-' + model_path"
                        :class="{ 'label-error': datas.hrefError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Detalle</label
                    >
                    <textarea
                        :id="'detalle-' + model_path"
                        rows="4"
                        v-model="form.href"
                        @input="validateHref"
                        :class="{ 'input-error': datas.hrefError }"
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="Ingrese la descripción aquí"
                    ></textarea>
                    <InputError class="mt-2" :message="datas.hrefError.toUpperCase()" />
                </div>
                <button
                    type="submit"
                    @click="submit_create"
                    :class="[
                        'mb-2 me-2 flex items-center justify-center gap-2 rounded-full px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4',
                        isCreate
                            ? 'bg-blue-700 hover:bg-blue-800 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'
                            : 'bg-green-700 hover:bg-green-800 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800',
                    ]"
                >
                    {{ isCreate ? 'Crear' : 'Editar' }} {{ model_path }}
                    <DiamondPlus v-if="isCreate" class="h-4 w-4 text-gray-800 dark:text-white" />
                    <Pencil v-else class="h-4 w-4 text-white-800 dark:text-white" />
                </button>
            </div>
        </div>
    </AppLayout>
</template>
