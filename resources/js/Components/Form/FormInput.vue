<template>
  <label v-if="label" class="form-label !pt-1 block mb-2 text-sm font-medium text-gray-900">
    {{ label }}
  </label>
  <input class="w-full p-1.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block"
           :value="modelValue"
           :type="type"
           :maxlength="max"
           :required="required"
           :autofocus="autofocus"
           :readonly="readonly"
           v-bind="$attrs"
           @input="$emit('update:modelValue', $event.target.value)"
           :placeholder="placeholder" />

</template>

<script setup>

defineEmits(["update:modelValue"]);
defineProps({
  id: String,
  max: {
    type: Number,
    default: undefined
  },
  modelValue: { type: [String, Number], default: "" },
  error: { type: String, default: null },
  required: { type: Boolean, default: false },
  autofocus: { type: Boolean, default: false },
  placeholder: { type: String, default: "" },
  label: { type: String, default: "" },
  type: { type: String, default: "text" },
  readonly: { type: Boolean, default: false }
});
</script>

<style scoped>

</style>
