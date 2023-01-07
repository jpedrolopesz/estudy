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
            <NavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
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
            <NavLink :href="route('users.index')" :active="route().current('users.index')">
              <div class="flex items-center p-2 ">
                <svg class="w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>
                <span class="ml-3 links_name">Users</span>
              </div>
            </NavLink>
            <span class="tooltip">Users</span>
          </li>

          <li>
            <NavLink :href="route('pages.plans.index')" :active="route().current('pages.plans.index')">
              <div class="flex items-center p-2 ">
                <svg class="w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                </svg>
                <span class="ml-3 links_name">Plans</span>
              </div>
            </NavLink>
            <span class="tooltip">Plans</span>
          </li>

          <li>
            <NavLink :href="route('courses.show')" :active="route().current('courses.show')">
              <i class="nav__icon bx bx-grid-alt transition duration-150 ease-in-out group-hover:text-gray-500 group-focus:text-gray-900"></i>
              <span class="links_name pt-2.5 font-semibold  transition duration-150 ease-in-out group-hover:text-gray-900 group-focus:text-gray-900">
                    Courses</span>
            </NavLink>
            <span class="tooltip">Courses</span>
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
