<script lang="ts" setup>
import { ref, computed, watch, nextTick, onMounted, onBeforeUnmount } from 'vue';

type Option = {
    id: string | number;
    text: string;
};

const props = defineProps<{
    modelValue: string | number | Array<string | number> | null;
    options: Option[];
    placeholder?: string;
    error?: boolean;
    allowClear?: boolean;
    multiple?: boolean;
    searchable?: boolean;
}>();

const emit = defineEmits<{
    (e: 'update:modelValue', value: string | number | Array<string | number> | null): void;
    (e: 'change', value: string | number | Array<string | number> | null): void;
}>();

const dropdownOpen = ref(false);
const search = ref('');
const selected = computed(() => props.modelValue);

const filteredOptions = computed(() => {
    if (!search.value) return props.options;
    return props.options.filter(opt =>
        opt.text.toLowerCase().includes(search.value.toLowerCase())
    );
});

const selectedLabel = computed(() => {
    if (props.multiple && Array.isArray(selected.value)) {
        return selected.value.map(val => {
            const found = props.options.find(opt => opt.id === val);
            return found ? found.text : '';
        }).join(', ');
    } else {
        const found = props.options.find(opt => opt.id === selected.value);
        return found ? found.text : '';
    }
});

const searchInput = ref<HTMLInputElement | null>(null);

function toggleDropdown() {
    dropdownOpen.value = !dropdownOpen.value;
    if (dropdownOpen.value) {
        nextTick(() => {
            if (props.searchable !== false && searchInput.value) {
                searchInput.value.focus();
            }
        });
    }
}

function openDropdown() {
    dropdownOpen.value = true;
}

function closeDropdown() {
    dropdownOpen.value = false;
}

function selectOption(option: Option) {
    if (props.multiple) {
        let newValue = Array.isArray(selected.value) ? [...selected.value] : [];
        if (!newValue.includes(option.id)) {
            newValue.push(option.id);
        } else {
            newValue = newValue.filter(val => val !== option.id);
        }
        emit('update:modelValue', newValue);
        emit('change', newValue);
    } else {
        emit('update:modelValue', option.id);
        emit('change', option.id);
        closeDropdown();
    }
    search.value = '';
}

function clearSelection() {
    if (props.multiple) {
        emit('update:modelValue', []);
        emit('change', []);
    } else {
        emit('update:modelValue', null);
        emit('change', null);
    }
    search.value = '';
}

function onSearch() {
    if (!dropdownOpen.value) dropdownOpen.value = true;
}

function handleClickOutside(event: MouseEvent) {
    const el = event.target as HTMLElement;
    // const root = document.activeElement as HTMLElement;
    if (!el.closest('.relative')) {
        closeDropdown();
    }
}

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});
onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
});

watch(() => props.modelValue, (val) => {
    if (!val) search.value = '';
});
</script>
<template>
  <div class="relative w-full">
    <div
      :class="[
        'flex items-center border rounded-lg bg-white dark:bg-gray-700 w-full',
        error ? 'border-red-500' : 'border-gray-300',
        'focus-within:ring-2 focus-within:ring-primary-500'
      ]"
      @click="toggleDropdown"
      tabindex="0"
      @keydown.enter.prevent="toggleDropdown"
      @keydown.esc="closeDropdown"
    >
      <input
        v-if="searchable"
        v-model="search"
        :placeholder="placeholder"
        :value="selectedLabel || search"
        class="flex-1 bg-transparent outline-none px-2 py-2 text-sm text-gray-900 dark:text-white w-full min-w-0"
        @focus="openDropdown"
        @input="onSearch"
        :readonly="!dropdownOpen"
        ref="searchInput"
      />
      <span v-else class="flex-1 px-2 py-2 text-sm text-gray-900 dark:text-white truncate w-full min-w-0">
        {{ selectedLabel || placeholder }}
      </span>
      <button type="button" class="px-2 focus:outline-none" @click.stop="clearSelection" v-if="selected && allowClear">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      <span class="px-2 cursor-pointer" @click="toggleDropdown">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
      </span>
    </div>
    <transition name="fade">
      <ul
        v-if="dropdownOpen"
        class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg max-h-60 overflow-auto"
      >
        <li
          v-for="option in filteredOptions"
          :key="option.id"
          @click="selectOption(option)"
          class="px-4 py-2 cursor-pointer hover:bg-primary-100 dark:hover:bg-primary-600 hover:text-primary-700 dark:hover:text-white truncate"
        >
          {{ option.text }}
        </li>
        <li v-if="filteredOptions.length === 0" class="px-4 py-2 text-gray-400">Sin resultados</li>
      </ul>
    </transition>
  </div>
</template>
<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.15s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>
