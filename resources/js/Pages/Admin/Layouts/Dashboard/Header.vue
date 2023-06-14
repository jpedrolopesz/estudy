<template>
  <div class="flex items-center justify-end mt-3.5">



        <div class=" z-30 sm:flex sm:items-center sm:ml-6">
          <!-- Settings Dropdown -->


          <div class="ml-3 mt-1 relative">
            <Dropdown align="right" width="48">
              <template #trigger>
                <button type="button" class=" px-1 py-0.5 text-lg font-bold rounded-md text-gray-900 hover:bg-gray-200 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                  </svg>
                </button>
              </template>
              <template  #content>
                <div class="pt-0.5 pb-2 px-3 mb-1 border-b border-slate-200">
                  <div class="truncate font-medium text-slate-600">
                    {{ $page.props.auth.user.first_name}} {{$page.props.auth.user.last_name}}
                  </div>
                  <div class="text-xs text-slate-500 italic"> {{ $page.props.auth.user.email }}</div>
                </div>
                <DropdownLink :href="route('admin.profile.edit')" >
                  Account
                </DropdownLink>
                <DropdownLink :href="route('logout')" method="post" as="button">
                  Log Out
                </DropdownLink>

              </template>
            </Dropdown>
          </div>

        </div>
      </div>
</template>

<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';


</script>



