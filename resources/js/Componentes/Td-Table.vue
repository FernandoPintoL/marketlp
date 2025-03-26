<script setup lang="ts">
import { route } from 'ziggy-js';

const props = defineProps({
    creado: {
        type: String,
    },
    actualizado: {
        type: String,
    },
    model_path: {
        type: String,
        required: true
    },
    itemId: {
        type: [String, Number],
        required: true
    },
    onDelete: {
        type: Function,
        required: true
    }
});
</script>

<template>
    <td class="p-4 text-xs font-thin text-gray-900 whitespace-nowrap dark:text-white">
        Creado: {{ props.creado }}
        <br/>
        Actualizado: {{ props.actualizado }}
        <br/>
        <a :href="route(props.model_path + '.edit', props.itemId)"
           class="inline-flex items-center px-3 py-2 text-xs font-thin text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                <path fill-rule="evenodd"
                      d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                      clip-rule="evenodd"></path>
            </svg>
            Editar
        </a>
        <button type="button" @click="onDelete(props.itemId)"
                class="inline-flex items-center px-3 py-2 text-xs font-thin text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                      clip-rule="evenodd"></path>
            </svg>
            Eliminar
        </button>
    </td>
</template>

<style scoped>

</style>
