<template>
    <nav class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4  sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 ml-12 lg:ml-10 flex sm:flex  items-center">
                    <Link :href="route('dashboard')">
                        <ApplicationLogo class="block h-9 w-auto" />
                    </Link>
                </div>

            </div>

            <div class=" z-30 sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <Dropdown align="right" width="48">
                        <template #trigger>

                          <span class="inline-flex rounded-md">
                            <img class="w-8 h-8 rounded-full" width="32" height="32"
                                 v-bind:src="'/storage/user/' + $page.props.auth.user.image"
                                 :alt="$page.props.auth.user.name" />
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                              {{ $page.props.auth.user.first_name }}

                              <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                              </svg>
                            </button>
                          </span>
                        </template>

                        <template  #content>

                            <div class="pt-0.5 pb-2 px-3 mb-1 border-b border-slate-200">
                                <div class="truncate font-medium text-slate-600">
                                  {{ $page.props.auth.user.first_name}} {{$page.props.auth.user.last_name}}
                                </div>
                                <div class="text-xs text-slate-500 italic"> {{ $page.props.auth.user.email }}</div>
                            </div>

                            <DropdownLink :href="route('profile.edit')" >
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
    </div>
    </nav>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>
