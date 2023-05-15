<script setup>
import { ref } from 'vue';
import Sidebar from "./Dashboard/Sidebar.vue";
import Header from "./Dashboard/Header.vue";
import Toast from "@/Components/Toast.vue";


const showingNavigationDropdown = ref(false);
</script>

<template>

  <div class="flex bg-gray-50 min-h-screen overflow-hidden">

    <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">

      <Sidebar/>

      <Toast/>

      <header v-if="$slots.header">
        <div class="ml-14 px-4 mt-5 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <main class=" min-h-screen bg-dots-darker">

        <Header/>

        <div class=" py-1 w-full max-w-9xl mx-auto">
          <slot />
        </div>
      </main>
    </div>
  </div>
</template>


<style>
.bg-dots-darker {
  background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
  .dark\:bg-dots-lighter {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
  }
}
</style>



