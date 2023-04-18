<template>
  <Head  title="Users" />

  <AuthenticatedLayout>




    <div class="bg-white ml-2 shadow-md rounded-md border border-slate-200 relative">

      <header class="px-4 py-4 flex items-center justify-between">
        <h2 class="text-xs font-semibold uppercase text-slate-500">All Users <span class="text-slate-400 font-medium"> {{meta.total}} </span></h2>

        <div>
          <button type="button" class=" px-1 py-0.5 text-lg font-bold rounded-md text-gray-900 hover:bg-gray-200 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
            </svg>
          </button>
        </div>
      </header>

      <div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-b-md ">
          <table class="table-auto w-full ">
            <!-- Table header -->
            <thead class="text-xs py-2.5 font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b ">
            <tr>
              <th class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Profiles</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Email</div>
              </th>
              <th colspan="2" class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Role</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Status</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <span class="font-semibold text-left">Action</span>
              </th>
              <th class="px-2 first:pl-5 last:pr-5  whitespace-nowrap">
                <span class="sr-only">Menu</span>
              </th>

            </tr>
            </thead>

            <!-- Table body -->
            <tbody>
            <tr
              class="text-sm "
              v-for="(user, idx) in users.data"
              :key="user.id"
              :class="[idx === 0 ? 'border-dark-300' : 'border-gray-200', 'border-t']">

              <td class="px-2 first:pl-5 last:pr-5 py-2.5 whitespace-nowrap ">
                <div class="flex items-center">
                  <div class="w-8 h-8 shrink-0 mr-2 sm:mr-3">
                    <img  class="rounded-full" v-bind:src="'/storage/user/' + user.photo" />
                  </div>
                  <div class="font-medium text-slate-800">{{user.name}}</div>
                </div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5  whitespace-nowrap">
                <div class="text-left">{{user.email}}</div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <div class="text-left">{{ user.owner ? 'Owner' : 'User' }}</div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <div class="sr-only"></div>
              </td>



              <td class="px-2 inline-flex first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div v-if="!user.deleted_at" class="bg-emerald-100 text-emerald-600 text-left rounded-full text-center px-2.5 ">Active</div>
                <div v-if="user.deleted_at" class=" bg-amber-100 text-amber-600 text-left rounded-full text-center px-2.5">Disabled</div>
              </td>

              <td class="px-2 first:pl-5 last:pr-5  whitespace-nowrap w-px">
                <div class="space-x-1 inline-flex">

                  <Link href=""  class="text-slate-400 hover:text-slate-500 rounded-full">
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

          </table>

          <div
            class="grid px-4 py-4 text-xs font-semibold uppercase text-slate-500 bg-slate-50 dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
          <span class="flex items-center col-span-3">
              Showing {{ meta.from }}-{{ meta.to }} of {{ meta.total }}
          </span>
            <span class="col-span-2"></span>
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            <Pagination :links="meta.links" />
          </span>
          </div>


        </div>
      </div>
    </div>


  </AuthenticatedLayout>

</template>


<script setup>
import { useMounted } from "@/Composables/useMounted";
import AuthenticatedLayout from "../Layouts/AdminLayout.vue";
import FormSearch from "@/Components/FormSearch.vue";
import ModalDelete from "@/Components/ModalDelete.vue";
import { Link, Head } from '@inertiajs/inertia-vue3';
import Pagination from "@/Components/Pagination.vue";
import SearchGlobal from "@/Components/Search/SearchGlobal.vue";

const props = defineProps(
  {
    filters: Object,
    users: Object,
  });

const { isMounted } = useMounted();
const { meta } = props.users;







</script>
