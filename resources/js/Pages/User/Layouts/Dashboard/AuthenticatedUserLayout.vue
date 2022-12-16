<script setup>
import { ref } from 'vue';
import Sidebar from "./Sidebar.vue";
import Header from "./Header.vue";

const showingNavigationDropdown = ref(false);
</script>

<template>

  <div class="flex bg-gray-50 min-h-screen overflow-hidden">

    <!-- Sidebar -->
    <Sidebar/>

    <!-- Content area -->
    <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
      <!-- Site header -->

      <Header class="ml-6"/>

      <!-- Page Heading -->
      <header  v-if="$slots.header">
        <div class="ml-14 px-4 mt-5 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <main class="ml-16">

        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">




          <!-- Page Content -->

          <slot />

          <!-- Dashboard actions -->
          <div class="sm:flex sm:justify-between sm:items-center mb-8">


          </div>

          <!-- Cards -->
          <div class="grid grid-cols-12 gap-6">



          </div>

        </div>
      </main>


    </div>

  </div>


</template>
