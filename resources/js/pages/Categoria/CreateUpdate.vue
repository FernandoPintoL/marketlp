<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {route} from "ziggy-js";
import InputError from "@/Components/InputError.vue";
import CategoriaService from "@/Services/CategoriaService.js";
import {onMounted, reactive} from "vue";
import {useForm} from "@inertiajs/vue3";
import AlertService from "@/Services/AlertService.js";
import HeaderForm from "@/Componentes/Header-Form.vue";
import ValidacionService from "@/Services/ValidacionService.js";

const model_service = CategoriaService;
const model_path = model_service.path_url;
const validacion = ValidacionService;

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
})

const form = useForm({
    id: props.model != null ? props.model.id : '',
    sigla: props.model != null ? props.model.sigla : '',
    detalle: props.model != null ? props.model.detalle : '',
})

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
})

const validateSigla = (e) => {
    if(e.target.value.length === 0) {
        return;
    }
    if (!validacion.validarSigla(e.target.value)) {
        datas.siglaError = 'La sigla debe tener más de 2 caracteres y no contener caracteres especiales.';
    } else {
        form.sigla = e.target.value;
        datas.siglaError = '';
    }
};

const validateDetalle = (e) => {
    if(e.target.value.length === 0) {
        return;
    }
    if (!validacion.validarDetalle(e.target.value)) {
        datas.detalleError = 'El detalle debe tener más de 2 caracteres, sin caracteres especiales.';
    } else {
        form.detalle = e.target.value;
        datas.detalleError = '';
    }
};

const create = async () => {
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
}

const editar = async () => {
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
}

const submit_create = async () => {
    if(form.sigla.length < 2) {
        datas.siglaError = 'La sigla debe tener más de 2 caracteres y no contener caracteres especiales.';
        return;
    }
    if (props.isCreate) {
        await create();
    } else {
        await editar();
    }
}

const handleErrors = (error) => {
    if (error.response.data && error.response.data.statusCode === 422) {
        const errors = error.response.data.messageError;
        datas.siglaError = errors.sigla ? errors.sigla[0] : '';
        datas.detalleError = errors.detalle ? errors.detalle[0] : '';
    } else {
        datas.generalError = 'Ocurrió un error inesperado. Por favor, inténtelo de nuevo.';
    }
};
</script>

<template>
    <AppLayout :title="props.isCreate ? 'Crear '+model_path : 'Editar '+model_path">
        <div class="mx-auto px-4 py-6">
            <HeaderForm :model_path="model_path"
                        :isCreate="props.isCreate"
                        :id_model="props.model ? props.model.id.toString() : ''"/>
            <div>
                <div class="mb-4">
                    <label :for="'sigla-'+model_path"
                           :class="{'label-error': datas.siglaError}"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sigla</label>
                    <input type="text"
                           name="sigla"
                           :id="'sigla-'+model_path"
                           v-model="form.sigla"
                           @input="validateSigla"
                           :class="{'input-error': datas.siglaError}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           placeholder="Sigla" required="">
                    <InputError class="mt-2" :message="datas.siglaError.toUpperCase()"/>
                </div>
                <div class="mb-4">
                    <label :for="'detalle-'+model_path"
                           :class="{'label-error': datas.detalleError}"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Detalle</label>
                    <textarea :id="'detalle-'+model_path"
                              rows="4"
                              v-model="form.detalle"
                              @input="validateDetalle"
                              :class="{'input-error': datas.detalleError}"
                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                              placeholder="Ingrese la descripción aquí"></textarea>
                    <InputError class="mt-2" :message="datas.detalleError.toUpperCase()"/>
                </div>
                <button type="submit"
                        @click="submit_create"
                        class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    {{ isCreate ? 'Crear' : 'Editar' }} {{ model_path }}
                </button>
            </div>
        </div>
    </AppLayout>
</template>

