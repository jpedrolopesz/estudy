<template>
    <Chat
          :comments="comments"
          :msgSidebarOpen="msgSidebarOpen"
          @close-msgsidebar="msgSidebarOpen = false"
          @toggle-msgsidebar="msgSidebarOpen = !msgSidebarOpen"/>

</template>

<script setup>
import Chat from "@/Components/Comments/Partials/Chat.vue";
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
