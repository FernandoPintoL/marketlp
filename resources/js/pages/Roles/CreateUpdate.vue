<script setup lang="ts">
import HeaderForm from '@/Componentes/Header-Form.vue';
import AlertService from '@/Services/AlertService.js';
import UtilsServices from '@/Services/UtilsServices';
import InputError from '@/components/InputError.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { onMounted, reactive } from 'vue';
import { route } from 'ziggy-js';
import { Pencil, DiamondPlus } from 'lucide-vue-next';
import RolesService from '@/Services/RolesService';
import axios from 'axios';

const model_service = RolesService;
const model_path = model_service.path_url;

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
    name: props.model != null ? props.model.name : '',
    guard_name: props.model != null ? props.model.guard_name : 'web',
    permissions: [],
});

onMounted(() => {
    if (props.model != null) {
        form.id = props.model.id;
        form.name = props.model.name;
        form.guard_name = props.model.guard_name;

        // Load permissions for this role
        loadRolePermissions(props.model.id);
    }

    // Load all available permissions
    loadAllPermissions();
});

const datas = reactive({
    isLoad: false,
    nameError: '',
    guard_nameError: '',
    permissionsError: '',
    generalError: '',
    allPermissions: [],
    selectedPermissions: [],
});

const loadAllPermissions = async () => {
    try {
        const response = await axios.get(route('roles.permissions'));
        if (response.data.isSuccess) {
            datas.allPermissions = response.data.data;
        } else {
            AlertService.error('Error al cargar los permisos');
        }
    } catch (error) {
        console.error('Error loading permissions:', error);
        AlertService.error('Error al cargar los permisos');
    }
};

const loadRolePermissions = async (roleId: number) => {
    try {
        const response = await axios.get(route('roles.getPermissions', roleId));
        if (response.data.isSuccess) {
            datas.selectedPermissions = response.data.data;
            form.permissions = response.data.data;
        } else {
            AlertService.error('Error al cargar los permisos del rol');
        }
    } catch (error) {
        console.error('Error loading role permissions:', error);
        AlertService.error('Error al cargar los permisos del rol');
    }
};

const validateName = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.value.length === 0) {
        datas.nameError = 'El nombre es requerido.';
        return;
    }
    if (target.value.length < 2) {
        datas.nameError = 'El nombre debe tener al menos 2 caracteres.';
    } else {
        form.name = target.value;
        datas.nameError = '';
    }
};

const validateGuardName = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.value.length === 0) {
        datas.guard_nameError = 'El guard name es requerido.';
        return;
    }
    form.guard_name = target.value;
    datas.guard_nameError = '';
};

const handlePermissionChange = (permissionId: number, checked: boolean) => {
    if (checked) {
        if (!datas.selectedPermissions.includes(permissionId)) {
            datas.selectedPermissions.push(permissionId);
        }
    } else {
        const index = datas.selectedPermissions.indexOf(permissionId);
        if (index !== -1) {
            datas.selectedPermissions.splice(index, 1);
        }
    }
    form.permissions = datas.selectedPermissions;
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
    // Validate required fields
    let hasErrors = false;

    if (!form.name || form.name.length < 2) {
        datas.nameError = 'El nombre es requerido y debe tener al menos 2 caracteres.';
        hasErrors = true;
    }

    if (!form.guard_name) {
        datas.guard_nameError = 'El guard name es requerido.';
        hasErrors = true;
    }

    if (hasErrors) {
        return;
    }

    // Create or update the role
    if (props.isCreate) {
        await create_model();
    } else {
        await editar_model();
    }

    // If we're editing a role, assign permissions after the role is updated
    if (!props.isCreate && form.id) {
        await assignPermissionsToRole(form.id);
    }
};

const assignPermissionsToRole = async (roleId: number) => {
    try {
        const response = await axios.post(route('roles.assignPermissions', roleId), {
            permissions: datas.selectedPermissions
        });

        if (response.data.isSuccess) {
            console.log('Permissions assigned successfully');
        } else {
            AlertService.error('Error al asignar los permisos al rol');
        }
    } catch (error) {
        console.error('Error assigning permissions:', error);
        AlertService.error('Error al asignar los permisos al rol');
    }
};

const handleErrors = (error: any) => {
    if (error.response.status === 403) {
        AlertService.error('No tiene permiso para realizar esta acción.');
        return;
    }
    if (error.response.data && error.response.data.statusCode === 422) {
        const errors = error.response.data.messageError;
        datas.nameError = errors.name ? errors.name[0] : '';
        datas.guard_nameError = errors.guard_name ? errors.guard_name[0] : '';
        datas.permissionsError = errors.permissions ? errors.permissions[0] : '';
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
                        for="name"
                        :class="{ 'label-error': datas.nameError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Nombre *</label
                    >
                    <input
                        type="text"
                        name="name"
                        id="name"
                        v-model="form.name"
                        @input="validateName"
                        :class="{ 'input-error': datas.nameError }"
                        class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="Nombre del rol"
                        required
                    />
                    <InputError class="mt-2" :message="datas.nameError" />
                </div>
                <div class="mb-4">
                    <label
                        for="guard_name"
                        :class="{ 'label-error': datas.guard_nameError }"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Guard Name *</label
                    >
                    <input
                        type="text"
                        name="guard_name"
                        id="guard_name"
                        v-model="form.guard_name"
                        @input="validateGuardName"
                        :class="{ 'input-error': datas.guard_nameError }"
                        class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="web"
                        required
                    />
                    <InputError class="mt-2" :message="datas.guard_nameError" />
                </div>

                <!-- Permissions Section -->
                <div class="mb-4">
                    <label
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >Permisos</label
                    >
                    <div class="mt-2 grid grid-cols-1 gap-2 md:grid-cols-2 lg:grid-cols-3">
                        <div v-for="permission in datas.allPermissions" :key="permission.id" class="flex items-center">
                            <input
                                type="checkbox"
                                :id="'permission-' + permission.id"
                                :value="permission.id"
                                :checked="datas.selectedPermissions.includes(permission.id)"
                                @change="handlePermissionChange(permission.id, $event.target.checked)"
                                class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                            />
                            <label :for="'permission-' + permission.id" class="ml-2 text-sm text-gray-700">
                                {{ permission.name }}
                            </label>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="datas.permissionsError" />
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
