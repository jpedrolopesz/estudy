<template>
  <div>
    <label v-if="title" class="text-md font-bold tracking-tight text-gray-800 sm:text-3xl">
      {{title}}
    </label>
    <p v-if="subtitle" class="mt-2 text-md text-gray-500">
     {{subtitle}}
    </p>
  </div>
</template>
<script setup>
const props = defineProps({
  title: { type: String, default: "" },
  subtitle: { type: String, default: "" },
})
</script>
