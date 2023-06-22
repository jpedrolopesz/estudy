<template>
  <AdminLayout>
    <Comments
      class="h-[calc(102vh-64px)]  -mt-4"

      :comments="comments" :msg-sidebar-open="msgSidebarOpen"/>
  </AdminLayout>
</template>

<script setup>
import Comments from "@/Components/Comments/Comments.vue";
import AdminLayout from "@/Pages/Admin/Layouts/AdminLayout.vue";

defineProps({
  comments:Object,
  msgSidebarOpen:Boolean
})



</script>
