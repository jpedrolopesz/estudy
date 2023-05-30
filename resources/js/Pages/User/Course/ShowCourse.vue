<template>

  <UserLayout>
    <div class="flex items-center justify-between pt-6 mx-6 -mb-px">

      <Link :href="route('course.user.index')" class="block rounded-full p-1 bg-slate-100 text-slate-500 hover:text-slate-600">

        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>

      </Link>
    </div>
    <VideoPlayGlobal class="" :course="course"/>
  </UserLayout>



</template>
<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import VideoPlayGlobal from "@/Components/Video/VideoPlayGlobal.vue";
import UserLayout from "@/Pages/User/Layouts/UserLayout.vue";

defineProps({
  course:Object
})
</script>
