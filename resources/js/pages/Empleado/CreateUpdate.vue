<script setup lang="ts">
import HeaderForm from '@/Componentes/Header-Form.vue';
import AlertService from '@/Services/AlertService.js';
import UtilsServices from '@/Services/UtilsServices';
import ValidacionService from '@/Services/ValidacionService.js';
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, reactive, ref } from 'vue';
import { route } from 'ziggy-js';
import { Pencil, DiamondPlus } from 'lucide-vue-next';
import EmpleadoService from '@/Services/EmpleadoService';
import type { Empleado } from '@/Data/Empleado';
import type { EmpleadoCargo } from '@/Data/EmpleadoCargo';
import type { TipoDocumento } from '@/Data/TipoDocumento';

const model_service = EmpleadoService;
const model_path = model_service.path_url;
const validacion = ValidacionService;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: model_path.toUpperCase(),
        href: '/' + model_path,
    },
];

const props = defineProps({
    model: {
        type: Object as () => Empleado | null,
        default: null,
    },
    tipoDocumentos: {
        type: Array as () => TipoDocumento[],
        default: () => [],
    },
    empleadoCargos: {
        type: Array as () => EmpleadoCargo[],
        default: () => [],
    },
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
    name: props.model != null ? props.model.name : '',
    num_id: props.model != null ? props.model.num_id : '',
    tipo_documento_id: props.model != null ? props.model.tipo_documento_id : '',
    direccion: props.model != null ? props.model.direccion : '',
    telefono: props.model != null ? props.model.telefono : '',
    email: props.model != null ? props.model.email : '',
    empleado_cargo_id: props.model != null ? props.model.empleado_cargo_id : '',
    user_id: props.model != null ? props.model.user_id : '',
});

const tipoDocumentos = ref<TipoDocumento[]>(props.tipoDocumentos);
const empleadoCargos = ref<EmpleadoCargo[]>(props.empleadoCargos);

onMounted(() => {
    tipoDocumentos.value = props.tipoDocumentos as TipoDocumento[];
    empleadoCargos.value = props.empleadoCargos as EmpleadoCargo[];
    if (props.model != null) {
        form.id = props.model.id;
        form.name = props.model.name;
        form.num_id = props.model.num_id;
        form.tipo_documento_id = props.model.tipo_documento_id;
        form.direccion = props.model.direccion;
        form.telefono = props.model.telefono;
        form.email = props.model.email;
        form.empleado_cargo_id = props.model.empleado_cargo_id;
        form.user_id = props.model.user_id;
    }
});

const datas = reactive({
    isLoad: false,
    nameError: '',
    numIdError: '',
    tipoDocumentoIdError: '',
    direccionError: '',
    telefonoError: '',
    emailError: '',
    empleadoCargoIdError: '',
    userIdError: '',
    generalError: '',
});

const inputs_ids = {
    name: 'name',
    numId: 'numId',
    telefono: 'telefono',
    email: 'email',
    direccion: 'direccion',
    tipo_documento_id: 'tipo_documento_id',
    empleado_cargo_id: 'empleado_cargo_id',
    userId: 'userId',
}

const validateName = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.value.length === 0) {
        return;
    }
    if (!validacion.validarNombre(target.value)) {
        datas.nameError = 'El nombre debe tener más de 2 caracteres y no contener caracteres especiales.';
    } else {
        form.name = target.value;
        datas.nameError = '';
    }
};
const validateNumId = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.value.length === 0) {
        return;
    }
    if (!validacion.validarNumero(target.value)) {
        datas.numIdError = 'El número de identificación debe tener entre 5 y 20 caracteres y no contener caracteres especiales.';
    } else {
        form.num_id = target.value;
        datas.numIdError = '';
    }
};
const validateTipoDocumentoId = (e: Event) => {
    const target = e.target as HTMLSelectElement;
    if (target.value.length === 0) {
        return;
    }
    if (!validacion.validarNumero(target.value)) {
        datas.tipoDocumentoIdError = 'El tipo de documento es obligatorio.';
    } else {
        form.tipo_documento_id = target.value;
        datas.tipoDocumentoIdError = '';
    }
};
const validateDireccion = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.value.length === 0) {
        return;
    }
    if (!validacion.validarDireccion(target.value)) {
        datas.direccionError = 'La dirección debe tener más de 2 caracteres y no contener caracteres especiales.';
    } else {
        form.direccion = target.value;
        datas.direccionError = '';
    }
};
const validateTelefono = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.value.length === 0) {
        return;
    }
    if (!validacion.validarTelefono(target.value)) {
        datas.telefonoError = 'El teléfono debe tener entre 5 y 20 caracteres y no contener caracteres especiales.';
    } else {
        form.telefono = target.value;
        datas.telefonoError = '';
    }
};
const validateEmail = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.value.length === 0) {
        return;
    }
    if (!validacion.validarEmail(target.value)) {
        datas.emailError = 'El correo electrónico no es válido.';
    } else {
        form.email = target.value;
        datas.emailError = '';
    }
};
const validateEmpleadoCargoId = (e: Event) => {
    const target = e.target as HTMLSelectElement;
    if (target.value.length === 0) {
        return;
    }
    if (!validacion.validarNumero(target.value)) {
        datas.empleadoCargoIdError = 'El cargo del empleado es obligatorio.';
    } else {
        form.empleado_cargo_id = target.value;
        datas.empleadoCargoIdError = '';
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
        for (const key in errors) {
            if (errors.hasOwnProperty(key)) {
                const errorMessage = errors[key];
                if (key === inputs_ids.name) {
                    datas.nameError = errorMessage;
                } else if (key === inputs_ids.numId) {
                    datas.numIdError = errorMessage;
                } else if (key === inputs_ids.tipo_documento_id) {
                    datas.tipoDocumentoIdError = errorMessage;
                } else if (key === inputs_ids.direccion) {
                    datas.direccionError = errorMessage;
                } else if (key === inputs_ids.telefono) {
                    datas.telefonoError = errorMessage;
                } else if (key === inputs_ids.email) {
                    datas.emailError = errorMessage;
                } else if (key === inputs_ids.empleado_cargo_id) {
                    datas.empleadoCargoIdError = errorMessage;
                } else if (key === inputs_ids.userId) {
                    datas.userIdError = errorMessage;
                }
            }
        }
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
                <!--                Nombre-->
                <div class="mb-4">
                    <label
                        :for="inputs_ids.name+'-'+ model_path"
                        :class="{ 'label-error': datas.nameError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                    >Nombre</label>
                    <input
                        type="text"
                        name="Nombre"
                        :id="inputs_ids.name+'-'+ model_path"
                        v-model="form.name"
                        @input="validateName"
                        :class="{ 'input-error': datas.nameError }"
                        class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="Nombre"
                        required
                    />
                    <InputError class="mt-2" :message="datas.nameError.toUpperCase()" />
                </div>
                <!--                Número de identificación-->
                <div class="mb-4">
                    <label
                        :for="inputs_ids.numId+'-'+ model_path"
                        :class="{ 'label-error': datas.numIdError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                    >Número de identificación</label>
                    <input
                        type="text"
                        name="numId"
                        :id="inputs_ids.numId+'-'+ model_path"
                        v-model="form.num_id"
                        @input="validateNumId"
                        :class="{ 'input-error': datas.numIdError }"
                        class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="Número de identificación"
                        required
                    />
                    <InputError class="mt-2" :message="datas.numIdError.toUpperCase()" />
                </div>
                <!--                Tipo de documento-->
                <div class="mb-4">
                    <label
                        :for="inputs_ids.tipo_documento_id+'-'+ model_path"
                        :class="{ 'label-error': datas.tipoDocumentoIdError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                    >Tipo de documento</label>
                    <select
                        :id="inputs_ids.tipo_documento_id+'-'+ model_path"
                        v-model="form.tipo_documento_id"
                        @change="validateTipoDocumentoId"
                        :class="{ 'input-error': datas.tipoDocumentoIdError }"
                        class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    >
                        <option value="">Seleccione un tipo de documento</option>
                        <option v-for="tipoDocumento in tipoDocumentos" :key="tipoDocumento.id" :value="tipoDocumento.id">
                            {{ tipoDocumento.detalle }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="datas.tipoDocumentoIdError.toUpperCase()" />
                </div>
                <!--                Dirección-->
                <div class="mb-4">
                    <label
                        :for="inputs_ids.direccion+'-'+ model_path"
                        :class="{ 'label-error': datas.direccionError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                    >Dirección</label>
                    <input
                        type="text"
                        name="Dirección"
                        :id="inputs_ids.direccion+'-'+ model_path"
                        v-model="form.direccion"
                        @input="validateDireccion"
                        :class="{ 'input-error': datas.direccionError }"
                        class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="Dirección"
                        required
                    />
                    <InputError class="mt-2" :message="datas.direccionError.toUpperCase()" />
                </div>
                <!--                Teléfono-->
                <div class="mb-4">
                    <label
                        :for="inputs_ids.telefono+'-'+ model_path"
                        :class="{ 'label-error': datas.telefonoError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                    >Teléfono</label>
                    <input
                        type="text"
                        name="Teléfono"
                        :id="inputs_ids.telefono+'-'+ model_path"
                        v-model="form.telefono"
                        @input="validateTelefono"
                        :class="{ 'input-error': datas.telefonoError }"
                        class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="Teléfono"
                        required
                    />
                    <InputError class="mt-2" :message="datas.telefonoError.toUpperCase()" />
                </div>
                <!--                Email-->
                <div class="mb-4">
                    <label
                        :for="inputs_ids.email+'-'+ model_path"
                        :class="{ 'label-error': datas.emailError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                    >Email</label>
                    <input
                        type="email"
                        name="Email"
                        :id="inputs_ids.email+'-'+ model_path"
                        v-model="form.email"
                        @input="validateEmail"
                        :class="{ 'input-error': datas.emailError }"
                        class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="Email"
                        required
                    />
                    <InputError class="mt-2" :message="datas.emailError.toUpperCase()" />
                </div>
                <!--                Cargo del empleado-->
                <div class="mb-4">
                    <label
                        :for="inputs_ids.empleado_cargo_id+'-'+ model_path"
                        :class="{ 'label-error': datas.empleadoCargoIdError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                    >Cargo del empleado</label>
                    <select
                        :id="inputs_ids.empleado_cargo_id+'-'+ model_path"
                        v-model="form.empleado_cargo_id"
                        @change="validateEmpleadoCargoId"
                        :class="{ 'input-error': datas.empleadoCargoIdError }"
                        class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    >
                        <option value="">Seleccione un cargo de empleado</option>
                        <option v-for="empleadoCargo in empleadoCargos" :key="empleadoCargo.id" :value="empleadoCargo.id">
                            {{ empleadoCargo.detalle }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="datas.empleadoCargoIdError.toUpperCase()" />
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
                    <Pencil v-else class="h-4 w-4 text-gray-800 dark:text-white" />
                </button>
            </div>
        </div>
    </AppLayout>
</template>
