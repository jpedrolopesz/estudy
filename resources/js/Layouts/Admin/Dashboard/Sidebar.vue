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
        <ul class="nav-list">
          <h3 class="links_name px-6 pb-3 text-xs font-semibold leading-4 tracking-wider text-gray-500 uppercase md:block">Main</h3>


          <!-- Dashboard Button -->
            <li>
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                    <i class="nav__icon bx bx-grid-alt transition duration-150 ease-in-out group-hover:text-gray-500 group-focus:text-gray-900"></i>
                    <span class="links_name pt-2.5 font-semibold  transition duration-150 ease-in-out group-hover:text-gray-900 group-focus:text-gray-900">
                    Dashboard</span>
                </NavLink>
                <span class="tooltip">Dashboard</span>
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
            <img v-bind:src="'/storage/user/' + $page.props.auth.user.image"
                 :alt="$page.props.auth.user.image"/>
            <div class="name_job">
              <div class="name">{{ $page.props.auth.user.name }}</div>
              <div class="job">Company</div>
            </div>
          </div>
          <!-- Logo Button -->
          <i class="nav_icon bx bx-log-out" id="log_out"></i>
        </div>
      </div>
    </div>



</template>
