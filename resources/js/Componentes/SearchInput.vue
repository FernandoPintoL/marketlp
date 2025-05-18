<script setup lang="ts">
import { ref } from 'vue';
import { RefreshCcw, Search } from 'lucide-vue-next';

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
    <div class="flex flex-nowrap gap-3">
        <div class="md:w-full w-80">
            <label :for="'search-'+props.modelPath" class="sr-only">Buscar</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <Search class="text-gray-500 dark:text-gray-400" />
                </div>
                <input
                    type="search"
                    v-model="query"
                    @input="onSearchQuery"
                    name="search"
                    :id="'search-'+props.modelPath"
                    class="ps-10 p-2 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    :placeholder="'Buscar por '+props.modelPath+'s'" />
            </div>
        </div>
        <button type="button"
                id="refresh-button"
                @click="refreshTable"
                class="text-gray-500 rounded cursor-pointer bg-sky-900 hover:text-gray-900 hover:bg-sky-100 dark:text-gray-400 dark:hover:bg-sky-700 dark:hover:text-white">
            <RefreshCcw class="text-white hover:text-black p-0.5" />
        </button>
    </div>
</template>
