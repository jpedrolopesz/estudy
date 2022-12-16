<template>
  <div class="btn flex items-center  max-w-3xl bg-yellow-400 rounded">
    <div class="flex items-center">
      <button name="trash" class=" fill-yellow-800" />
      <div class="text-gray-700 text-sm font-medium">
        <slot />
      </div>
    </div>
    <button class="text-gray-700 ml-2 hover:underline text-sm" tabindex="-1" type="button" @click="$emit('restore')"> Restore</button>
  </div>
</template>

<script>

export default {

  emits: ['restore'],
}
</script>
