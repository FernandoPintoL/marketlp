<script setup lang="ts">
import HeaderForm from '@/Componentes/Header-Form.vue';
import AlertService from '@/Services/AlertService.js';
import CategoriaService from '@/Services/CategoriaService.js';
import UtilsServices from '@/Services/UtilsServices';
import ValidacionService from '@/Services/ValidacionService.js';
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, reactive } from 'vue';
import { route } from 'ziggy-js';

const model_service = CategoriaService;
const model_path = model_service.path_url;
const validacion = ValidacionService;

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

const form = useForm({
    id: props.model != null ? props.model.id : '',
    sigla: props.model != null ? props.model.sigla : '',
    detalle: props.model != null ? props.model.detalle : '',
});

onMounted(() => {
    if (props.model != null) {
        form.id = props.model.id;
        form.sigla = props.model.sigla;
        form.detalle = props.model.detalle;
    }
});

const datas = reactive({
    isLoad: false,
    siglaError: '',
    detalleError: '',
    generalError: '',
});

const validateSigla = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.value.length === 0) {
        return;
    }
    if (!validacion.validarSigla(target.value)) {
        datas.siglaError = 'La sigla debe tener más de 2 caracteres y no contener caracteres especiales.';
    } else {
        form.sigla = target.value;
        datas.siglaError = '';
    }
};

const validateDetalle = (e: Event) => {
    const target = e.target as HTMLTextAreaElement;
    if (target.value.length === 0) {
        return;
    }
    if (!validacion.validarDetalle(target.value)) {
        datas.detalleError = 'El detalle debe tener más de 2 caracteres, sin caracteres especiales.';
    } else {
        form.detalle = target.value;
        datas.detalleError = '';
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
    if (form.sigla.length < 2) {
        datas.siglaError = 'La sigla debe tener más de 2 caracteres y no contener caracteres especiales.';
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
        datas.siglaError = errors.sigla ? errors.sigla[0] : '';
        datas.detalleError = errors.detalle ? errors.detalle[0] : '';
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
                :fecha_creado="props.model ? props.model.created_at : ''"
                :fecha_actualizado="props.model ? props.model.updated_at : ''"
                :isCreate="props.isCreate"
                :id_model="props.model ? props.model.id.toString() : ''"
            />
            <br />
            <hr class="mb-4" />
            <div>
                <div class="mb-4">
                    <label
                        :for="'sigla-' + model_path"
                        :class="{ 'label-error': datas.siglaError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Sigla</label
                    >
                    <input
                        type="text"
                        name="sigla"
                        :id="'sigla-' + model_path"
                        v-model="form.sigla"
                        @input="validateSigla"
                        :class="{ 'input-error': datas.siglaError }"
                        class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="Sigla"
                        required
                    />
                    <InputError class="mt-2" :message="datas.siglaError.toUpperCase()" />
                </div>
                <div class="mb-4">
                    <label
                        :for="'detalle-' + model_path"
                        :class="{ 'label-error': datas.detalleError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Detalle</label
                    >
                    <textarea
                        :id="'detalle-' + model_path"
                        rows="4"
                        v-model="form.detalle"
                        @input="validateDetalle"
                        :class="{ 'input-error': datas.detalleError }"
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="Ingrese la descripción aquí"
                    ></textarea>
                    <InputError class="mt-2" :message="datas.detalleError.toUpperCase()" />
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
                    <svg
                        v-if="isCreate"
                        class="h-6 w-6 text-gray-800 dark:text-white"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 5v14m-8-7h2m0 0h2m-2 0v2m0-2v-2m12 1h-6m6 4h-6M4 19h16c.5523 0 1-.4477 1-1V6c0-.55228-.4477-1-1-1H4c-.55228 0-1 .44772-1 1v12c0 .5523.44772 1 1 1Z"
                        />
                    </svg>
                    <svg
                        v-else
                        class="h-6 w-6 text-gray-800 dark:text-white"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </AppLayout>
</template>
