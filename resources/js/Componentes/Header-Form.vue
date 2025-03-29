<script setup lang="ts">
import UtilsServices from "../Services/UtilsServices.js";
import { CalendarCog, CalendarDays } from 'lucide-vue-next';

const props = defineProps({
    model_path: {
        type: String,
        default: '',
    },
    isCreate: {
        type: Boolean,
        default: true, // Valor por defecto puede ser true o false
    },
    id_model: {
        type: String,
        default: '' // Valor por defecto puede ser 0
    },
    fecha_creado: {
        type: String,
        default: ''
    },
    fecha_actualizado: {
        type: String,
        default: ''
    }
})
</script>

<template>
    <h5 v-if="props.isCreate" class="inline-flex items-center mb-6 text-lg font-semibold text-gray-500 uppercase dark:text-gray-400">
        Crear {{ props.model_path }}
    </h5>
    <h5 v-else class="inline-flex items-center mb-6 text-lg font-semibold text-gray-500 uppercase dark:text-gray-400">
        Editar {{ props.model_path }} | ID: {{ props.id_model }}
    </h5>
    <br v-if="props.fecha_creado.length > 0" />
    <p v-if="props.fecha_creado.length > 0" class="inline-flex gap-2 justify-center text-sm text-gray-900 dark:text-white">
        <small class="inline-flex">
            <CalendarDays class="h-4 w-4 text-gray-800 dark:text-white" />
            Creación:
        </small>
        {{ UtilsServices.fecha(props.fecha_creado) }}
    </p>
    <br v-if="props.fecha_creado.length > 0" />
    <p v-if="props.fecha_actualizado.length > 0" class="inline-flex gap-2 justify-center text-sm text-gray-900 dark:text-white">
        <small class="inline-flex">
            <CalendarCog class="h-4 w-4 text-gray-800 dark:text-white" />
            Actualización:
        </small>
        {{ UtilsServices.fecha(props.fecha_actualizado) }}
    </p>
    <br v-if="props.fecha_actualizado.length > 0" />
</template>
