<script setup lang="ts">
</script>

<template>
    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
        <thead class="">
            <slot name="thead"/>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            <slot name="tbody"/>
        </tbody>
    </table>
<!--    <FootTable v-show="props.mostrarfoot" />-->
</template>

<style scoped>

</style>
