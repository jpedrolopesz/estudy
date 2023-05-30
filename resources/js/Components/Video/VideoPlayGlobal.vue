<template>

  <VideoPlayer :course="course"/>

</template>

<script>
import VideoPlayer from "./Partials/VideoPlayer.vue"

export default {
  components: {
    VideoPlayer,
  },
  emits: ['moduleSelect'],

  props: {
    course: Object,
  },
}
</script>
