<template>
  <nav v-show="links.length > 3">
    <ul class="inline-flex items-center">
      <li v-for="(link, key) in links" :key="key">
        <div v-if="link.url === null" :key="`${key}-disabled`"
             class="mr-1 mb-1 px-3 py-1 text-xs leading-4 text-gray-400 border rounded" v-html="link.label" />
        <Link v-else :key="key"
              class="mr-1 mb-1 px-3 py-1 text-xs leading-4 border rounded hover:bg-white focus:border-primary-500 focus:text-primary-500"
              :class="{ 'bg-white': link.active }" :href="link.url">
          <span v-html="link.label"></span>
        </Link>
      </li>
    </ul>
  </nav>
</template>

<script setup>

import { Link } from '@inertiajs/inertia-vue3';


defineProps({
  links: Array
});


</script>
