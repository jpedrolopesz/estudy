<template>
  <div class="bg-white justify-items-center fixed top-0 left-0 h-full w-14 border-r border-gray-300 duration-500 z-50 sidebar">
    <div class="logo_class ">
      <div class="logo ml-6">
        <div class="text-xl font-normal mt-4 mr-24 flex">
          <ApplicationLogo class="block h-8 w-auto mr-4" />
          E-estudiar
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
        <NavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
          <div class="flex items-center p-1 ">
            <ChartPieIcon class="w-6 h-6 mr-1"/>
            <span class="ml-3 links_name">Dashboard</span>
          </div>
        </NavLink>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <NavLink :href="route('users.index')" :active="route().current('users.index')">
          <div class="flex items-center p-1 ">

            <UsersIcon class="w-6 h-6 mr-1"/>

            <span class="ml-3 links_name">Users</span>
          </div>
        </NavLink>
        <span class="tooltip">Users</span>
      </li>
      <li>
        <NavLink :href="route('course.index')" :active="route().current('course.index')">
          <div class="flex items-center p-1 ">

            <VideoCameraIcon class="w-6 h-6 mr-1" />

            <span class="ml-3 links_name">Courses</span>
          </div>
        </NavLink>
        <span class="tooltip">Courses</span>
      </li>
      <li>
        <NavLink :href="route('pages.plans.show')" :active="route().current('pages.plans.show')">
          <div class="flex items-center p-1 ">

            <TicketIcon class="w-6 h-6 mr-1" />

            <span class="ml-3 links_name">Plans</span>
          </div>
        </NavLink>
        <span class="tooltip">Plans</span>
      </li>
    </ul>

    <!-- Profile Content -->
    <div class="profile_content">
      <p class="links_name px-6 text-xs font-semibold leading-4 tracking-wider text-gray-500 uppercase md:block">
        Settings</p>
      <ul class="-space-y-4">
        <li>
          <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            <div class="flex items-center p-1 ">
              <BellIcon class="w-6 h-6 mr-1" />
              <span class="ml-3 links_name">Notification</span>
            </div>
          </NavLink>
          <span class="tooltip">Notification</span>
        </li>
        <li>
          <NavLink :href="route('admin.profile.edit')" :active="route().current('admin.profile.edit')">
            <div class="flex items-center p-1 ">
              <Cog6ToothIcon class="w-6 h-6 mr-1" />
              <span class="ml-3 links_name">Settings</span>
            </div>
          </NavLink>
          <span class="tooltip">Settings</span>
        </li>
      </ul>

      <div class="profile pl-6 pr-4 py-4 bg-gray-700 flex items-center justify-between">
        <div class="flex items-center ">
          <div class="relative w-8 h-8 ml-1 rounded-full before:absolute before:w-2 before:h-2 before:bg-green-500 before:rounded-full before:right-0 before:bottom-0 before:ring-1 before:ring-white">
            <img class="rounded-full" src="/images/user.jpeg"
                 alt=""/>
          </div>
          <div class="profile_details">
            <div class="name_job text-white">
              <div class="name ">{{ $page.props.auth.user.first_name }}</div>
              <div class="job">{{ $page.props.auth.user.last_name}}</div>
            </div>

          </div>


        </div>
        <button
          class="profile_details text-gray-400 bg-gray-700 rounded focus:outline-none focus:ring-1 focus:ring-gray-500 focus:text-white"
        >
          <svg class="w-4 h-4 stroke-current" fill="none" viewBox="0 0 24 24">
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1.5"
              d="M15.25 10.75L12 14.25L8.75 10.75"
            ></path>
          </svg>
        </button>

      </div>


    </div>
  </div>



</template>

<script setup>
import {onMounted} from 'vue';
import NavLink from '@/Components/NavLink.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Bars3CenterLeftIcon } from '@heroicons/vue/24/outline';
import { UsersIcon } from '@heroicons/vue/24/outline';
import { ChartPieIcon } from '@heroicons/vue/24/outline';
import { VideoCameraIcon } from '@heroicons/vue/24/outline';
import { TicketIcon } from '@heroicons/vue/24/outline';
import { Cog6ToothIcon } from '@heroicons/vue/24/outline';
import { BellIcon } from '@heroicons/vue/24/outline';



onMounted(() => {
  const menu = document.querySelector("#menu");
  const sidebar = document.querySelector(".sidebar");

  menu.onclick = function () {
    sidebar.classList.toggle("active");
  }
});

</script>

