<template>

<AdminLayout>
  <VideoPlayGlobal :course="course"/>
</AdminLayout>

</template>

<script setup>
import VideoPlayGlobal from "@/Components/Video/VideoPlayGlobal.vue";
import AdminLayout from "@/Pages/Admin/Layouts/AdminLayout.vue";

defineProps({
  course:Object
})
</script>
