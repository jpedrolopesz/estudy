<template>
  <UserLayout>
      <Chat class="h-[calc(104vh-64px)] m-2"
        :comments="comments"
        :msgSidebarOpen="msgSidebarOpen"
        @close-msgsidebar="msgSidebarOpen = false"
        @toggle-msgsidebar="msgSidebarOpen = !msgSidebarOpen"/>

  </UserLayout>
</template>

<script setup>
import UserLayout from "@/Pages/User/Layouts/UserLayout.vue";
import Chat from "@/Pages/User/Comment/Partials/Chat.vue";
import {ref} from "vue";



defineProps({
  comments:Object,
  msgSidebarOpen:Boolean
})

const msgSidebarOpen = ref(true);
const handleCloseSidebar = () => {
  msgSidebarOpen.value = false;
    };

</script>
