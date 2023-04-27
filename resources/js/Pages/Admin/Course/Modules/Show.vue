<template>
  <AdminLayout>

    <h1>Modules Rola</h1>


    <ul v-for="module in modules.data" :key="module.id">
      <li class="border-b">
        <h1>{{module.title}}
          <Link :href="route('module.show', module.id)"  class="btn">
            Clicar
          </Link></h1>
      </li>
    </ul>

  </AdminLayout>
</template>



<script setup>
import AdminLayout from "@/Pages/Admin/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/inertia-vue3";


const props = defineProps({
  course: Object,
  modules: Object
})
</script>
