<template>
  <div class="sidebar z-50 bg-white justify-items-center fixed top-0 left-0 h-full w-14 border-r border-gray-300 duration-500 ">
        <div class="logo_class ">
          <div class="logo ml-6">
            <div class="text-xl font-normal mt-4 mr-24 flex">
              <ApplicationLogo class="block h-8 w-auto mr-4" />
              eStudy
            </div>
          </div>
          <button type="button">
            <svg  id="menu">
              <Bars3CenterLeftIcon class="w-6 h-6 mr-1"/>
            </svg>
          </button>
        </div>

        <p class="links_name px-6  text-xs font-semibold leading-4 tracking-wider text-gray-500 uppercase md:block">Main</p>
        <ul class="-space-y-4">
          <li>
            <NavLink :href="route('course.user.index')" :active="route().current('course.user.index')">
              <div class="flex items-center p-1 ">

                <VideoCameraIcon class="w-6 h-6 mr-1" />

                <span class="ml-3 links_name">Courses</span>
              </div>
            </NavLink>
            <span class="tooltip bg-white">Courses</span>
          </li>
          <li>
            <NavLink :href="route('support.index')" :active="route().current('support.index')">
              <div class="flex items-center p-1 ">

                <ChatBubbleLeftRightIcon class="w-6 h-6 mr-1" />

                <span class="ml-3 links_name">Comments</span>
              </div>
            </NavLink>
            <span class="tooltip bg-white">Comments</span>
          </li>
        </ul>

        <!-- Profile Content -->
        <div class="profile_content">
          <p class="links_name px-6 text-xs font-semibold leading-4 tracking-wider text-gray-500 uppercase md:block">
            Settings</p>
          <ul class="-space-y-4">
            <li>
              <NavLink :href="route('profile.edit')" :active="route().current('profile.edit')">
                <div class="flex items-center p-1 ">
                  <Cog6ToothIcon class="w-6 h-6 mr-1" />
                  <span class="ml-3 links_name">Settings</span>
                </div>
              </NavLink>
              <span class="tooltip bg-white">Settings</span>
            </li
            >
            <li >
              <NavLink method="POST" as="button" class="-mr-1 hover:bg-transparent hover:border-transparent w-64" :href="route('logout.user')">
                <div class="flex items-center p-1 ">
                  <ArrowLeftOnRectangleIcon class="w-6 h-6 mr-1" />
                  <span class="ml-3 links_name">Logout</span>
                </div>
              </NavLink>
            </li>

          </ul>

          <div class="profile pl-6 pr-4 py-4 bg-gray-700 flex items-center justify-between">
            <div class="flex items-center ">
              <div class="relative w-8 h-8 ml-1 rounded-full before:absolute before:w-2 before:h-2 before:bg-green-500 before:rounded-full before:right-0 before:bottom-0 before:ring-1 before:ring-white">
                <img class="rounded-full" :src="'/storage/user/' + $page.props.auth.user.photo"/>
              </div>
              <div class="profile_details">
                <div class="name_job text-white">
                  <div class="name ">{{ $page.props.auth.user.first_name }}</div>
                  <div class="job">{{ $page.props.auth.user.last_name}}</div>
                </div>
              </div>
            </div>
          </div>


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

import {onMounted} from "vue";


onMounted(() => {
  const menu = document.querySelector("#menu");
  const sidebar = document.querySelector(".sidebar");

  menu.onclick = function () {
    sidebar.classList.toggle("active");
  }
});

</script>
