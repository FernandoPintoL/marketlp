<script setup lang="ts">
import { defineProps, defineEmits, watch, ref } from 'vue';
import { CalendarDays, Search } from 'lucide-vue-next';

const props = defineProps({
    selectedAttributes: {
        type: Object as () => Record<string, boolean>,
        required: true,
    },
    dateStart: {
        type: String,
        required: true,
    },
    dateEnd: {
        type: String,
        required: true,
    },
});

const emit = defineEmits(['update:dateStart', 'update:dateEnd', 'update:selectedAttributes', 'fetchList']);

const localSelectedAttributes = ref({ ...props.selectedAttributes });
const localDateStart = ref(props.dateStart);
const localDateEnd = ref(props.dateEnd);

watch(() => props.selectedAttributes, (newVal) => {
    localSelectedAttributes.value = { ...newVal };
});

watch(() => props.dateStart, (newVal) => {
    localDateStart.value = newVal;
});

watch(() => props.dateEnd, (newVal) => {
    localDateEnd.value = newVal;
});
</script>

<template>
    <div class="inline-flex gap-6 items-center">
        <div>
            <h3 class="mt-4 text-pretty font-semibold">BUSQUEDA POR FECHAS</h3>
            <div class="mt-1 flex gap-2">
                <label for="created_at" class="mb-2 block text-sm font-medium dark:text-white">
                    <input
                        type="checkbox"
                        class="rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                        id="created_at"
                        v-model="localSelectedAttributes['created_at']"
                        @change="$emit('update:selectedAttributes', localSelectedAttributes)"
                    />
                    Busqueda por creación
                </label>
                <label for="updated_at" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                    <input
                        type="checkbox"
                        class="rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                        id="updated_at"
                        v-model="localSelectedAttributes['updated_at']"
                        @change="$emit('update:selectedAttributes', localSelectedAttributes)"
                    />
                    Busqueda por Actualizacion
                </label>
            </div>
        </div>
        <div class="mx-auto mt-4 grid grid-cols-3 items-start gap-4 sm:flex">
            <div>
                <label for="start-time" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Fecha Inicio: </label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 end-0 top-0 flex items-center pe-3.5">
                        <CalendarDays class="w-5 h-5"/>
                    </div>
                    <input
                        type="date"
                        v-model="localDateStart.value"
                        @input="($event) => $emit('update:dateStart', $event.target?.value)"
                        id="start-time"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm leading-none text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                    />
                </div>
            </div>
            <div>
                <label for="end-time" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Fecha Fin: </label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 end-0 top-0 flex items-center pe-3.5">
                        <CalendarDays class="w-5 h-5"/>
                    </div>
                    <input
                        type="date"
                        v-model="localDateEnd.value"
                        @input="($event) => $emit('update:dateEnd', $event.target?.value)"
                        id="end-time"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm leading-none text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                    />
                </div>
            </div>
        </div>
        <div class="mt-4 flex items-center">
            <button
                type="button"
                @click="$emit('fetchList', 1)"
                class="inline-flex items-center rounded-full border border-blue-700 p-2 text-center text-sm font-medium text-blue-700 hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-300 dark:border-blue-500 dark:text-blue-500 dark:hover:bg-blue-500 dark:hover:text-white dark:focus:ring-blue-800"
            >
                <Search class="w-4 h-4" />
            </button>
        </div>
    </div>
</template>

<style scoped></style>
