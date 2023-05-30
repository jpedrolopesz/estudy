<template>
  <Head  title="Users" />

  <AdminLayout>
    <div class="bg-white ml-2 shadow-md rounded-md border border-gray-200 relative">
      <header class="px-4 py-2 flex items-center justify-between">
        <h2 class="text-xs font-semibold uppercase text-gray-500 hidden sm:block">
          All Users {{meta.total}}
        </h2>


        <div class="flex items-center">

          <FormSearch v-model="search" @reset="reset" class="w-full ">
            <RadioGroup v-model="trashed">
              <RadioGroupLabel class="text-xs font-semibold uppercase text-gray-500 px-1">Filters</RadioGroupLabel>
              <RadioGroupOption v-slot="{ checked }" value="a">
                  <span class="flex items-center text-xs font-semibold uppercase text-gray-500  border-t border-gray-100 hover:bg-gray-50 py-1 px-1.5 cursor-pointer"
                        :class="checked ? 'bg-gray-100' : 'flex items-center w-full hover:bg-gray-50 py-1 px-1.5 cursor-pointer'">
                    All Users
                  </span>
              </RadioGroupOption>


              <RadioGroupOption v-slot="{ checked }" value="d">
                  <span class="flex items-center text-xs font-semibold uppercase text-gray-500  border-t border-gray-100 hover:bg-gray-50 py-1 px-1.5 cursor-pointer"
                       :class="checked ? 'bg-gray-100' : 'flex items-center w-full hover:bg-gray-50 py-1 px-1.5 cursor-pointer'">
                   Deleted Users
                  </span>
              </RadioGroupOption>
            </RadioGroup>

            <div class="py-2 px-1 border-t border-gray-100 bg-gray-50">
              <button @click="reset" class="py-0.5 px-2 bg-gray-50 text-xs font-semibold uppercase text-gray-500 rounded-md  border border-gray-300 hover:bg-gray-200 hover:text-gray-500">
                Clear
              </button>
            </div>
          </FormSearch>



          <Link :href="route('user.create')" type="button" class="flex ml-4  px-5 py-1.5 bg-gray-50 text-sm font-bold rounded-md text-gray-400 border border-gray-300 hover:bg-gray-200 hover:text-gray-500">
            <PlusIcon class="w-5 h-5 mr-1 "/>
            User
          </Link>

        </div>
      </header>

      <div>
        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="table-auto w-full ">
            <!-- Table header -->
            <thead class="text-xs uppercase font-semibold text-gray-500 bg-gray-50 border-y">
            <tr>
              <th class="px-2 py-3 pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Profiles</div>
              </th>
              <th class="px-2 py-3 pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Email</div>
              </th>
              <th colspan="2" class="px-2 py-3 pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Role</div>
              </th>
              <th class="px-2 py-3 pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Status</div>
              </th>
              <th class="px-2 py-3 pr-5 whitespace-nowrap">
                <span class="font-semibold text-left">Action</span>
              </th>

            </tr>
            </thead>

            <!-- Table body -->
            <tbody>
            <tr v-for="user in users.data"
               :key="user.id"
               class="text-sm border-t border-gray-200 hover:bg-gray-50">

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
                <div class="text-left"></div>
              </td>


              <td class="px-2 inline-flex first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div v-if="!user.deleted_at" class="bg-emerald-100 text-emerald-600 text-left rounded-full text-center px-2.5 ">Active</div>
                <div v-if="user.deleted_at" class=" bg-amber-100 text-amber-600 text-left rounded-full text-center px-2.5">Disabled</div>
              </td>

              <td class="px-2 first:pl-5 last:pr-5  whitespace-nowrap w-px">
                <div class="space-x-1 inline-flex">

                  <Link :href="route('user.edit', user.id)"  class="text-gray-400 hover:text-gray-500 px-2 py-1.5 rounded-md hover:bg-gray-100">
                   <PaintBrushIcon class="w-5 h-5"/>
                  </Link>

                  <ModalDelete>
                    <div class="flex ml-2 justify-between">
                      <Link :href="route('user.destroy', user.id)" as="button" type="button" method="DELETE"
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

          <div class="grid px-4 py-4 text-xs font-semibold uppercase text-gray-500 border-t rounded-b-md  bg-gray-50 sm:grid-cols-9">
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


  </AdminLayout>

</template>


<script setup>
import { useMounted } from "@/Composables/useMounted";
import { Link, Head } from '@inertiajs/inertia-vue3';
import { PlusIcon, PaintBrushIcon } from '@heroicons/vue/24/outline';
import AdminLayout from "../Layouts/AdminLayout.vue";
import ModalDelete from "@/Components/ModalDelete.vue";
import Pagination from "@/Components/Pagination.vue";
import FormSearch from "@/Components/FormSearch.vue";
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {RadioGroup, RadioGroupLabel, RadioGroupOption} from "@headlessui/vue";

const props = defineProps(
  {
    users:Object,
  });

let search = ref('');
watch(search, (value) => {Inertia.get("/admin/user", {
    search: value }, {preserveState: true,
  }
)});

let trashed = ref('');
watch(trashed, (value) => {Inertia.get("/admin/user", {
  trashed: value }, {preserveState: true,
  }
)});

function reset() {
  search.value = ''
  trashed.value = ''
}



const { isMounted } = useMounted();
const { meta } = props.users;







</script>
