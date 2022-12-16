<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
  ? 'text-slate-600 hover:text-indigo-900'
  : 'text-slate-500 hover:text-indigo-900'
);
</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
