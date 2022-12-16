<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
  ? 'block relative w-full flex items-center shadow-sm border-b-2 border-gray-800 px-6 py-3 text-sm text-gray-900 font-medium leading-5 transition duration-150 ease-in-out rounded-md group hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50'
  : 'block relative w-full flex items-center px-6 py-3  font-medium text-sm text-gray-600 leading-5 transition duration-150 ease-in-out rounded-md group hover:text-gray-900 hover:border-b-2 hover:border-gray-400hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50'

);
</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
