<template>
  <Head title="Welcome"/>

  <div class=" overflow-hidden relative w-full">
    <nav class="absolute w-full">
      <div class="container m-auto px-6 md:px-12 lg:px-7">
        <div class="flex flex-wrap items-center justify-between py-6 gap-6 md:py-4 md:gap-0 relative">
          <input type="checkbox" name="toggle_nav" id="toggle_nav" class="peer hidden">
          <div class="w-full flex justify-between md:w-max md:px-0">
            <a href="#" aria-label="logo" class="flex items-center">
              <img src="asset/logoe-estudiar.svg" class="w-8 grayscale contrast-200" alt="eStudy SAAS"
                   width="144" height="68">
              <span class="font-semibold text-lg">eStudy</span>
            </a>

            <div class="flex items-center md:hidden max-h-10">
              <label role="button" for="toggle_nav" aria-label="humburger" id="hamburger"
                     class="relative z-40 px-2 py-3 sm:-mr-6">
                <div id="line"
                     class="m-auto h-0.5 w-6 rounded bg-sky-900 dark:bg-gray-300 transition duration-300"></div>
                <div id="line2"
                     class="m-auto mt-2 h-0.5 w-6 rounded bg-sky-900 dark:bg-gray-300 transition duration-300">
                </div>
              </label>
            </div>
          </div>

          <label role="button"
                 class="fixed w-full z-10 h-full top-0 left-0 bg-gray-700 bg-opacity-40 hidden peer-checked:block md:peer-checked:hidden"></label>

          <div class="flex z-20 flex-col md:flex-row justify-between
                    items-center gap-y-4 p-6 bg-white dark:bg-gray-800 md:w-8/12
                    md:gap-y-4 md:p-0
                    md:bg-transparent lg:w-7/12 fixed top-0 -left-full transition-all duration-500 peer-checked:left-0 max-w-sm h-full
                    md:left-0 md:h-auto w-4/5 md:max-w-none md:relative lg:first-letter:top-0">
            <div class="flex md:hidden w-full pb-5">
              <a href="#" aria-label="logo">
                <img src="images/logo.svg" class="w-36 grayscale contrast-200" alt="purosaas.com" width="144"
                     height="68">
              </a>
            </div>
            <div class="block w-full h-full md:h-auto">
              <ul class="space-y-8 tracking-wide font-medium md:flex md:space-y-0">
                <li>
                  <a href="#" class="block md:px-3">
                    <div class="relative text-yellow-800 dark:text-yellow-300 before:absolute before:-inset-2 before:w-full before:h-0.5 before:origin-left dark:before:bg-yelloe-500 before:mx-auto before:mt-auto before:rounded-full before:bg-yellow-800">
                      <span>Home</span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#features" class="block md:px-3 group">
                    <div class="relative text-gray-600 before:absolute before:-inset-2 before:w-full before:h-0.5 before:origin-left dark:before:bg-yelloe-500 before:mx-auto before:mt-auto before:rounded-full before:bg-yellow-800 before:transition before:scale-x-0 group-hover:before:scale-x-100">
                      <span class="transition group-hover:text-yellow-700 dark:text-gray-300 dark:group-hover:text-yellow-300">
                        Features
                      </span>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#price" class="block md:px-3 group">
                    <div class="relative text-gray-600 before:absolute before:-inset-2 before:w-full before:h-0.5 before:origin-left dark:before:bg-yelloe-500 before:mx-auto before:mt-auto before:rounded-full before:bg-yellow-800 before:transition before:scale-x-0 group-hover:before:scale-x-100">
                      <span class="transition group-hover:text-yellow-700 dark:text-gray-300 dark:group-hover:text-yellow-300">
                        Price
                      </span>
                    </div>
                  </a>
                </li>
              </ul>
            </div>

            <div class="w-full space-x-4 gap-y-4 md:max-w-max md:gap-y-0 md:gap-x-4 flex ">

              <Link v-if="$page.props.auth.user" :href="route('course.user.index')"
                    class="w-full py-2 rounded-sm px-6 text-center text-white transition font-bold bg-gray-900 hover:bg-gray-800 active:bg-gray-700 focus:bg-gray-800 md:w-maxunderline">
                Access
              </Link>

              <template v-else>
                <a href="/login" class="text-gray-700 font-semibold group-focus:text-yellow-700 underline">
                  Log in
                </a>

                <ModalPlans >
                  <template #plans>
                   <span class="text-gray-700 font-semibold group-focus:text-yellow-700 underline">
                     Register
                   </span>
                  </template>
                  <Plans
                    :plans="plans"
                    :plansMonthly="plansMonthly"
                    :plansYearly="plansYearly"
                  />

                </ModalPlans>
              </template>

            </div>

          </div>
        </div>
      </div>
    </nav>
    <div class="min-h-screen flex">
      <div class="container m-auto px-6 py-40 md:px-12 lg:py-0 lg:px-7">
        <div class="flex items-center flex-wrap gap-12 lg:gap-0">
          <div class="lg:w-5/12 space-y-8">
                        <span class="flex space-x-2">
                            <span class="block w-14 mb-2 border-b-2 border-gray-600"></span>
                            <span class="font-medium text-gray-600 dark:text-gray-400">New this summer</span>
                        </span>
            <h1 class="text-4xl font-bold md:text-6xl dark:text-white">The New <br> Way To Discover</h1>
            <p class="text-xl text-gray-700 dark:text-gray-300">Booking Company-Wide Savings, Invoicing and reporting
              docs.</p>

            <div class="flex space-x-4">
              <button type="button" class="w-full py-3 px-6 text-center rounded-md transition bg-gray-900 dark:bg-gray-700 hover:bg-gray-800 active:bg-gray-700 focus:bg-gray-800 sm:w-max">
                <span class="block text-white font-semibold">
                  Access Now
                </span>
              </button>
              <button type="button" class="group w-full py-3 px-6 text-center transition dark:active:bg-yellow-800 dark:focus:bg-yellow-900 active:bg-yellow-200 focus:bg-yellow-100 sm:w-max">
                <span class="block text-gray-700 dark:text-white font-semibold group-focus:text-yellow-700 dark:group-focus:text-yellow-100">
                  Saiba Mais
                </span>
              </button>
            </div>
          </div>

          <div class="-z-10 relative left-36 lg:w-7/12">
            <div aria-hidden="true" class="absolute inset-0 m-auto w-[30rem] h-[30rem]  lg:w-[60rem] lg:h-[60rem] rounded-full bg-gray-200">

            </div>
            <img src="images/shoes.png" class="relative ml-auto" alt="">
          </div>
        </div>
      </div>

    </div>
  </div>


  <!-- Features -->
  <div id="features" class="py-16">
    <div class="xl:container m-auto px-6 text-gray-500 md:px-12">
      <div>
        <h2 class="mt-4 text-2xl font-bold text-gray-700 dark:text-white md:text-4xl">
          A technology-first approach to payments <br class="lg:block" hidden/>
          and finance
        </h2>
      </div>
      <div
        class="mt-16 grid divide-x divide-y divide-gray-100 dark:divide-gray-700 overflow-hidden rounded-3xl border border-gray-100 dark:border-gray-700 sm:grid-cols-2 lg:grid-cols-4 lg:divide-y-0 xl:grid-cols-4"
      >
        <div
          class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10">
          <div class="relative space-y-8 py-12 p-8">
            <img
              src="https://cdn-icons-png.flaticon.com/512/4341/4341139.png"
              class="w-12"
              width="512"
              height="512"
              alt="burger illustration"
            />

            <div class="space-y-2">
              <h5
                class="text-xl font-medium text-gray-700 dark:text-white transition group-hover:text-primary"
              >
                First feature
              </h5>
              <p class="text-sm text-gray-600 dark:text-gray-300">
                Neque Dolor, fugiat non cum doloribus aperiam voluptates nostrum.
              </p>
            </div>
            <a href="#" class="flex items-center justify-between group-hover:text-primary">
              <span class="text-sm">Read more</span>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                   class="w-5 h-5 -translate-x-4 text-2xl opacity-0 transition duration-300 group-hover:translate-x-0 group-hover:opacity-100">
                <path fill-rule="evenodd"
                      d="M12.97 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06l6.22-6.22H3a.75.75 0 010-1.5h16.19l-6.22-6.22a.75.75 0 010-1.06z"
                      clip-rule="evenodd"/>
              </svg>
            </a>
          </div>
        </div>
        <div
          class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10">
          <div class="relative space-y-8 py-12 p-8">
            <img
              src="https://cdn-icons-png.flaticon.com/512/4341/4341134.png"
              class="w-12"
              width="512"
              height="512"
              alt="burger illustration"
            />

            <div class="space-y-2">
              <h5
                class="text-xl font-medium text-gray-700 dark:text-white transition group-hover:text-primary"
              >
                Second feature
              </h5>
              <p class="text-sm text-gray-600 dark:text-gray-300">
                Neque Dolor, fugiat non cum doloribus aperiam voluptates nostrum.
              </p>
            </div>
            <a href="#" class="flex items-center justify-between group-hover:text-primary">
              <span class="text-sm">Read more</span>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                   class="w-5 h-5 -translate-x-4 text-2xl opacity-0 transition duration-300 group-hover:translate-x-0 group-hover:opacity-100">
                <path fill-rule="evenodd"
                      d="M12.97 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06l6.22-6.22H3a.75.75 0 010-1.5h16.19l-6.22-6.22a.75.75 0 010-1.06z"
                      clip-rule="evenodd"/>
              </svg>
            </a>
          </div>
        </div>
        <div
          class="group relative bg-white dark:bg-gray-800 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10">
          <div class="relative space-y-8 py-12 p-8">
            <img
              src="https://cdn-icons-png.flaticon.com/512/4341/4341160.png"
              class="w-12"
              width="512"
              height="512"
              alt="burger illustration"
            />

            <div class="space-y-2">
              <h5
                class="text-xl font-medium text-gray-700 dark:text-white transition group-hover:text-primary"
              >
                Third feature
              </h5>
              <p class="text-sm text-gray-600 dark:text-gray-300">
                Neque Dolor, fugiat non cum doloribus aperiam voluptates nostrum.
              </p>
            </div>
            <a href="#" class="flex items-center justify-between group-hover:text-primary">
              <span class="text-sm">Read more</span>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                   class="w-5 h-5 -translate-x-4 text-2xl opacity-0 transition duration-300 group-hover:translate-x-0 group-hover:opacity-100">
                <path fill-rule="evenodd"
                      d="M12.97 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06l6.22-6.22H3a.75.75 0 010-1.5h16.19l-6.22-6.22a.75.75 0 010-1.06z"
                      clip-rule="evenodd"/>
              </svg>
            </a>
          </div>
        </div>
        <div
          class="group relative bg-gray-50 dark:bg-gray-900 transition hover:z-[1] hover:shadow-2xl hover:shadow-gray-600/10"
        >
          <div
            class="relative space-y-8 py-12 p-8 transition duration-300 group-hover:bg-white dark:group-hover:bg-gray-800"
          >
            <img
              src="https://cdn-icons-png.flaticon.com/512/4341/4341025.png"
              class="w-12"
              width="512"
              height="512"
              alt="burger illustration"
            />

            <div class="space-y-2">
              <h5
                class="text-xl font-medium text-gray-700 dark:text-white transition group-hover:text-primary"
              >
                More features
              </h5>
              <p class="text-sm text-gray-600 dark:text-gray-300">
                Neque Dolor, fugiat non cum doloribus aperiam voluptates nostrum.
              </p>
            </div>
            <a href="#" class="flex items-center justify-between group-hover:text-primary">
              <span class="text-sm">Read more</span>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                   class="w-5 h-5 -translate-x-4 text-2xl opacity-0 transition duration-300 group-hover:translate-x-0 group-hover:opacity-100">
                <path fill-rule="evenodd"
                      d="M12.97 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06l6.22-6.22H3a.75.75 0 010-1.5h16.19l-6.22-6.22a.75.75 0 010-1.06z"
                      clip-rule="evenodd"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Plans -->
  <div  class="xl:container m-auto px-6 py-20 md:px-12 lg:px-20">
    <div class="m-auto text-center mb-10 lg:w-8/12 xl:w-7/12">
      <h2 class="text-2xl font-bold text-gray-800 md:text-4xl">
        A eStudy subscription gives you access to our components and more.
      </h2>
    </div>
    <Plans
      id="price"
      :plans="plans"
      :plansMonthly="plansMonthly"
      :plansYearly="plansYearly"
    />
  </div>



  <!-- Footer -->
  <footer class="w-full bg-gray-100 dark:bg-gray-900 py-16">
    <div class="md:px-12 lg:px-28">
      <div class="container m-auto space-y-6 text-gray-600 dark:text-gray-300">
        <img src="images/logo.svg" alt="purosaas.com" class="m-auto w-40"/>
        <div class="m-auto flex w-max items-center justify-between space-x-4">
          <div class="text-center">
            <span class="text-sm tracking-wide">Copyright © purosaas <span id="year"></span> | All right reserved</span>
          </div>
        </div>

      </div>
    </div>
  </footer>


</template>

<script setup>
import {ref} from 'vue'
import {Head, Link} from '@inertiajs/inertia-vue3';
import Plans from "@/Pages/Home/Partials/Plans.vue";
import ModalPlans from "@/Components/ModalPlans.vue";

const props = defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  plans: Object,
  plansMonthly:Object,
  plansYearly:Object,
})



const mobileMenuOpen = ref(false)
</script>

