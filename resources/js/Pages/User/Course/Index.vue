<template>
  <UserLayout>
        <Course class="h-[calc(104vh-64px)] m-2"
          :courses="courses"
          :msgSidebarOpen="msgSidebarOpen"
          @close-msgsidebar="msgSidebarOpen = false"
          @toggle-msgsidebar="msgSidebarOpen = !msgSidebarOpen"
        />
  </UserLayout>
</template>

<script setup>
import UserLayout from "@/Pages/User/Layouts/UserLayout.vue";
import Course from "./Partials/Course.vue"
import {ref} from "vue";


defineProps({
  courses:Object,
  msgSidebarOpen:Boolean,

})

const msgSidebarOpen = ref(true);
const handleCloseSidebar = () => { msgSidebarOpen.value = false};

</script>
