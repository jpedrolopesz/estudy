<template>
  <Head title="Welcome"/>

  <div class=" overflow-hidden relative w-full">
    <nav class="absolute w-full">
      <div class="container m-auto px-6 md:px-12 lg:px-7">
        <div class="flex flex-wrap items-center justify-between py-6 gap-6 md:py-4 md:gap-0 relative">
          <input type="checkbox" name="toggle_nav" id="toggle_nav" class="peer hidden">
          <div class="w-full flex justify-between md:w-max md:px-0">
            <a href="#" aria-label="logo">
              <img src="images/logo.svg" class="w-36 grayscale  contrast-200" alt="eStudy SAAS"
                   width="144" height="68">
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
                 class="fixed w-full z-30 h-full top-0 left-0 bg-gray-700 bg-opacity-40 hidden peer-checked:block md:peer-checked:hidden"></label>

          <div class="flex z-50 flex-col md:flex-row justify-between
                    items-center gap-y-4 p-6 bg-white dark:bg-gray-800 md:w-8/12
                    md:gap-y-4 md:p-0
                    md:bg-transparent lg:w-7/12 fixed top-0 -left-full transition-all duration-500 peer-checked:left-0 max-w-sm h-full
                    md:left-0 md:h-auto w-4/5 md:max-w-none md:relative lg:first-letter:top-0">
            <div class="flex md:hidden w-full pb-5">
              <a href="#" aria-label="logo">
                <img src="images/logo.svg" class="w-36 grayscale contrast-200" alt="tailus logo" width="144"
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
                  <a href="#" class="block md:px-3 group">
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

              <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="w-full py-2 rounded-sm px-6 text-center text-white transition font-bold bg-gray-900 hover:bg-gray-800 active:bg-gray-700 focus:bg-gray-800 md:w-maxunderline">
                Dashboard
              </Link>

              <template v-else>
                <Link :href="route('login')" class="text-gray-700 font-semibold group-focus:text-yellow-700 underline">
                  Log in
                </Link>

                <Link v-if="!canRegister" :href="route('register')"
                      class="text-gray-700 font-semibold group-focus:text-yellow-700 underline">Register
                </Link>
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


  <!-- Recursos -->
  <div class="py-16">
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
        <img src="images/logo.svg" alt="logo tailus" class="m-auto w-40"/>
        <ul
          role="list"
          class="flex flex-col items-center justify-center gap-4 py-4 sm:flex-row sm:gap-8"
        >
          <li role="listitem"><a href="#" class="hover:text-primary">Home</a></li>
          <li role="listitem"><a href="#" class="hover:text-primary">Features</a></li>
          <li role="listitem"><a href="#" class="hover:text-primary">Get started</a></li>
          <li role="listitem"><a href="#" class="hover:text-primary">About us</a></li>
        </ul>
        <div class="m-auto flex w-max items-center justify-between space-x-4">
          <a href="tel:+243996660436" aria-label="call">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              class="m-auto w-5"
              viewBox="0 0 16 16"
            >
              <path
                fill-rule="evenodd"
                d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"
              ></path>
            </svg>
          </a>
          <a href="mailto:hello@mail.com" aria-label="send mail">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              class="m-auto w-5"
              viewBox="0 0 16 16"
            >
              <path
                d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"
              ></path>
            </svg>
          </a>
          <a href="#" title="facebook" target="blank" aria-label="facebook">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              class="m-auto w-5"
              viewBox="0 0 16 16"
            >
              <path
                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"
              ></path>
            </svg>
          </a>
          <a href="#" title="linkedin" target="blank" aria-label="linkedin">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              class="m-auto w-5"
              viewBox="0 0 16 16"
            >
              <path
                d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"
              ></path>
            </svg>
          </a>
        </div>

        <div class="text-center">
        <span class="text-sm tracking-wide"
        >Copyright © tailus <span id="year"></span> | All right reserved</span
        >
        </div>
      </div>
    </div>
  </footer>


</template>

<script setup>
import {ref} from 'vue'
import {Head, Link} from '@inertiajs/inertia-vue3';
import Plans from "@/Pages/Home/Partials/Plans.vue";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  plans: Object,
  plansMonthly:Object,
  plansYearly:Object,
})

const navigation = [
  {name: 'Product', href: '#'},
  {name: 'Features', href: '#'},
  {name: 'Marketplace', href: '#'},
  {name: 'Company', href: '#'},
]

const mobileMenuOpen = ref(false)
</script>

