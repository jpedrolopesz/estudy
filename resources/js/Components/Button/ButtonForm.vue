<template>
  <Button :disabled="disabled || loading"
          :type="type"
          v-bind="$attrs"
          :class="[btnClass, { 'w-full py-1.5 m-2': block }]"
          class="border border-transparent text-sm md:text-md font-semibold rounded transition ease-in-out duration-150">
    <slot />
  </Button>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  color: { type: String, default: "primary" },
  dark: Boolean,
  block: { type: Boolean, default: true },
  disabled: Boolean,
  loading: Boolean,
  type: { type: String, default: "submit" }
});


const btnClass = computed(() => {
  switch (props.color) {
    case "danger":
      return "bg-red-500 hover:bg-red-600 focus:ring-red-600 text-white";
    case "lightred":
      return "bg-red-200 hover:bg-red-300 disabled:pointer-events-none focus:ring-red-300 text-red-800";
    case "dark":
      return "bg-slate-900 hover:bg-slate-700 disabled:pointer-events-none  focus:ring-slate-500 text-white";
    case "success":
      return "bg-green-600 hover:bg-green-700 disabled:pointer-events-none  focus:ring-green-700 text-white";
    case "lightgreen":
      return "bg-green-200 hover:bg-green-300 disabled:pointer-events-none  focus:ring-green-300 text-green-800";
    case "warning":
      return "bg-orange-300 hover:bg-orange-400 disabled:pointer-events-none  focus:ring-orange-400 text-orange-900";
    case "light":
      return "bg-gray-100 hover:bg-gray-200 disabled:pointer-events-none  focus:ring-gray-200 text-gray-600";
    default:
      return "bg-primary-700 hover:bg-primary-800 disabled:pointer-events-none  focus:ring-primary-700 text-white";
  }
});

const spinnerClass = computed(() => {
  switch (props.color) {
    case "danger":
      return "text-white";
    case "lightred":
      return "text-red-800";
    case "dark":
      return "text-white";
    case "success":
      return "text-white";
    case "lightgreen":
      return "text-green-800";
    case "warning":
      return "text-orange-900";
    case "light":
      return "text-gray-600";
    default:
      return "text-white";
  }
});
</script>

<style scoped></style>
