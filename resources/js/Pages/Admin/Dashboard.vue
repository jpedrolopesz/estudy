<template>
  <AdminLayout>


    <div class="w-full ">
      <div class="sm:flex sm:items-center mx-8 sm:justify-between">
        <div class="min-w-0 flex-1">

          <div class="mb-2">
            <h1 class="text-2xl md:text-3xl text-gray-800 font-bold">Welcome back, {{$page.props.auth.user.first_name}}</h1>
          </div>
          <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
            <p class="text-md text-gray-600 ">Here's what's happening</p>

          </div>
        </div>
      </div>
    </div>

    <section class="grid mx-8 my-8 md:grid-cols-2 xl:grid-cols-3 gap-6">
      <div class="flex items-center p-8 bg-white shadow rounded-lg">
        <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-purple-600 bg-purple-100 rounded-full mr-6">
          <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        </div>
        <div>
          <span class="block text-2xl font-bold">{{totalUsers}}</span>
          <span class="block text-gray-500">Students</span>
        </div>
      </div>
      <div class="flex items-center p-8 bg-white shadow rounded-lg">
        <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-green-100 rounded-full mr-6">
          <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
          </svg>
        </div>
        <div>
          <span class="block text-2xl font-bold">{{ balance.pending[0].amount }}</span>
          <span class="block text-gray-500">Pending </span>
        </div>
      </div>

      <div class="flex items-center p-8 bg-white shadow rounded-lg">
        <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
          </svg>

        </div>
        <div>
          <span class="block text-2xl font-bold">{{totalComments}}</span>
          <span class="block text-gray-500">Comments</span>
        </div>
      </div>
    </section>


  </AdminLayout>
</template>


<script setup>
import AdminLayout from "./Layouts/AdminLayout.vue";



defineProps({
  totalUsers: {type: Number , required: true},
  totalComments: {type: Number , required: true},
  balance: {type: Number , required: true},
})
</script>



