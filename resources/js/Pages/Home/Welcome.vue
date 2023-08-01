<template>
  <Head title="Purosaas Presentation"/>

  <div class="relative flex min-h-screen flex-col justify-center overflow-hidden ">
    <div class="absolute inset-0 bg-[url(/asset/patterns.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>

    <!-- Header -->
    <div class="overflow-hidden relative w-full">
      <nav class="absolute w-full">
        <div class="container m-auto px-6 md:px-12 lg:px-7">
          <div class="flex flex-wrap items-center justify-between py-6 gap-6 md:py-4 md:gap-0 relative">
            <input type="checkbox" name="toggle_nav" id="toggle_nav" class="peer hidden">
            <div class="w-full flex justify-between md:w-max md:px-0">
              <a href="#" aria-label="logo" class="flex items-center">
                <img src="/asset/logoe-estudiar.svg" class="w-8 grayscale contrast-200" alt="eStudy SAAS" width="144" height="68">
                <span class="font-semibold text-lg">eStudy</span>
              </a>


              <div class="flex items-center md:hidden max-h-10">
                <label role="button" for="toggle_nav" aria-label="humburger" id="hamburger"
                       class="relative z-40 px-2 py-3 sm:-mr-6">
                  <div id="line"
                       class="m-auto h-0.5 w-6 rounded bg-sky-900 transition duration-300"></div>
                  <div id="line2"
                       class="m-auto mt-2 h-0.5 w-6 rounded bg-sky-900 transition duration-300">
                  </div>
                </label>
              </div>
            </div>

            <label role="button" class="fixed w-full z-10 h-full top-0 left-0 bg-gray-700 bg-opacity-40 hidden peer-checked:block md:peer-checked:hidden"></label>

            <div class="flex z-20 flex-col md:flex-row justify-between
                    items-center gap-y-4 p-6 bg-white md:w-8/12
                    md:gap-y-4 md:p-0
                    md:bg-transparent lg:w-7/12 fixed top-0 -left-full transition-all duration-500 peer-checked:left-0 max-w-sm h-full
                    md:left-0 md:h-auto w-4/5 md:max-w-none md:relative lg:first-letter:top-0">
              <div class="flex md:hidden w-full pb-5">
                <a class="flex items-center" aria-label="logo">
                  <img src="/asset/logoe-estudiar.svg" class="w-8 grayscale contrast-200" alt="eStudy SAAS" width="144" height="68">
                  <span class="font-semibold text-lg">eStudy</span>
                </a>
              </div>
              <div class="block w-full h-full md:h-auto">
                <ul class="space-y-8 tracking-wide font-medium md:flex md:space-y-0">
                  <li>
                    <a href="" class="block md:px-3">
                      <div class="relative text-gray-800 before:absolute before:-inset-2 before:w-full before:h-0.5 before:origin-left before:mx-auto before:mt-auto before:rounded-full before:bg-gray-800">
                        <span>Home</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="mailto:purosaas@hotmail.com" class="block md:px-3 group">
                      <div class="relative text-gray-600 before:absolute before:-inset-2 before:w-full before:h-0.5 before:origin-left before:mx-auto before:mt-auto before:rounded-full before:bg-gray-800 before:transition before:scale-x-0 group-hover:before:scale-x-100">
                      <span class="transition group-hover:text-gray-700">
                        Contact
                      </span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="/login" class="block md:px-3 group">
                      <div class="relative text-gray-600 before:absolute before:-inset-2 before:w-full before:h-0.5 before:origin-left before:mx-auto before:mt-auto before:rounded-full before:bg-gray-800 before:transition before:scale-x-0 group-hover:before:scale-x-100">
                      <span class="transition group-hover:text-gray-700">
                        Demo
                      </span>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>

              <div class="w-full space-x-4 gap-y-4 md:max-w-max md:gap-y-0 md:gap-x-4 flex ">

                <Link  :href="route('login')"
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
              <span class="block w-20 ml-2 mb-2 border-b-2 border-gray-600"></span>
              <span class="font-medium text-gray-600">produced by
                <span class="underline">purosaas.com</span></span>
            </span>
              <h1 class="text-4xl font-bold md:text-5xl">Have your <br> own online course platform</h1>
              <p class="text-xl text-gray-700">Discover the freedom and potential of running your own online course platform, offering unique and valuable content to learners globally.</p>

              <div class="flex items-center space-x-4">
                <Link :href="route('login')" class="w-80 sm:w-full py-2 px-6 text-center rounded-sm transition bg-gray-900 hover:bg-gray-800 active:bg-gray-700 focus:bg-gray-800 sm:w-max">
                <span class="block text-white font-semibold">
                  Access Now Demo
                </span>

                </Link>
                <a href="#" class="text-sm flex items-center font-semibold leading-6 text-gray-600">Buy Now <span aria-hidden="true">→</span></a>
              </div>


              <div class="flex-col hidden mt-12 sm:flex lg:mt-14">
                <p class=" text-sm font-medium tracking-widest text-gray-500 capitalize">Technologies used:</p>
                <div class="flex">
                  <svg class="text-xl text-gray-500 tracking-widest font-medium capitalize italic " xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 600 100">
                    <text  y="35" class="duration-150 cursor-pointer fill-current transition-color hover:text-gray-600" >laravel</text>
                    <text x="90" y="35" class="duration-150 cursor-pointer fill-current transition-color hover:text-gray-600" >vue</text>
                    <text x="140" y="35" class="duration-150 cursor-pointer fill-current transition-color hover:text-gray-600" >inertia</text>
                    <text x="220" y="35" class="duration-150 cursor-pointer fill-current transition-color hover:text-gray-600" >tailwind</text>
                    <text x="320" y="35" class="duration-150 cursor-pointer fill-current transition-color hover:text-gray-600" >stripe</text>
                  </svg>


                </div>
                <a href="mailto:purosaas.com" class="hidden space-x-4 md:flex md:items-center">
                  <img class="w-14 h-14 rounded-full object-cover" src="/asset/eu.jpg" alt="">
                  <div class="text-gray-600">
                    <span class="text-sm">Question ?</span>
                    <p class="font-semibold text-gray-700">Talk to the developer.</p>
                  </div>
                </a>
              </div>




            </div>

            <div class=" relative md:left-28 w-6/8 lg:w-6/12">

              <img class="ml-auto border shadow-lg z-20 left-0 w-[57rem] w-full sm:max-w-none rounded-md bg-white/5 ring-1 ring-white/10" src="/asset/hero.jpeg" alt="" width="1824" height="1080">

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
            <p class="my-8 text-gray-600">
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
                  <h3 class="font-semibold text-lg text-gray-700">Control Video Speed</h3>
                  <p class="text-gray-500 text-xs">Freedom to manipulate the speed of the videos they watch. Designed to enhance the viewing experience, this application allows you to speed up slow moments.</p>
                </div>
              </div>

              <div class="pt-4 flex gap-4 md:items-center">
                <div class="w-12 h-12 flex gap-4 rounded-full bg-teal-100">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="1.5"  stroke="currentColor"  class="w-6 h-6 text-teal-400 m-auto  ">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                  </svg>

                </div>
                <div class="w-5/6">
                  <h3 class="font-semibold text-lg text-gray-700">Recurring payments</h3>
                  <p class="text-gray-500 text-xs">Incorporated feature that allows users to log all watched content. Making it easier to revisit or continue watching specific content.</p>
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
                  <h3 class="font-semibold text-lg text-gray-700">Viewing history</h3>
                  <p class="text-gray-500 text-xs">Incorporated feature that allows users to log all watched content. Making it easier to revisit or continue watching specific content.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="relative w-6/8 lg:w-6/12">
            <img class="z-10 border rounded-md shadow-md" src="/asset/sectionOne.jpeg"/>
            <div class="flex items-center">
              <img class=" mt-4 w-3/5 z-10 border shadow-md rounded-md" src="/asset/sectionTwo.jpeg"/>
              <div>
                <img class="mx-2 mt-4 w-4/4 -z-50 border shadow-md rounded-md" src="/asset/sectionpay.jpeg" alt="image"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Section Two -->
    <div class="py-16 ">
      <div class="container m-auto px-6 text-gray-600 md:px-12 lg:py-0 lg:px-7">
        <div class="lg:py-4  space-y-6 md:flex flex-row-reverse md:gap-6 justify-center md:space-y-0 lg:items-center">
          <div class="relative w-6/8 lg:w-6/12">
            <img class="z-10 border rounded-md shadow-md" src="/asset/adSectionChat.jpeg"/>
            <div class="flex items-center">
              <img class=" mt-4 w-3/5 z-10 border rounded-md shadow-md" src="/asset/adSectionPlan.jpeg"/>
              <div>
                <img class="mx-2 mt-4 w-4/4 -z-50 border rounded-md shadow-md" src="/asset/adSectionInfo.jpeg" alt="image"/>
              </div>
            </div>
          </div>
          <div class="lg:w-5/12 space-y-2">
            <h2 class="text-2xl font-bold text-gray-900 md:text-4xl">
              Power is in Your Hands!
            </h2>
            <p class="my-8 text-gray-600">
              In addition to an intuitive and user-friendly interface, the app owner will have access to a robust control panel. The app owner will have the freedom to stress and shape their teaching experiences

            </p>
            <div class="divide-y space-y-2 divide-gray-100">

              <div class="pt-1 flex gap-4 md:items-center">
                <div class="w-12 h-12 flex gap-4 rounded-full bg-indigo-100">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 m-auto text-indigo-500">
                    <path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 01-3.476.383.39.39 0 00-.297.17l-2.755 4.133a.75.75 0 01-1.248 0l-2.755-4.133a.39.39 0 00-.297-.17 48.9 48.9 0 01-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97zM6.75 8.25a.75.75 0 01.75-.75h9a.75.75 0 010 1.5h-9a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H7.5z" clip-rule="evenodd" />
                  </svg>
                </div>
                <div class="w-5/6">
                  <h3 class="font-semibold text-lg text-gray-700">Support Anytime</h3>
                  <p class="text-gray-500 text-xs">Dynamic communication that makes connection easier with the ability to communicate and share experiences with each video, enabling support for users.</p>
                </div>
              </div>

              <div class="pt-4 flex gap-4 md:items-center">
                <div class="w-12 h-12 flex gap-4 rounded-full bg-gray-100">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke-width="1.5"  class="w-6 h-6 m-auto text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round"   d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                  </svg>
                </div>

                <div class="w-5/6">
                  <h3 class="font-semibold text-lg text-gray-700 ">Creation of plans</h3>
                  <p class="text-gray-500 text-xs ">Control and create customized plans for your future customers, allowing you to adapt to their needs and preferences. Make the most of it to attract and retain customers, paving new ways for your business.</p>
                </div>
              </div>

              <div class="pt-4 flex gap-4 md:items-center">
                <div class="w-12 h-12 flex gap-4 rounded-full bg-teal-100">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="1.5"  stroke="currentColor"  class="w-6 h-6 text-teal-400 m-auto  ">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                  </svg>

                </div>
                <div class="w-5/6">
                  <h3 class="font-semibold text-lg text-gray-700 ">Control payments</h3>
                  <p class="text-gray-500 text-xs ">Gain access and maintain transparent control over your billing process. With an intuitive and easy-to-use interface, you can manage all your transactions transparently.</p>
                </div>
              </div>


            </div>
          </div>

        </div>
      </div>
    </div>


    <!-- Section Zero -->
    <div class="relative isolate overflow-hidden bg-gray-900 pt-16   md:pt-24 lg:flex  lg:pt-0">
      <svg viewBox="1024 1024" class="absolute left-56 -top-44 h-[64rem] w-[64rem]  [mask-image:radial-gradient(closest-side,white,transparent)]  -translate-x-1/1 translate-y-1/2 " aria-hidden="true">
        <circle cx="512" cy="512" r="512" fill="url(#759c1415-0410-454c-8f7c-9a820de03641)" fill-opacity="0.7" />
        <defs>
          <radialGradient id="759c1415-0410-454c-8f7c-9a820de03641">
            <stop stop-color="#FFF" />
            <stop offset="1" stop-color="#transparent" />
          </radialGradient>
        </defs>
      </svg>
      <div class="container m-auto px-6 text-gray-600 ">
        <div class="  rounded-[4rem] space-y-6 md:flex flex-row-reverse md:gap-6 justify-center md:space-y-0 lg:items-center">

          <div class="md:7/12 lg:w-1/2">
            <div class="flex items-center">
              <span class="block h-8 border-l-8  border-green-300"></span>

              <h2 class="text-3xl ml-2 font-bold text-green-500 md:text-4xl ">
                Positive Points
              </h2>
            </div>

            <ul>
              <li v-for="item in positive" :key="item.name" class="mt-8 flex gap-4 md:items-center">
                <svg class="h-6 w-6 flex-none fill-green-100 stroke-green-500 stroke-2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10" />
                  <path d="m8 13 2.165 2.165a1 1 0 0 0 1.521-.126L16 9" fill="none" />
                </svg>
                <div class="w-5/6">
                  <h3 class="font-semibold text-lg text-gray-200">
                    {{ item.name }}
                  </h3>
                  <p class="text-gray-500 dark:text-gray-400">
                    {{item.description}}
                  </p>
                </div>
              </li>
            </ul>
          </div>
          <img class="relative  max-h-0 md:max-h-screen " src="/asset/raio.svg"/>


          <div class="md:7/12 lg:w-1/2">
            <div class="flex items-center">
              <span class="block h-8  border-l-8  border-red-300"></span>

              <h2 class="text-3xl ml-2 font-bold text-red-500 md:text-4xl ">
                Pain Points
              </h2>
            </div>

            <ul>
              <li v-for="item in negative" :key="item.name" class="mt-8 flex gap-4 md:items-center">
                <svg  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6  fill-red-100 stroke-red-500 stroke-2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <div class="w-5/6">
                  <h3 class="font-semibold text-lg text-gray-200">
                    {{ item.name }}
                  </h3>
                  <p class="text-gray-500 dark:text-gray-400">
                    {{item.description}}
                  </p>
                </div>
              </li>

            </ul>
          </div>

        </div>
      </div>
    </div>


    <!-- CTA -->
    <div>
      <div class="relative isolate overflow-hidden bg-gray-900  px-6  shadow-2xl  sm:px-16  lg:flex lg:gap-x-20 lg:px-24 ">

        <div class="mx-auto max-w-md my-44 text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">

          <h2 class="text-3xl font-bold  tracking-tight mb-10 text-white sm:text-6xl">Have your
            own online course platform
          </h2>

          <Link :href="route('login')" class="w-full px-20 mt-20 text-gray-900 font-semibold  py-2 px-6 text-center rounded-sm transition bg-white hover:bg-gray-200 active:bg-gray-300 focus:bg-gray-300 ">
            Buy Now

          </Link>
        </div>
        <div class="relative my-44">
          <img class="absolute left-0 top-0 w-[60rem] max-w-none rounded-md bg-white/5 ring-1 ring-white/10" src="/asset/sectionOne.jpeg" alt="" width="1824" height="1080">
          <svg viewBox="1024 1024" class="absolute  bg-button left-[30rem] top-[11rem]  -z-10 h-[64rem] w-[64rem]  [mask-image:radial-gradient(closest-side,white,transparent)] left-full -ml-96  -translate-x-1/1 -translate-y-1/2 " aria-hidden="true">
            <circle cx="512" cy="512" r="512" fill="url(#759c1415-0410-454c-8f7c-9a820de03641)" fill-opacity="0.7" />
            <defs>
              <radialGradient id="759c1415-0410-454c-8f7c-9a820de03641">
                <stop stop-color="#transparent" />
                <stop offset="1" stop-color="#transparent" />
              </radialGradient>
            </defs>
          </svg>
        </div>
      </div>
    </div>






    <!-- Footer -->
    <footer class="w-full bg-gray-100 py-16">
      <div class="md:px-12 lg:px-28">
        <div class="container m-auto space-y-6 text-gray-600">
          <div class="m-auto flex sm:w-max items-center justify-between space-x-4">
            <div class="text-center">
              <span class="text-sm w-3/4 tracking-wide">Copyright © 2023 by <span class="underline">Purosaas</span>  | All rights reserved. No part of this document may be reproduced, <br> without prior written permission of the copyright holder.</span>

            </div>
          </div>

        </div>
      </div>
    </footer>

  </div>


</template>

<script setup>
import {reactive, ref} from 'vue'
import {Head, Link} from '@inertiajs/inertia-vue3';


const negative = reactive([
  { name: 'Exorbitant Commissions', description: 'Third-party platforms often extort high commissions from course sales. Say goodbye to your profits!' },
  { name: 'Limited Control', description: 'On a third-party platform, your ability to shape the user experience is practically nil. You\'re at the mercy of the platform\'s decisions.' },
  { name: 'Personalization Limitations', description: 'Third-party platforms limit your creativity and course personalization. How can you offer a unique experience under these restrictions?' },
  { name: 'Dependence', description: 'Relying on a third-party platform risks your business if they fail or change policies.' }
]);

const positive = reactive([
  { name: 'Take Control', description: ' Your platform, your rules! Master every aspect of user experience, from the look and feel to the customer support.' },
  { name: 'Profit Your Way', description: 'Unleash your entrepreneurial spirit! Your platform, your rules. Shape your financial success as freely as an artist paints a canvas!' },
  { name: 'Stand Out', description: ' Harness the power of a distinct brand. Your own platform can foster loyalty and spark word-of-mouth promotion.' },
  { name: 'Adapt Swiftly', description: 'Seize opportunities with speed. With your own platform, you can implement fresh ideas instantly, no approvals needed.' }
]);

const mobileMenuOpen = ref(false)
</script>

