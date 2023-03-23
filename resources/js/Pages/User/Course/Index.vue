<template>
  <Head title="Courses" />

  <AuthenticatedUserLayout>

    <div class="w-full ">
      <div class="sm:flex sm:items-center mx-8 sm:justify-between">
        <div class="min-w-0 flex-1">

          <div class="mb-2">
            <h1 class="font-medium text-2xl lg:text-3xl opacity-75">Courses</h1>
          </div>
        </div>

        <div class="flex items-center">
          <FormSearch class="w-full m-6" v-model="form.search" @reset="reset">
            <label class="block text-gray-700">Role:</label>
            <select v-model="form.role" class=" border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2">
              <option :value="null" />
              <option value="user">User</option>
              <option value="owner">Owner</option>
            </select>
            <label class="block mt-4 text-gray-700">Trashed:</label>
            <select v-model="form.trashed" class="border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2">
              <option :value="null" />
              <option value="with">With Trashed</option>
              <option value="only">Only Trashed</option>
            </select>
          </FormSearch>


          <div>
            <Link :href="route('users.create')" type="button" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">

              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
              </svg>

              Course

            </Link>
          </div>

        </div>
      </div>
    </div>

    <div class="bg-white ml-2 shadow-lg rounded-md border border-slate-200 relative">
      <header class="px-5 py-4">
        <h2 class="font-semibold text-slate-800">All Course <span class="text-slate-400 font-medium">{{courses.length}}  </span></h2>
      </header>


      <div>

        <!-- Table -->
        <div class="overflow-x-auto  ">
          <table class="table-auto w-full">
            <!-- Table header -->
            <thead class="text-xs font-semibold  uppercase text-slate-500 bg-slate-50  border-t border-b border-slate-200">
            <tr>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Courses</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Price</div>
              </th>
              <th colspan="2" class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Users</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Status</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <span class="font-semibold text-left">Action</span>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <span class="sr-only">Menu</span>
              </th>

            </tr>
            </thead>

            <!-- Table body -->
            <tbody class="text-sm divide-y divide-slate-200 "
                   v-for="course in courses"
                   :key="course.id">
            <tr>

              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap ">
                <div class="flex items-center">
                  <div class="w-10 h-10 shrink-0 mr-2 sm:mr-3">
                    <img  v-bind:src="course.thumbnail" alt="" width="80" height="88" />
                  </div>
                  <div class="font-medium text-slate-800">{{course.title}}
                    <p class="font-medium flex text-xs text-slate-800">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                      </svg>


                      {{moment(course.created_at).format("MMMM, DD-YYYY") }}</p>
                  </div>
                </div>

              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="text-left">{{course.price}}</div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="text-left">34</div>
              </td>

              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="sr-only"></div>
              </td>



              <td class="px-2 inline-flex first:pl-5 last:pr-5 py-6 whitespace-nowrap">
                <div v-if="!course.deleted_at" class="bg-emerald-100 text-emerald-600 text-left rounded-full text-center px-2.5 ">Active</div>
                <div v-if="course.deleted_at" class=" bg-amber-100 text-amber-600 text-left rounded-full text-center px-2.5">Disabled</div>
              </td>

              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                <div class="space-x-1 inline-flex">

                  <Link :href="route('courses.edit', course.id)"  class="text-slate-400 hover:text-slate-500 rounded-full">
                    <span class="sr-only">Edit</span>
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>

                  </Link>
                  <Link :href="route('courses.show', course.id)"  class="text-slate-400 items-center hover:text-slate-500 ">
                    <span class="sr-only">Show</span>
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                    </svg>

                  </Link>


                  <ModalDelete >

                    <div class="flex ml-2 justify-between">
                      <Link href="" as="button" type="button" method="DELETE"
                            class="btn bg-red-600 text-sm text-white hover:bg-red-700 ">
                        Yes, delete
                      </Link>

                    </div>
                  </ModalDelete>

                </div>
              </td>

            </tr>


            </tbody>
            <tr v-if="courses.length === 0">
              <td class="px-6 py-4 border-t" colspan="4">No users found.</td>
            </tr>
          </table>



        </div>
      </div>
    </div>



  </AuthenticatedUserLayout>
</template>


<script>

import AuthenticatedUserLayout from "@/Pages/User/Layouts/Dashboard/AuthenticatedUserLayout.vue";
import moment from "moment";
import {Link, Head} from "@inertiajs/inertia-vue3";
import FormSearch from "@/Components/FormSearch.vue";
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import mapValues from "lodash/mapValues";
import ModalDelete from "@/Components/ModalDelete.vue";

export default {
  components: {ModalDelete, FormSearch, AuthenticatedUserLayout, Link, Head},
  props:{
    filters:Object,
    courses:Object
  },
  data() {
    return {
      moment: moment,
      form: {
        search: this.filters.search,
        role: this.filters.role,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/courses', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },

  },
}
</script>
