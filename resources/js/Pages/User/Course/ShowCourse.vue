<template>
  <UserLayout>
    <VideoPlayGlobal class="h-[calc(104vh-64px)] m-2" :course="course"/>
  </UserLayout>
</template>
<script setup>
import VideoPlayGlobal from "@/Components/Video/VideoPlayGlobal.vue";
import UserLayout from "@/Pages/User/Layouts/UserLayout.vue";

defineProps({
  course:Object,
})

</script>
