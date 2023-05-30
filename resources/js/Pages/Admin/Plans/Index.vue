<template>
  <Head  title="Plans" />

  <AdminLayout>
    <div class="bg-white ml-2 shadow-lg rounded-md border border-slate-200 relative">
      <header class="px-4 py-2 flex items-center justify-between">
        <h2 class="text-xs font-semibold uppercase text-gray-500 hidden sm:block">All Plans <span class="text-gray-400 font-medium">  </span></h2>

        <div class="flex items-center">

          <FormSearch  v-model="search"  @reset="reset" class="w-full">
            <RadioGroup v-model="trashed">
              <RadioGroupLabel class="text-xs font-semibold uppercase text-gray-500 px-1">Filters</RadioGroupLabel>
              <RadioGroupOption v-slot="{ checked }" value="a" >

                  <span class="flex items-center text-xs font-semibold uppercase text-gray-500  border-t border-gray-100 hover:bg-gray-50 py-1 px-1.5 cursor-pointer"
                        :class="checked ? 'bg-gray-100' : 'flex items-center w-full hover:bg-gray-50 py-1 px-1.5 cursor-pointer'">
                    All Plans
                  </span>
              </RadioGroupOption>


              <RadioGroupOption v-slot="{ checked }" value="d">
                  <span class="flex items-center  text-xs font-semibold uppercase text-gray-500  border-t border-gray-100 hover:bg-gray-50 py-1 px-1.5 cursor-pointer"
                       :class="checked ? 'bg-gray-100' : 'flex items-center w-full hover:bg-gray-50 py-1 px-1.5 cursor-pointer'">
                   Deleted Plans
                  </span>
              </RadioGroupOption>
            </RadioGroup>

            <div class="py-2 px-1 border-t border-gray-100 bg-gray-50">
              <button @click="reset" class="py-0.5 px-2 bg-gray-50 text-xs font-semibold uppercase text-gray-500 rounded-md  border border-gray-300 hover:bg-gray-200 hover:text-gray-500">
                Clear
              </button>
            </div>

          </FormSearch>

          <Link :href="route('plan.create')"  class="flex ml-4  px-5 py-1.5 bg-gray-50 text-sm font-bold rounded-md text-gray-400 border border-gray-300 hover:bg-gray-200 hover:text-gray-500">
            <PlusIcon class="w-5 h-5 mr-1 "/>
            Plan
          </Link>
        </div>
      </header>

      <div>
        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="table-auto w-full">
            <!-- Table header -->
            <thead class="text-xs font-semibold  uppercase text-slate-500 bg-slate-50  border-t border-b border-slate-200">
            <tr>
              <th class="px-2 py-3 pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Name</div>
              </th>
              <th class="px-2 py-3 pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Recurrence</div>
              </th>
              <th class="px-2 py-3 pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Price</div>
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
            <tbody v-for="plan in plans.data"
                   :key="plan.id"
                   class="text-sm border-t border-gray-200 hover:bg-gray-50">

             <tr>
               <td class="px-2 first:pl-5 last:pr-5  whitespace-nowrap">
                <div class="text-left">{{plan.name}}</div>
              </td>
               <td class="px-2 first:pl-5 last:pr-5  whitespace-nowrap">
                <div class="text-left">{{plan.slug}}</div>
              </td>
               <td class="px-2 first:pl-5 last:pr-5  whitespace-nowrap">
                <div class="text-left">{{plan.price}}</div>
              </td>




              <td class="px-2 inline-flex first:pl-5 last:pr-5 py-6 whitespace-nowrap">
                <div v-if="!plan.deleted_at" class="bg-emerald-100 text-emerald-600 text-left rounded-full text-center px-2.5 ">Active</div>
                <div v-if="plan.deleted_at" class=" bg-amber-100 text-amber-600 text-left rounded-full text-center px-2.5">Disabled</div>
              </td>

              <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                <Link v-if="plan.deleted_at" :href="route('plan.restore', plan.id)" as="button" type="button" method="PUT" class="text-gray-400 hover:text-gray-500 px-2 py-1.5  rounded-md hover:bg-gray-100">
                  <ArrowPathIcon class="w-5 h-5"/>

                </Link>

                <div v-if="!plan.deleted_at" class="space-x-1 inline-flex">
                  <Link :href="route('plan.edit', plan.id)" class="text-gray-400 hover:text-gray-500 px-2 py-1.5  rounded-md hover:bg-gray-100">
                    <PaintBrushIcon class="w-5 h-5"/>

                  </Link>
                  <ModalDelete  >
                    <div class="flex ml-2 justify-between">
                      <Link :href="route('plan.destroy', plan.id)" as="button" type="button" method="DELETE"
                            class="btn bg-red-600 text-sm text-white hover:bg-red-700 ">
                        Yes, delete
                      </Link>
                    </div>
                  </ModalDelete>

                </div>
              </td>

             </tr>
            </tbody>
            <tr v-if="plans.meta.total === 0">
              <td class="px-6 py-4 border-t" colspan="4">No plans found.</td>
            </tr>
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

import {ref, watch} from 'vue';
import {Inertia} from "@inertiajs/inertia";
import { Link, Head } from '@inertiajs/inertia-vue3';
import { PlusIcon, PaintBrushIcon, ArrowPathIcon } from '@heroicons/vue/24/outline';
import AdminLayout from "../Layouts/AdminLayout.vue";
import FormSearch from "@/Components/FormSearch.vue";
import Pagination from "@/Components/Pagination.vue";
import ModalDelete from "@/Components/ModalDelete.vue";
import {RadioGroup, RadioGroupLabel, RadioGroupOption} from "@headlessui/vue";


const props = defineProps({
  plans:Object,
})

let search = ref('');
watch(search, (value) => {Inertia.get("/admin/plan", {
    search: value }, {preserveState: true,
  }
);
});

let trashed = ref('');
watch(trashed, (value) => {Inertia.get("/admin/plan", {
    trashed: value }, {preserveState: true,
  }
)});

function reset() {
  search.value = ''
  trashed.value = ''
}



const { meta } = props.plans;


</script>
