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
  <div class="bg-white fixed top-0 left-0 h-full w-14 border-r border-gray-300 duration-500 z-50 sidebar">
    <div class="logo_class  ">
      <div class="logo ml-6">
        <div class="text-xl font-normal mr-24 flex">
          <ApplicationLogo class="block h-9 w-auto mr-4" />
          Laravels</div>
      </div>
      <button type="button">
        <svg id="menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="h-6 w-6 text-gray-500">
          <path stroke-linecap="round"
                stroke-linejoin="round"
                d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
        </svg>
      </button>


    </div>


    <!-- Search Button -->
    <ul class=" space-y-2">
      <h3 class="links_name px-6 pb-3 text-xs font-semibold leading-4 tracking-wider text-gray-500 uppercase md:block">Main</h3>

      <li>
        <NavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
          <div class="flex items-center p-1 ">
            <svg class="w-6 h-6 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
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
          <div class="flex items-center p-1 ">
            <svg class="w-6 h-6 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
            </svg>
            <span class="ml-3 links_name">Users</span>
          </div>
        </NavLink>
        <span class="tooltip">Users</span>
      </li>

      <li>
        <NavLink :href="route('courses.index')" :active="route().current('courses.index')">
          <div class="flex items-center p-1 ">
            <svg class="w-6 h-6 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
            </svg>

            <span class="ml-3 links_name">Courses</span>
          </div>
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
      <ul class=" space-y-2">
        <h3 class="links_name px-6 pb-3 text-xs font-semibold leading-4 tracking-wider text-gray-500 uppercase md:block">
          Settings</h3>

        <li>
          <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            <div class="flex items-center p-1 ">
              <svg class="w-6 h-6 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
              </svg>


              <span class="ml-3 links_name">Notification</span>
            </div>
          </NavLink>
          <span class="tooltip">Notification</span>
        </li>

        <li>
          <NavLink :href="route('admin.profile.edit')" :active="route().current('admin.profile.edit')">
            <div class="flex items-center p-1 ">
              <svg class="w-6 h-6 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>

              <span class="ml-3 links_name">Settings</span>
            </div>
          </NavLink>
          <span class="tooltip">Settings</span>
        </li>


      </ul>

      <div class="profile pl-6 pr-4 py-4 bg-gray-700 flex items-center justify-between">
        <div class="flex items-center ">
          <div class="relative w-8 h-8 ml-1 rounded-full before:absolute before:w-2 before:h-2 before:bg-green-500 before:rounded-full before:right-0 before:bottom-0 before:ring-1 before:ring-white">
            <img class="rounded-full" v-bind:src="'/storage/user/' + $page.props.auth.user.image"
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
