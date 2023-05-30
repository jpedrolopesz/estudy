<template>
  <AuthenticatedUserLayout>
    <div class="flex flex-row h-[calc(92vh-64px)]">
      <div class="flex flex-row flex-auto">
      <Chat
        :comments="comments"
        :msgSidebarOpen="msgSidebarOpen"
        @close-msgsidebar="msgSidebarOpen = false"
        @toggle-msgsidebar="msgSidebarOpen = !msgSidebarOpen"/>
      </div>
    </div>
  </AuthenticatedUserLayout>
</template>

<script>
import AuthenticatedUserLayout from "@/Pages/User/Layouts/UserLayout.vue";
import Chat from "@/Pages/User/Comment/Partials/Chat.vue";
import {ref} from "vue";
import ChatHeader from "@/Pages/User/Comment/Partials/ChatHeader.vue";
import ListChat from "@/Pages/User/Comment/Partials/ListChat.vue";

export default {
  components: {ListChat, ChatHeader, Chat, AuthenticatedUserLayout},
  props: {
    comments:Object,
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
