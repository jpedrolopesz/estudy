<template>
  <AuthenticatedUserLayout>

    <div class="flex bg-gray-50 flex-col overflow-hidden">

      <VideoPlayer :course="course"/>

    </div>

  </AuthenticatedUserLayout>
</template>

<script>
import AuthenticatedUserLayout from "@/Pages/User/Layouts/Dashboard/AuthenticatedUserLayout.vue";
import VideoPlayer from "../Course/Partials/VideoPlayer.vue"

export default {
  components: {
    VideoPlayer, AuthenticatedUserLayout,
  },
  emits: ['moduleSelect'],

  props: {
    course: Object,
  },
}
</script>
