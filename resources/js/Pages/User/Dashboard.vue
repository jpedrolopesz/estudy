<template>

  <Head  title="Dashboard" />

  <AuthenticatedUserLayout>

    <template #header>
      <h2 class="font-medium text-2xl lg:text-3xl opacity-75">Dashboard</h2>
    </template>



  </AuthenticatedUserLayout>
</template>


<script setup>
import AuthenticatedUserLayout from "@/Pages/User/Layouts/Dashboard/AuthenticatedUserLayout.vue";
import {Link, Head,} from "@inertiajs/inertia-vue3";
</script>



