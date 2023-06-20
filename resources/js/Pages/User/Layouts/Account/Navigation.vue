<template>
  <div class="w-18 ml-1 mr-2 md:w-1/5">

      <div class="relative flex flex-col items-start justify-center w-full py-6 bg-white border rounded-lg border-gray-150">
        <h3 class="hidden px-6 pb-3 text-xs font-semibold leading-4 tracking-wider text-gray-500 uppercase md:block">Settings</h3>


        <!-- Profile -->
        <NavigationLink :href="route('profile.edit')" :active="route().current('profile.edit')">
          <UserIcon class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-150 ease-in-out group-hover:text-gray-900 group-focus:text-gray-900"/>
          <span class="hidden truncate md:inline-block  text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-900 group-focus:text-gray-900">
            Profile
          </span>
        </NavigationLink>

        <!-- Password -->
        <NavigationLink :href="route('password.edit')" :active="route().current('password.edit')">
          <LockClosedIcon class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-150 ease-in-out group-hover:text-gray-900 group-focus:text-gray-900"/>
          <span class="hidden truncate md:inline-block text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-900 group-focus:text-gray-900">
            Password
          </span>
        </NavigationLink>



      </div>

      <div class="relative mt-4 flex flex-col items-start justify-center w-full py-6 bg-white border rounded-lg border-gray-150">
        <h3 class="hidden px-6 pb-3 text-xs font-semibold leading-4 tracking-wider text-gray-500 uppercase md:block">Billing</h3>


        <!-- Plans -->
        <NavigationLink :href="route('plans.show')" :active="route().current('plans.show')">
          <TicketIcon class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-150 ease-in-out group-hover:text-gray-900 group-focus:text-gray-900"/>
          <span class="hidden truncate md:inline-block  text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-900 group-focus:text-gray-900">
            Plans
          </span>
        </NavigationLink>


        <!-- Password -->
        <NavigationLink  :href="route('invoice.show')" :active="route().current('invoice.show')" >
          <BanknotesIcon class="flex-shrink-0 w-5 h-5  text-gray-500 transition duration-150 ease-in-out group-hover:text-gray-900 group-focus:text-gray-900"/>
          <span class="hidden truncate md:inline-block  text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-900 group-focus:text-gray-900">
            Billing & Invoices
          </span>
        </NavigationLink>



      </div>

    </div>
</template>


<script setup>

import NavigationLink from "@/Components/NavigationLink.vue";
import {
  UserIcon,
  LockClosedIcon,
  TicketIcon,
  BanknotesIcon
} from '@heroicons/vue/24/outline';


</script>


