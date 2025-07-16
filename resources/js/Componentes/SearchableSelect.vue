<script setup lang="ts">
import { ref, computed, watch, onMounted, onUnmounted } from 'vue';
import { Search, ChevronDown, ChevronUp, Check } from 'lucide-vue-next';

const props = defineProps({
  options: {
    type: Array,
    required: true,
    default: () => []
  },
  modelValue: {
    type: [String, Number, Object, null], // Permite también Object para evitar el warning si alguna vez se pasa un objeto
    default: ''
  },
  label: {
    type: String,
    default: 'Seleccionar'
  },
  placeholder: {
    type: String,
    default: 'Buscar...'
  },
  valueKey: {
    type: String,
    default: 'id'
  },
  labelKey: {
    type: String,
    default: 'name'
  },
  required: {
    type: Boolean,
    default: false
  },
  disabled: {
    type: Boolean,
    default: false
  },
  error: {
    type: String,
    default: ''
  }
});

const emit = defineEmits(['update:modelValue', 'change']);

const isOpen = ref(false);
const searchQuery = ref('');
const selectedOption = ref(null);
const dropdownRef = ref(null);

// Find the initially selected option
onMounted(() => {
    console.log(props.options);
  if (props.modelValue && props.options && props.options.length > 0) {
    const option = props.options.find(opt => opt && opt[props.valueKey] === props.modelValue);
    if (option) {
      selectedOption.value = option;
    }
  }

  // Add click outside listener
  document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
});

// Filter options based on a search query
const filteredOptions = computed(() => {
  if (!searchQuery.value) return props.options;

  const query = searchQuery.value.toLowerCase();
  return props.options.filter(option =>
    option && option[props.labelKey] &&
    typeof option[props.labelKey] === 'string' &&
    option[props.labelKey].toLowerCase().includes(query)
  );
});

// Handle selection
const selectOption = (option : any) => {
  if (!option) return;

  selectedOption.value = option;
  emit('update:modelValue', option[props.valueKey] !== undefined ? option[props.valueKey] : null);
  emit('change', option);
  isOpen.value = false;
  searchQuery.value = '';
};

// Toggle dropdown
const toggleDropdown = () => {
  if (!props.disabled) {
    isOpen.value = !isOpen.value;
    if (isOpen.value) {
      searchQuery.value = '';
      // Focus the search input when opening
      setTimeout(() => {
        const searchInput = dropdownRef.value.querySelector('input');
        if (searchInput) searchInput.focus();
      }, 100);
    }
  }
};

// Close dropdown when clicking outside
const handleClickOutside = (event : any) => {
  if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
    isOpen.value = false;
  }
};

// Watch for external changes to modelValue
watch(() => props.modelValue, (newValue) => {
  if (newValue === '' || newValue === null || newValue === undefined) {
    selectedOption.value = null;
    return;
  }

  if (props.options && props.options.length > 0) {
    const option = props.options.find(opt => opt && opt[props.valueKey] === newValue);
    if (option) {
      selectedOption.value = option;
    }
  }
});

// Get display text for the selected option
const selectedText = computed(() => {
  if (selectedOption.value && selectedOption.value[props.labelKey] !== undefined) {
    return selectedOption.value[props.labelKey];
  }
  return props.label;
});
</script>

<template>
  <div class="relative w-full" ref="dropdownRef">
    <!-- Select Button -->
    <button
      type="button"
      @click="toggleDropdown"
      :disabled="disabled"
      class="flex items-center justify-between w-full px-4 py-2 text-sm bg-white border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
      :class="[
        error ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300',
        disabled ? 'opacity-75 cursor-not-allowed' : 'hover:bg-gray-50 dark:hover:bg-gray-600'
      ]"
    >
      <span :class="{ 'text-gray-400 dark:text-gray-300': !selectedOption, 'text-gray-900 dark:text-white': selectedOption }">{{ selectedText }}</span>
      <ChevronDown v-if="!isOpen" class="w-4 h-4 ml-2" />
      <ChevronUp v-else class="w-4 h-4 ml-2" />
    </button>

    <!-- Dropdown Menu -->
    <div
      v-if="isOpen"
      class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg dark:bg-gray-700 dark:border-gray-600"
    >
      <!-- Search Input -->
      <div class="relative p-2 border-b border-gray-200 dark:border-gray-600">
        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
          <Search class="w-4 h-4 text-gray-500 dark:text-gray-400" />
        </div>
        <input
          type="text"
          v-model="searchQuery"
          :placeholder="placeholder"
          class="w-full pl-10 pr-3 py-2 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
        />
      </div>

      <!-- Options List -->
      <ul class="py-1 max-h-60 overflow-y-auto">
        <li
          v-if="filteredOptions.length === 0"
          class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400"
        >
          No se encontraron resultados
        </li>
        <li
          v-for="option in filteredOptions"
          :key="option[valueKey]"
          @click="selectOption(option)"
          class="flex items-center px-4 py-2 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600"
          :class="{
            'bg-gray-100 dark:bg-gray-600': selectedOption && option[valueKey] === selectedOption[valueKey],
            'text-gray-900 dark:text-white': true
          }"
        >
          <span class="flex-grow">{{ option[labelKey] }}</span>
          <Check
            v-if="selectedOption && option[valueKey] === selectedOption[valueKey]"
            class="w-4 h-4 text-primary-500"
          />
        </li>
      </ul>
    </div>
    <div v-if="error" class="text-xs text-red-500 mt-1">{{ error }}</div>
  </div>
</template>
