<script setup lang="ts">
import {route} from "ziggy-js";

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
          class="self-start text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-thin rounded-lg text-xs px-4 py-2 dark:bg-sky-600 dark:hover:bg-sky-700 focus:outline-none dark:focus:ring-sky-800">
        NUEVO - {{ props.model_path.toUpperCase() }}
    </a>
</template>

<style scoped>

</style>
