<template>
  <div class="fixed bottom-0 left-0  z-50 w-full h-16 bg-white border-t border-gray-300 rounded-sm">
    <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">

      <NavLink :href="route('course.user.index')" :active="route().current('course.user.index')" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group">
        <VideoCameraIcon class="w-6 h-6" />
        <span class="text-sm text-gray-500 group-hover:text-gray-600 ">Courses</span>
      </NavLink>

      <NavLink :href="route('support.index')" :active="route().current('support.index')" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group">
        <ChatBubbleLeftRightIcon class="w-6 h-6" />
        <span class="text-sm text-gray-500 group-hover:text-gray-600 ">Comments</span>
      </NavLink>

      <NavLink :href="route('profile.edit')" :active="route().current('profile.edit')" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group">
        <Cog6ToothIcon class="w-6 h-6" />
        <span class="text-sm text-gray-500 group-hover:text-gray-600 ">Settings</span>
      </NavLink>


      <NavLink  method="POST" as="button" :href="route('logout.user')" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 group">
        <ArrowLeftOnRectangleIcon class="w-6 h-6 mr-1" />
        <span class="text-sm text-gray-500 group-hover:text-gray-600 ">Logout</span>
      </NavLink>

      </div>

  </div>

</template>


<script setup>
import NavLink from '@/Components/NavLink.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {
Bars3CenterLeftIcon,
VideoCameraIcon,
Cog6ToothIcon,
ArrowLeftOnRectangleIcon,
ChatBubbleLeftRightIcon,
} from '@heroicons/vue/24/outline';
</script>
