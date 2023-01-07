<template>
  <Head  title="Users" />

  <AuthenticatedLayout>


    <div class="w-full ">
      <div class="sm:flex sm:items-center mx-8 sm:justify-between">
        <div class="min-w-0 flex-1">

          <div class="mb-2">
            <h1 class="font-medium text-2xl lg:text-3xl opacity-75">Users</h1>
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

              Users

            </Link>
          </div>

        </div>
      </div>
    </div>


    <div class="bg-white ml-2 shadow-lg rounded-md border border-slate-200 relative">
      <header class="px-5 py-4">
        <h2 class="font-semibold text-slate-800">All Users <span class="text-slate-400 font-medium">{{users.length}}  </span></h2>
      </header>


      <div>

        <!-- Table -->
        <div class="overflow-x-auto  ">
          <table class="table-auto w-full">
            <!-- Table header -->
            <thead class="text-xs font-semibold  uppercase text-slate-500 bg-slate-50  border-t border-b border-slate-200">
            <tr>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Profiles</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Email</div>
              </th>
              <th colspan="2" class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Role</div>
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
                   v-for="user in users"
                   :key="user.id">
            <tr>

              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap ">
                <div class="flex items-center">
                  <div class="w-10 h-10 shrink-0 mr-2 sm:mr-3">
                    <img  class="rounded-full" v-bind:src="'/storage/user/' + user.photo" />
                  </div>
                  <div class="font-medium text-slate-800">{{user.name}}</div>
                </div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="text-left">{{user.email}}</div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="text-left">{{ user.owner ? 'Owner' : 'User' }}</div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="sr-only"></div>
              </td>



              <td class="px-2 inline-flex first:pl-5 last:pr-5 py-6 whitespace-nowrap">
                <div v-if="!user.deleted_at" class="bg-emerald-100 text-emerald-600 text-left rounded-full text-center px-2.5 ">Active</div>
                <div v-if="user.deleted_at" class=" bg-amber-100 text-amber-600 text-left rounded-full text-center px-2.5">Disabled</div>
              </td>

              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                <div class="space-x-1 inline-flex">

                  <Link :href="route('user.edit', user.id)"  class="text-slate-400 hover:text-slate-500 rounded-full">
                    <span class="sr-only">Edit</span>
                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                      <path d="M19.7 8.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM12.6 22H10v-2.6l6-6 2.6 2.6-6 6zm7.4-7.4L17.4 12l1.6-1.6 2.6 2.6-1.6 1.6z"></path>
                    </svg>
                  </Link>


                  <ModalDelete >

                    <div class="flex ml-2 justify-between">


                        <Link :href="route('users.destroy', user.id)" as="button" type="button" method="DELETE"
                              class="btn bg-red-600 text-sm text-white hover:bg-red-700 ">
                          Yes, delete
                        </Link>

                    </div>
                  </ModalDelete>

                </div>
              </td>

            </tr>


            </tbody>
            <tr v-if="users.length === 0">
              <td class="px-6 py-4 border-t" colspan="4">No users found.</td>
            </tr>
          </table>


        </div>
      </div>
    </div>


  </AuthenticatedLayout>

</template>


<script>

import AuthenticatedLayout from "../Layouts/Dashboard/AuthenticatedLayout.vue";
import BreadcrumbLink from "@/Components/BreadcrumbLink.vue";
import FormSearch from "@/Components/FormSearch.vue";
import ModalDelete from "@/Components/ModalDelete.vue";
import Modal from "@/Components/Modal.vue";
import Pagination from "@/Components/Pagination.vue";
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import pickBy from 'lodash/pickBy'
import { Link, Head } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';


export default {

  components: {
    AuthenticatedLayout, BreadcrumbLink, Modal,
    FormSearch, ModalDelete, Link, Pagination, Head,
  },
  props: {
    filters: Object,
    users: Object,
  },

  data() {
    return {
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
        this.$inertia.get('/admin/users', pickBy(this.form), { preserveState: true })
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
