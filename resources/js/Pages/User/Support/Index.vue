<template>
  <UserLayout>
    <Comments
      class="h-[calc(104vh-64px)] m-2"
      :comments="comments" :msg-sidebar-open="msgSidebarOpen"/>
  </UserLayout>
</template>

<script setup>
import UserLayout from "@/Pages/User/Layouts/UserLayout.vue";
import Comments from "@/Components/Comments/Comments.vue";

defineProps({
  comments:Object,
  msgSidebarOpen:Boolean
})

</script>
