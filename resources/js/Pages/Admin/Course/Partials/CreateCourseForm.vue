<template>

  <div >

    <div class="mb-4">
      <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
      <input type="text" id="title" class="w-full p-1.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block"
             placeholder="Title course"
             required
             :type="type"
             :value="modelValue"
             :maxlength="max"
             :required="required"
             :autofocus="autofocus"
             :readonly="readonly"
             @input="$emit('update:modelValue', $event.target.value)">
    </div>


    <div class="mb-4">
      <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Capa</label>
      <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-28 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50">
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
          <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
          <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
          <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
        </div>
        <input id="dropzone-file" type="file" class="hidden" />
      </label>
    </div>

    <div class="mb-4">
      <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Teachers</label>
      <div class="relative">
        <input type="search" id="guests" class="block p-1.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500" placeholder="Add Teacher" required>
        <button type="button" class="absolute inline-flex items-center px-3  text-sm font-medium text-white bg-gray-700 rounded-lg right-2 bottom-2 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">
          <svg class="w-4 h-4 mr-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
          </svg>
          Add
        </button>
      </div>
    </div>

    <div class="flex mb-4 -space-x-4">
      <img class="w-8 h-8 border-2 border-white rounded-full" src="https://images.pexels.com/photos/1279813/pexels-photo-1279813.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
      <img class="w-8 h-8 border-2 border-white rounded-full" src="https://images.pexels.com/photos/1279813/pexels-photo-1279813.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
      <img class="w-8 h-8 border-2 border-white rounded-full" src="https://images.pexels.com/photos/1279813/pexels-photo-1279813.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
      <img class="w-8 h-8 border-2 border-white rounded-full" src="https://images.pexels.com/photos/1279813/pexels-photo-1279813.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
    </div>

  </div>

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
