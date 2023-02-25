<script>
import NavLink from '@/Components/NavLink.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

export default {
    components: {
      ApplicationLogo,
        NavLink
    },
    mounted() {
        const menu = document.querySelector("#menu");
        const sidebar = document.querySelector(".sidebar");

        menu.onclick = function () {
            sidebar.classList.toggle("active");
        };
    }
};
</script>

<template>

  <div class="sidebar">
    <div class="logo_class">
      <div class="logo ml-6">
        <div class="logo_name mr-24 flex">
          <ApplicationLogo class="block h-9 w-auto mr-4" />
          Laravel</div>
      </div>
      <svg id="menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
           class="h-6 w-6 text-gray-500">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
      </svg>

    </div>


    <!-- Search Button -->
    <ul class="nav-list space-y-2">

      <h3 class="links_name px-6 pb-3 text-xs font-semibold leading-4 tracking-wider text-gray-500 uppercase md:block">Main</h3>

      <li>
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
          <div class="flex items-center p-2 ">
            <svg class="w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
            </svg>
            <span class="ml-3 links_name">Dashboard</span>
          </div>
        </NavLink>
        <span class="tooltip">Dashboard</span>
      </li>

      <li>
        <NavLink :href="route('courses.index')" :active="route().current('courses.index')">
          <div class="flex items-center p-2 ">
            <svg  class="w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
            </svg>

            <span class="ml-3 links_name">Courses</span>
          </div>
        </NavLink>
        <span class="tooltip">Courses</span>
      </li>
      <li>
        <NavLink :href="route('comments.index')" :active="route().current('comments.index')">
          <div class="flex items-center p-2 ">
            <svg  class="w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
            </svg>


            <span class="ml-3 links_name">Comments</span>
          </div>
        </NavLink>
        <span class="tooltip">Comments</span>
      </li>

      <!-- Users
        <li>
            <NavLink :href="route('users.index')" :active="route().current('users.index')">
                <i class="nav__icon bx bx bx-user transition duration-150 ease-in-out group-hover:text-indigo-500 group-focus:text-gray-500"></i>
                <span class="links_name pt-2.5 font-semibold  transition duration-150 ease-in-out group-hover:text-indigo-500 group-focus:text-gray-500">
                Users</span>
            </NavLink>
            <span class="tooltip">Users</span>
        </li>
        -->

    </ul>

    <!-- Profile Content -->
    <div class="profile_content">
      <div class="profile">
        <div class="profile_details">
          <img v-bind:src="'/storage/user/' + $page.props.auth.user.photo"
               :alt="$page.props.auth.user.first_name"/>
          <div class="name_job">
            <div class="name">{{ $page.props.auth.user.first_name }}</div>
            <div class="job">{{ $page.props.auth.user.last_name}}</div>
          </div>
        </div>
        <!-- Logo Button -->
        <i class="nav_icon bx bx-log-out" id="log_out"></i>
      </div>
    </div>
  </div>




</template>
