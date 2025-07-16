# SearchableSelect Component

A customizable searchable select dropdown component for Vue 3 with Tailwind CSS styling.

## Features

- Searchable dropdown with filtering capabilities
- Customizable styling with Tailwind CSS
- Support for v-model binding
- Dark mode support
- Keyboard navigation
- Accessible design
- Click outside to close functionality
- Custom value and label keys
- Required and disabled states

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `options` | Array | `[]` | Array of options to display in the dropdown |
| `modelValue` | String/Number | `''` | Current selected value (for v-model binding) |
| `label` | String | `'Seleccionar'` | Default text to display when no option is selected |
| `placeholder` | String | `'Buscar...'` | Placeholder text for the search input |
| `valueKey` | String | `'id'` | Key to use for the option value |
| `labelKey` | String | `'name'` | Key to use for the option display text |
| `required` | Boolean | `false` | Whether the field is required |
| `disabled` | Boolean | `false` | Whether the field is disabled |

## Events

| Event | Parameters | Description |
|-------|------------|-------------|
| `update:modelValue` | `value` | Emitted when the selected value changes |
| `change` | `option` | Emitted when an option is selected, with the full option object |

## Usage

### Basic Usage

```vue
<script setup>
import { ref } from 'vue';
import SearchableSelect from '@/Componentes/SearchableSelect.vue';

const options = [
  { id: 1, name: 'Option 1' },
  { id: 2, name: 'Option 2' },
  { id: 3, name: 'Option 3' },
];

const selectedValue = ref('');
</script>

<template>
  <SearchableSelect
    v-model="selectedValue"
    :options="options"
    label="Select an option"
  />
</template>
```

### Custom Keys

```vue
<template>
  <SearchableSelect
    v-model="selectedValue"
    :options="options"
    valueKey="code"
    labelKey="title"
  />
</template>
```

### Required Field

```vue
<template>
  <SearchableSelect
    v-model="selectedValue"
    :options="options"
    :required="true"
  />
</template>
```

### Disabled State

```vue
<template>
  <SearchableSelect
    v-model="selectedValue"
    :options="options"
    :disabled="true"
  />
</template>
```

## Example

For a complete example of how to use this component, see the `SearchableSelectExample.vue` file.
