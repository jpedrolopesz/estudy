<template>
  <AuthenticatedUserLayout>



    <ul class="divide-y divide-slate-100">
    <li v-for="courses in course" :key="courses.id" class="flex items-start space-x-6 p-6">
      <img  v-bind:src="courses.thumbnail" alt="" width="60" height="88" class="flex-none rounded-md bg-slate-100" />
      <div class="min-w-0 relative flex-auto">
        <h2 class="font-semibold text-slate-900 truncate pr-20">{{courses.title}}</h2>
        <dl class="mt-2 flex flex-wrap text-sm leading-6 font-medium">
          <div class="absolute top-0 right-0 flex items-center space-x-1">
            <dt class="text-sky-500">


              <span class="sr-only">Access</span>
              <Link :href="route('courses.show', courses.id)">
              <svg width="16" height="20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
              </svg>
                Aqui</Link>

            </dt>
          </div>

          <div class="ml-2">
            <dt class="sr-only">Year</dt>
            <dd>{{moment(courses.created_at).format("DD-MM-YYYY") }}</dd>
          </div>
          <div>
            <dt class="sr-only">Genre</dt>
            <dd class="flex items-center">
              <svg width="2" height="2" fill="currentColor" class="mx-2 text-slate-300" aria-hidden="true">
                <circle cx="1" cy="1" r="1" />
              </svg>
              Personal Development
            </dd>
          </div>
          <div>
            <dt class="sr-only">Runtime</dt>
            <dd class="flex items-center">
              <svg width="2" height="2" fill="currentColor" class="mx-2 text-slate-300" aria-hidden="true">
                <circle cx="1" cy="1" r="1" />
              </svg>
              1h 46m
            </dd>
          </div>
          <div class="flex-none w-full mt-2 font-normal">
            <dt class="sr-only">Cast</dt>
            <dd class="text-slate-400">Joao P L Zamonelo</dd>
          </div>
        </dl>
      </div>
    </li>
    </ul>

  </AuthenticatedUserLayout>
</template>


<script>

import AuthenticatedUserLayout from "@/Pages/User/Layouts/Dashboard/AuthenticatedUserLayout.vue";
import moment from "moment";
import {Link} from "@inertiajs/inertia-vue3";



export default {

  components: {AuthenticatedUserLayout, Link},
  data() {
    return {
      moment: moment
    }
  },
  props:{
    course:Object
  }
}
</script>
