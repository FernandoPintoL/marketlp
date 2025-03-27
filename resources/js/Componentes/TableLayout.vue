<script setup lang="ts"></script>

<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full table-fixed divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="">
                            <slot name="thead" />
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <slot name="tbody" />
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--    <FootTable v-show="props.mostrarfoot" />-->
</template>

<style scoped></style>
