<template>

  <VideoPlayGlobal :course="course"/>


</template>
<script setup>
import VideoPlayGlobal from "@/Components/Video/VideoPlayGlobal.vue";

defineProps({
  course:Object
})
</script>
