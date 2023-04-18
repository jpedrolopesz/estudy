<template>
  <AdminLayout>

    <div class="flex bg-gray-50 flex-col overflow-hidden">

      <VideoPlayer :course="course"/>

    </div>

  </AdminLayout>
</template>

<script>
import VideoPlayer from "../Course/Partials/VideoPlayer.vue"
import AdminLayout from "../Layouts/AdminLayout.vue";

export default {
  components: {
    AdminLayout,
    VideoPlayer,
  },
  emits: ['moduleSelect'],

  props: {
    course: Object,
  },
}
</script>
