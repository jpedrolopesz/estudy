<template>

  <div class="mb-4">
      <label for="description" class="block mb-2 text-sm font-medium text-gray-900">{{label}}
        <span v-if="required" class="text-danger-600">*</span>
      </label>
      <textarea id="description" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500"
                placeholder="Write event description..."
                required
                :value="modelValue"
                :maxlength="max"
                :required="required"
                :autofocus="autofocus"
                :readonly="readonly"
                @input="$emit('update:modelValue', $event.target.value)">
      </textarea>
    </div>
</template>

<script setup>

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

const emit = defineEmits(["update:modelValue", "blur"]);


</script>

