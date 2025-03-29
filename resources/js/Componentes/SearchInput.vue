<script setup lang="ts">
import { ref } from 'vue';

const props = defineProps({
    modelPath: {
        type: String,
        required: true
    }
});

const emits = defineEmits(['update:query', 'refresh']);

const query = ref('');

const onSearchQuery = (e : any) => {
    const target = e.target as HTMLSelectElement;
    emits('update:query', target.value);
};

const refreshTable = () => {
    query.value = '';
    emits('refresh');
};
</script>

<template>
    <div class="flex items-center mb-4 sm:mb-0">
        <div class="sm:pr-3 w-full sm:w-auto">
            <label :for="'search-'+props.modelPath" class="sr-only">Buscar</label>
            <div class="relative w-full sm:w-64 xl:w-96 mt-1">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                         aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input
                    type="search"
                    v-model="query"
                    @input="onSearchQuery"
                    name="search"
                    :id="'search-'+props.modelPath"
                    class="px-4 py-2 ps-10 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    :placeholder="'Buscar por '+props.modelPath+'s'" />
            </div>
        </div>
        <div class="flex items-center w-full sm:justify-end">
            <div class="flex pl-2 space-x-1">
                <button type="button"
                        id="refresh-button"
                        @click="refreshTable"
                        class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer bg-sky-900 hover:text-gray-900 hover:bg-sky-100 dark:text-gray-400 dark:hover:bg-sky-700 dark:hover:text-white">
                    <svg class="w-4 h-4 text-white"
                         aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg"
                         width="24"
                         height="24"
                         fill="none"
                         viewBox="0 0 24 24">
                        <path stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
