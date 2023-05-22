<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
  ? 'inline-flex items-center m-2 p-1 border-b-2 border-gray-800 text-base font-medium rounded-lg hover:bg-gray-100 text-gray-900 focus:outline-none focus:border-gray-700 transition  duration-150 ease-in-out'
  : 'inline-flex items-center m-2 p-1 border-b-2 border-transparent text-base font-medium rounded-lg hover:bg-gray-100 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
