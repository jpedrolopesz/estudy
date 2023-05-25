<template>
  <div class="flex items-center">
    <div class="flex w-full ">

      <SearchDropdown>
          <template #trigger>
            <button type="button" class="items-center mr-2 px-3 py-1.5 border border-gray-300  rounded-md text-gray-500 bg-transparent hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
              </svg>
            </button>
          </template>
        <template #dropdown>

            <slot />

        </template>
      </SearchDropdown>

      <div class="relative w-full ">
        <div class="flex absolute inset-y-0 left-0 items-center pl-3 ">
          <MagnifyingGlassIcon v-if="!modelValue" class="w-5 h-5 text-gray-500 "/>
          <XMarkIcon v-if="modelValue" type="button"
                     @click="$emit('reset')" class="w-5 h-5 text-gray-500 cursor-pointer"/>
        </div>

        <input class="bg-transparent border-gray-300 text-gray-900 text-sm rounded-md focus:ring-gray-500 focus:border-gray-500 block w-full pl-10 py-1.5"
               autocomplete="off"
               type="text"
               name="search"
               placeholder="Search…"
               :value="modelValue"
               @input="$emit('update:modelValue', $event.target.value)" />
      </div>

    </div>
  </div>
</template>

<script setup>
import {defineEmits} from "vue";
import SearchDropdown from "@/Components/SearchDropdown.vue";
import { XMarkIcon, MagnifyingGlassIcon } from '@heroicons/vue/24/outline';

defineEmits(['update:modelValue', 'reset']);

  const props = defineProps({
    modelValue: String,
    search: Object,
  })


</script>
