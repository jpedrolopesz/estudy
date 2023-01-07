<template>

  <Head  title="Dashboard" />

  <AuthenticatedUserLayout>

    <div class="w-full ">
      <div class="sm:flex sm:items-center mx-8 sm:justify-between">
        <div class="min-w-0 flex-1">

          <div class="mb-2">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Dashboard User</h1>
          </div>
          <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">

            <nav class="flex mb-2" aria-label="Breadcrumb">
              <ul class="inline-flex flex-wrap text-sm font-medium">
                <li class="after:content-['/'] last:after:hidden after:text-slate-400 after:px-2">
                  <BreadcrumbLink  :active="route().current('dashboard')">
                    Dashboard
                  </BreadcrumbLink>
                </li>
              </ul>
            </nav>

          </div>
        </div>


      </div>
    </div>



  </AuthenticatedUserLayout>
</template>


<script setup>
import AuthenticatedUserLayout from "@/Pages/User/Layouts/Dashboard/AuthenticatedUserLayout.vue";
import {Link, Head,} from "@inertiajs/inertia-vue3";
</script>



