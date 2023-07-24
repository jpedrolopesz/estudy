<template>
  <Head title="Purosaas Presentation"/>

    <!-- Header -->
    <div class="overflow-hidden relative w-full">
      <nav class="absolute w-full">
        <div class="container m-auto px-6 md:px-12 lg:px-7">
          <div class="flex flex-wrap items-center justify-between py-6 gap-6 md:py-4 md:gap-0 relative">
            <input type="checkbox" name="toggle_nav" id="toggle_nav" class="peer hidden">
            <div class="w-full flex justify-between md:w-max md:px-0">
              <a href="#" aria-label="logo" class="flex items-center">
                <img src="asset/logoe-estudiar.svg" class="w-8 grayscale contrast-200" alt="eStudy SAAS" width="144" height="68">
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

            <label role="button" class="fixed w-full z-10 h-full top-0 left-0 bg-gray-700 bg-opacity-40 hidden peer-checked:block md:peer-checked:hidden"></label>

            <div class="flex z-20 flex-col md:flex-row justify-between
                    items-center gap-y-4 p-6 bg-white dark:bg-gray-800 md:w-8/12
                    md:gap-y-4 md:p-0
                    md:bg-transparent lg:w-7/12 fixed top-0 -left-full transition-all duration-500 peer-checked:left-0 max-w-sm h-full
                    md:left-0 md:h-auto w-4/5 md:max-w-none md:relative lg:first-letter:top-0">
              <div class="flex md:hidden w-full pb-5">
                <a href="#" aria-label="logo">
                  <img src="images/logo.svg" class="w-36 grayscale contrast-200" alt="purosaas.com" width="144" height="68">
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

                <Link  :href="route('website.index')"
                       class="w-full py-1.5  px-6 text-center text-white rounded-sm transition font-bold bg-gray-900 hover:bg-gray-800 active:bg-gray-700 focus:bg-gray-800 md:w-maxunderline">
                  Access Now Demo
                </Link>

              </div>



            </div>
          </div>
        </div>
      </nav>


      <!-- Hero -->
      <div class="min-h-screen flex ">
        <div class="container m-auto px-6 py-40 md:px-12 lg:py-0 lg:px-7">
          <div class="flex items-center flex-wrap gap-12 lg:gap-0">
            <div class="lg:w-5/12 space-y-8">
            <span class="flex space-x-2 mt-12">
              <span class="block w-16 ml-2 mb-2 border-b-2 border-gray-600"></span>
              <span class="font-medium text-gray-600 dark:text-gray-400">launch produced by purosaas</span>
            </span>
              <h1 class="text-4xl font-bold md:text-5xl dark:text-white">Have your <br> own online course platform</h1>
              <p class="text-xl text-gray-700 dark:text-gray-300">Discover the freedom and potential of running your own online course platform, offering unique and valuable content to learners globally.</p>

              <div class="flex space-x-4">
                <button type="button" class="w-full py-2 px-6 text-center rounded-sm transition bg-gray-900 dark:bg-gray-700 hover:bg-gray-800 active:bg-gray-700 focus:bg-gray-800 sm:w-max">
                <span class="block text-white font-semibold">
                  Access Now Demo
                </span>
                </button>
              </div>

              <div class="flex-col hidden mt-12 sm:flex lg:mt-14">
                <p class=" text-sm font-medium tracking-widest text-gray-500 capitalize">Developed by:</p>
                <div class="flex">
                  <svg class="text-xl text-gray-500 tracking-widest font-medium capitalize italic " xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 600 100">
                    <text  y="35" class="duration-150 cursor-pointer fill-current transition-color hover:text-gray-600" >laravel</text>
                    <text x="90" y="35" class="duration-150 cursor-pointer fill-current transition-color hover:text-gray-600" >vue</text>
                    <text x="140" y="35" class="duration-150 cursor-pointer fill-current transition-color hover:text-gray-600" >inertia</text>
                    <text x="220" y="35" class="duration-150 cursor-pointer fill-current transition-color hover:text-gray-600" >tailwind</text>
                    <text x="320" y="35" class="duration-150 cursor-pointer fill-current transition-color hover:text-gray-600" >stripe</text>
                  </svg>


                </div>
                <a href="" class="hidden space-x-4 md:flex md:items-center">
                  <img class="w-14 h-14 rounded-full object-cover" src="/images/default.png" alt="">
                  <div class="text-gray-600">
                    <span class="text-sm">Question ?</span>
                    <p class="font-semibold text-gray-700">Talk to our developer.</p>
                  </div>
                </a>
              </div>




            </div>

            <div class="-z-10 relative md:left-28 w-6/8 lg:w-6/12">
              <div aria-hidden="true" class="absolute inset-0 m-auto w-[30rem] h-[30rem]  lg:w-[60rem] lg:h-[60rem] rounded-full bg-gray-200">

              </div>
              <img src="/asset/hero.jpeg" class="relative border   rounded-md ml-auto" alt="">
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Section One -->
    <div class="py-16">
      <div class="container m-auto px-6 text-gray-600 md:px-12 lg:py-0 lg:px-7">
        <div class="lg:py-4  space-y-6 md:flex flex-row-reverse md:gap-6 justify-center md:space-y-0 lg:items-center">
          <div class="lg:w-5/12 space-y-2">
            <h2 class="text-2xl font-bold text-gray-900 md:text-4xl">
              Elevate your teaching experience today!
            </h2>
            <p class="my-8 text-gray-600 dark:text-gray-300">
              Our platform offers robust support for each video, ensuring an immersive and engaging learning environment

            </p>
            <div class="divide-y space-y-2 divide-gray-100">

              <div class="pt-4 flex gap-4 md:items-center">
                <div class="w-12 h-12 flex gap-4 rounded-full bg-gray-100">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke-width="1.5"  class="w-6 h-6 m-auto text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round"   d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                  </svg>
                </div>

                <div class="w-5/6">
                  <h3 class="font-semibold text-lg text-gray-700 dark:text-teal-300">Control Video Speed</h3>
                  <p class="text-gray-500 text-xs dark:text-gray-400">Freedom to manipulate the speed of the videos they watch. Designed to enhance the viewing experience, this application allows you to speed up slow moments.</p>
                </div>
              </div>

              <div class="pt-4 flex gap-4 md:items-center">
                <div class="w-12 h-12 flex gap-4 rounded-full bg-teal-100">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="1.5"  stroke="currentColor"  class="w-6 h-6 text-teal-400 m-auto  ">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                  </svg>

                </div>
                <div class="w-5/6">
                  <h3 class="font-semibold text-lg text-gray-700 dark:text-teal-300">Recurring payments</h3>
                  <p class="text-gray-500 text-xs dark:text-gray-400">Incorporated feature that allows users to log all watched content. Making it easier to revisit or continue watching specific content.</p>
                </div>
              </div>

              <div class="pt-4 flex gap-4 md:items-center">
                <div class="w-12 h-12 flex gap-4 rounded-full bg-red-100">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"   class="w-6 h-6 text-red-400 m-auto  ">
                    <path stroke-linecap="round"  stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" class="text-red-100" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                </div>
                <div class="w-5/6">
                  <h3 class="font-semibold text-lg text-gray-700 dark:text-teal-300">Viewing history</h3>
                  <p class="text-gray-500 text-xs dark:text-gray-400">Incorporated feature that allows users to log all watched content. Making it easier to revisit or continue watching specific content.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="relative w-6/8 lg:w-6/12">
            <img class="z-10 border rounded-md" src="/asset/sectionOne.jpeg"/>
            <div class="flex items-center">
              <img class=" mt-4 w-3/5 z-10 border rounded-md" src="/asset/sectionTwo.jpeg"/>
              <div>
                <img class="mx-2 mt-4 w-4/4 -z-50 border rounded-md" src="/asset/sectionpay.jpeg" alt="image"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Section Two -->
     <div class="py-16">
      <div class="container m-auto px-6 text-gray-600 md:px-12 lg:py-0 lg:px-7">
        <div class="lg:py-4  space-y-6 md:flex flex-row-reverse md:gap-6 justify-center md:space-y-0 lg:items-center">
          <div class="relative w-6/8 lg:w-6/12">
            <img class="z-10 border rounded-md" src="/asset/adSectionChat.jpeg"/>
            <div class="flex items-center">
              <img class=" mt-4 w-3/5 z-10 border rounded-md" src="/asset/adSectionPlan.jpeg"/>
              <div>
                <img class="mx-2 mt-4 w-4/4 -z-50 border rounded-md" src="/asset/adSectionInfo.jpeg" alt="image"/>
              </div>
            </div>
          </div>
          <div class="lg:w-5/12 space-y-2">
            <h2 class="text-2xl font-bold text-gray-900 md:text-4xl">
              Power is in Your Hands!
            </h2>
            <p class="my-8 text-gray-600 dark:text-gray-300">
              In addition to an intuitive and user-friendly interface, the app owner will have access to a robust control panel. The app owner will have the freedom to stress and shape their teaching experiences

            </p>
            <div class="divide-y space-y-2 divide-gray-100">

              <div class="pt-1 flex gap-4 md:items-center">
                <div class="w-12 h-12 flex gap-4 rounded-full bg-indigo-100">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 m-auto text-indigo-500 dark:text-indigo-400">
                    <path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 01-3.476.383.39.39 0 00-.297.17l-2.755 4.133a.75.75 0 01-1.248 0l-2.755-4.133a.39.39 0 00-.297-.17 48.9 48.9 0 01-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97zM6.75 8.25a.75.75 0 01.75-.75h9a.75.75 0 010 1.5h-9a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H7.5z" clip-rule="evenodd" />
                  </svg>
                </div>
                <div class="w-5/6">
                  <h3 class="font-semibold text-lg text-gray-700">Support Anytime</h3>
                  <p class="text-gray-500 text-xs dark:text-gray-400">Dynamic communication that makes connection easier with the ability to communicate and share experiences with each video, enabling support for users.</p>
                </div>
              </div>

              <div class="pt-4 flex gap-4 md:items-center">
                <div class="w-12 h-12 flex gap-4 rounded-full bg-gray-100">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke-width="1.5"  class="w-6 h-6 m-auto text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round"   d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                  </svg>
                </div>

                <div class="w-5/6">
                  <h3 class="font-semibold text-lg text-gray-700 dark:text-teal-300">Creation of plans</h3>
                  <p class="text-gray-500 text-xs dark:text-gray-400">Freedom to manipulate the speed of the videos they watch. Designed to enhance the viewing experience, this application allows you to speed up slow moments.</p>
                </div>
              </div>

              <div class="pt-4 flex gap-4 md:items-center">
                <div class="w-12 h-12 flex gap-4 rounded-full bg-teal-100">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="1.5"  stroke="currentColor"  class="w-6 h-6 text-teal-400 m-auto  ">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                  </svg>

                </div>
                <div class="w-5/6">
                  <h3 class="font-semibold text-lg text-gray-700 dark:text-teal-300">Control payments</h3>
                  <p class="text-gray-500 text-xs dark:text-gray-400">Incorporated feature that allows users to log all watched content. Making it easier to revisit or continue watching specific content.</p>
                </div>
              </div>


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
            A technology-first approach to having your  <br class="lg:block" hidden/>
            own online course platform
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



const mobileMenuOpen = ref(false)
</script>

