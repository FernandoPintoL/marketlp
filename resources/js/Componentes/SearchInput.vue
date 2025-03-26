<script setup lang="ts">
import { ref } from 'vue';

const props = defineProps({
    modelPath: {
        type: String,
        required: true
    }
});

const emits = defineEmits(['update:query']);

const query = ref('');

const onSearchQuery = (e) => {
    emits('update:query', e.target.value);
};
</script>

<template>
<!--    <div class="flex items-start mb-4 sm:mb-0">
        <div class="sm:pr-3">
            <label :for="'search-'+props.modelPath" class="sr-only">Buscar</label>
            <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                <input type="text"
                       v-model="query"
                       @input="onSearchQuery"
                       :id="'search-'+props.modelPath"
                       class="text-black border border-gray-300 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                       :placeholder="'Buscar por '+props.modelPath+'s'">
            </div>
        </div>
    </div>-->
    <div class="flex items-start mb-4 sm:mb-0 pr-2">
        <label :for="'search-'+props.modelPath" class="mb-2 text-xs font-thin text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search"
                   v-model="query"
                   @input="onSearchQuery"
                   :id="'search-'+props.modelPath"
                   class="block w-full px-4 py-2 ps-10 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   :placeholder="'Buscar por '+props.modelPath+'s'" />
<!--            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>-->
        </div>
    </div>
</template>

<style scoped>

</style>
