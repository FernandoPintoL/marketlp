<script setup lang="ts">
import { route } from 'ziggy-js';
import { Pencil, Trash2 } from 'lucide-vue-next';

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
        <div class="block">
            <small>Creado: </small> <b>{{ props.creado }}</b>
        </div>
        <div class="block">
            <small>Actualizado: </small> <b>{{ props.actualizado }}</b>
        </div>
        <a :href="route(props.model_path + '.edit', props.itemId)"
           class="inline-flex gap-2 p-2 mr-2 text-xs font-thin text-center text-white rounded-lg bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-blue-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            <Pencil class="h-4 w-4 text-white" />
            Editar
        </a>
        <button type="button" @click="onDelete(props.itemId)"
                class="inline-flex gap-2 p-2 text-xs font-thin text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
            <Trash2 class="h-4 w-4 text-white" />
            Eliminar
        </button>
    </td>
</template>

<style scoped>

</style>
