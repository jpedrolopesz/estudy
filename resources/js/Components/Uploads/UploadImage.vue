<template>
  <label v-if="label" for="image" class="block my-2 text-sm font-medium text-gray-900">
    {{ label }}
  </label>
  <input :type="type"
         :value="modelValue"
         :readonly="readonly"
         v-bind="$attrs"
         @input="emit('update:modelValue', $event.target.files[0])"/>
</template>

<script setup>
import {defineProps, defineEmits} from 'vue';

const emit = defineEmits(['update:modelValue']);

defineProps({
  label: {type: String, default: ''},
  modelValue: {type: Object, default: {}},
  type: {type: Object, default: ''},
  readonly: {type: Boolean, default: false}
});
</script>
