<template>
  <UserLayout>
        <Course class="h-[calc(98vh-64px)]"
          :courses="courses"
          :msgSidebarOpen="msgSidebarOpen"
          @close-msgsidebar="msgSidebarOpen = false"
          @toggle-msgsidebar="msgSidebarOpen = !msgSidebarOpen"
        />
  </UserLayout>
</template>

<script>
import UserLayout from "@/Pages/User/Layouts/UserLayout.vue";
import Course from "./Partials/Course.vue"
import {ref} from "vue";


export default {
  components:{ UserLayout, Course},
  props: {
    courses:Object,
    msgSidebarOpen:Boolean
  },
  setup() {
    const msgSidebarOpen = ref(true);
    const handleCloseSidebar = () => {
      msgSidebarOpen.value = false;
    };
    return {
      msgSidebarOpen,
      handleCloseSidebar,
    }
  },
}
</script>
