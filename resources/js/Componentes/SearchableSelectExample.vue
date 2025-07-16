<script setup lang="ts">
import { ref } from 'vue';
import SearchableSelect from './SearchableSelect.vue';

// Example data
const options = [
  { id: 1, name: 'Opción 1', description: 'Descripción de la opción 1' },
  { id: 2, name: 'Opción 2', description: 'Descripción de la opción 2' },
  { id: 3, name: 'Opción 3', description: 'Descripción de la opción 3' },
  { id: 4, name: 'Opción 4', description: 'Descripción de la opción 4' },
  { id: 5, name: 'Opción 5', description: 'Descripción de la opción 5' },
  { id: 6, name: 'Otra opción', description: 'Otra descripción' },
  { id: 7, name: 'Elemento diferente', description: 'Descripción diferente' },
  { id: 8, name: 'Selección especial', description: 'Descripción especial' },
];

// Selected value for basic example
const selectedValue = ref('');

// Selected value for custom keys example
const selectedCustomValue = ref('');

// Handle change event
const handleChange = (option) => {
  console.log('Selected option:', option);
};
</script>

<template>
  <div class="p-6 space-y-8">
    <h1 class="text-2xl font-bold mb-4">Ejemplos de SearchableSelect</h1>

    <!-- Basic Example -->
    <div class="space-y-2">
      <h2 class="text-xl font-semibold">Ejemplo Básico</h2>
      <p class="text-gray-600 mb-2">Un selector básico con opciones de búsqueda</p>

      <div class="max-w-md">
        <SearchableSelect
          v-model="selectedValue"
          :options="options"
          label="Seleccionar una opción"
          placeholder="Buscar opciones..."
          @change="handleChange"
        />
      </div>

      <p class="mt-2">Valor seleccionado: {{ selectedValue || 'Ninguno' }}</p>
    </div>

    <!-- Required Example -->
    <div class="space-y-2">
      <h2 class="text-xl font-semibold">Ejemplo con Campo Requerido</h2>
      <p class="text-gray-600 mb-2">Un selector marcado como requerido</p>

      <div class="max-w-md">
        <SearchableSelect
          v-model="selectedValue"
          :options="options"
          label="Campo requerido"
          :required="true"
        />
      </div>
    </div>

    <!-- Disabled Example -->
    <div class="space-y-2">
      <h2 class="text-xl font-semibold">Ejemplo Deshabilitado</h2>
      <p class="text-gray-600 mb-2">Un selector en estado deshabilitado</p>

      <div class="max-w-md">
        <SearchableSelect
          v-model="selectedValue"
          :options="options"
          label="Selector deshabilitado"
          :disabled="true"
        />
      </div>
    </div>

    <!-- Custom Keys Example -->
    <div class="space-y-2">
      <h2 class="text-xl font-semibold">Ejemplo con Claves Personalizadas</h2>
      <p class="text-gray-600 mb-2">Usando claves personalizadas para valor y etiqueta</p>

      <div class="max-w-md">
        <SearchableSelect
          v-model="selectedCustomValue"
          :options="options"
          label="Seleccionar con descripción"
          valueKey="id"
          labelKey="description"
        />
      </div>

      <p class="mt-2">Valor seleccionado: {{ selectedCustomValue || 'Ninguno' }}</p>
    </div>
  </div>
</template>
