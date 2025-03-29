<script setup lang="ts">
import {route} from "ziggy-js";
import { DiamondPlus } from 'lucide-vue-next';

const props = defineProps({
    model_path: {
        type: String,
        required: true
    },
    crear: {
        type: Boolean,
        default: true
    }
});

</script>

<template>
    <a v-if="props.crear" :href="route(model_path+'.create')"
          :id="'create-'+props.model_path"
          class="flex justify-center items-center gap-2 self-start text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-thin rounded-lg text-xs px-4 py-2 dark:bg-sky-600 dark:hover:bg-sky-700 focus:outline-none dark:focus:ring-sky-800">
        NUEVO - {{ props.model_path.toUpperCase() }}
        <DiamondPlus class="h-4 w-4 text-white"/>
    </a>
</template>

<style scoped>

</style>
