<template>
  <div
    class="flex-shrink-0 overflow-hidden rounded-full ring-1 ring-primary-200 ring-offset-2"
  >
    <img v-bind="$attrs" :src="avatar" alt="" />
  </div>
</template>

<script setup>

defineProps({
  avatar: String
});
</script>

<style scoped></style>
