<script setup lang="ts">
import { Info } from 'lucide-vue-next';

const props = defineProps({
    message: {
        type: String,
        default: '',
    },
})
</script>

<template>
    <div id="alert-border-5" class="flex items-center p-4 border-t-4 w-full border-gray-300 bg-gray-50 dark:bg-gray-800 dark:border-gray-600" role="alert">
        <Info />
        <div class="ms-3 text-sm font-medium text-gray-800 dark:text-gray-300">
            {{ props.message }}
        </div>
    </div>
</template>

<style scoped>

</style>
