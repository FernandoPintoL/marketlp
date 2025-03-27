<script setup lang="ts">
import { defineProps, defineEmits, ref, watch } from 'vue';

const props = defineProps({
    currentPage: {
        type: Number,
        required: true,
    },
    lastPages: {
        type: Number,
        required: true,
    },
    totalItems: {
        type: Number,
        required: true,
    },
    totalPages: {
        type: Number,
        required: true,
    },
    perPage: {
        type: Number,
        required: true,
    },
});

const emit = defineEmits(['page-changed', 'per-page-changed']);
const localPerPage = ref(props.perPage);

watch(() => props.perPage, (newVal) => {
    localPerPage.value = newVal;
});

const changePage = (page: number) => {
    if (page >= 1 && page <= props.totalPages) {
        emit('page-changed', page);
    }
};

const changePerPage = (event: Event) => {
    const target = event.target as HTMLSelectElement;
    emit('per-page-changed', parseInt(target.value));
};
</script>

<template>
    <div class="flex justify-center mt-4 mb-4">
        <button
            @click="changePage(props.currentPage - 1)"
            :disabled="props.currentPage === 1"
            class="px-4 py-2 mx-1 text-sm font-medium text-white bg-gray-800 rounded-md hover:bg-gray-700 disabled:opacity-50">
            Anterior
        </button>
        <span class="px-4 py-2 mx-1 text-sm font-medium text-gray-700">
            Página {{ props.currentPage }} de {{ props.totalPages }}
        </span>
        <button
            @click="changePage(props.currentPage + 1)"
            :disabled="props.currentPage === props.totalPages"
            class="px-4 py-2 mx-1 text-sm font-medium text-white bg-gray-800 rounded-md hover:bg-gray-700 disabled:opacity-50">
            Siguiente
        </button>
        <span class="px-4 py-2 mx-1 text-sm font-medium text-gray-700">
            Total de registros: {{ props.totalItems }}
        </span>
        <div class="flex items-center ml-4">
            <label for="perPage"
                   class="block mb-2 text-xs font-thin text-gray-900 dark:text-white">
                Elementos por página:</label>
            <select id="perPage"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    v-model="localPerPage"
                    @change="changePerPage">
                <option v-for="option in [5, 10, 50, 100]" :key="option" :value="option">{{ option }}</option>
            </select>
        </div>
    </div>
</template>

<style scoped>

</style>
