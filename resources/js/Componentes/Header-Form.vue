<script setup lang="ts">
import UtilsServices from "../Services/UtilsServices.js";

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
    <p v-if="props.fecha_creado.length > 0" class="inline-flex text-sm text-gray-900 dark:text-white">
        <svg class="w-[17px] h-[17px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
        </svg>
         Fecha de creación: {{ UtilsServices.fecha(props.fecha_creado) }}
    </p>
    <br v-if="props.fecha_creado.length > 0" />
    <p v-if="props.fecha_actualizado.length > 0" class="inline-flex text-sm text-gray-900 dark:text-white">
        <svg class="w-[17px] h-[17px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
        </svg>
         Fecha de actualización: {{ UtilsServices.fecha(props.fecha_actualizado) }}
    </p>
    <br v-if="props.fecha_actualizado.length > 0" />
</template>
