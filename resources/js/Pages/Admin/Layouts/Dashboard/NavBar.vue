<template>



  <div class="fixed bottom-0 left-0 z-50 grid w-full h-16  bg-white border-t border-gray-200 ">

    <div class="flex items-center justify-center ">

      <NavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')" class="inline-flex px-4 py-2 items-center justify-center  hover:bg-gray-50 group">
        <ChartPieIcon class="w-6 h-6 "/>
      </NavLink>

      <NavLink :href="route('user.index')" :active="route().current('user.index')" class="inline-flex px-4 py-2  items-center justify-center  hover:bg-gray-50 group">
        <UsersIcon class="w-6 h-6"/>
      </NavLink>

      <NavLink :href="route('comments.index')" :active="route().current('comments.index')" class="inline-flex px-4 py-2 items-center justify-center  hover:bg-gray-50 group">
        <ChatBubbleLeftRightIcon class="w-6 h-6" />
      </NavLink>

      <NavLink :href="route('course.index')" :active="route().current('course.index')" class="inline-flex px-4 py-2  items-center justify-center  hover:bg-gray-50 group">
        <VideoCameraIcon class="w-6 h-6" />
      </NavLink>

      <NavLink :href="route('plan.index')" :active="route().current('plan.index')" class="inline-flex px-4 py-2  items-center justify-center hover:bg-gray-50 group">
        <TicketIcon class="w-6 h-6" />
      </NavLink>


    </div>
  </div>

</template>



<script setup>

import {
  Bars3CenterLeftIcon,
  VideoCameraIcon,
  ChartPieIcon,
  Cog6ToothIcon,
  UsersIcon,
  ArrowLeftOnRectangleIcon,
  TicketIcon,
  ChatBubbleLeftRightIcon,
} from '@heroicons/vue/24/outline';
import NavLink from '@/Components/NavLink.vue';


</script>
