<template>
  <Head title="Courses" />

  <AdminLayout>
      <div class="bg-white ml-2 shadow-md rounded-md border border-gray-200 relative">
        <header class="px-4 py-2 flex items-center justify-between">
          <h2 class="text-xs font-semibold uppercase text-gray-500 hidden sm:block">
            All Courses {{meta.total}}
           </h2>

          <div class="flex items-center">

            <FormSearch class="w-full " v-model="search" @reset="reset">

              <RadioGroup v-model="trashed" class="py-2">
                <RadioGroupLabel class="text-xs font-semibold uppercase text-gray-500  px-6">Filters</RadioGroupLabel>
                  <RadioGroupOption v-slot="{ checked }" value="a">
                  <span class="flex items-center w-full border-t border-gray-100 hover:bg-gray-50 py-1 px-1.5 cursor-pointer"
                        :class="checked ? 'bg-gray-100' : 'flex items-center w-full hover:bg-gray-50 py-1 px-1.5 cursor-pointer'">
                    <svg class="shrink-0 mr-2 fill-current text-gray-400 opacity-0"
                         :class="checked ? 'opacity-100' : ''"
                         width="11" height="7" viewBox="0 0 11 7">
                    <path d="M5.4 6.8L0 1.4 1.4 0l4 4 4-4 1.4 1.4z" />
                   </svg>
                    All Courses
                  </span>
                  </RadioGroupOption>


                <RadioGroupOption v-slot="{ checked }" value="d">
                 <span class="flex items-center w-full border-t border-gray-100 hover:bg-gray-50 py-1 px-1.5 cursor-pointer"
                       :class="checked ? 'bg-gray-100' : 'flex items-center w-full hover:bg-gray-50 py-1 px-1.5 cursor-pointer'">
                    <svg class="shrink-0 mr-2 fill-current text-gray-400 opacity-0"
                         :class="checked ? 'opacity-100' : ''"
                         width="11" height="7" viewBox="0 0 11 7">
                    <path d="M5.4 6.8L0 1.4 1.4 0l4 4 4-4 1.4 1.4z" />
                   </svg>
                   Deleted Courses
                  </span>
                </RadioGroupOption>
              </RadioGroup>

              <div class="py-2 px-3 border-t border-gray-100 bg-gray-50">
                <button @click="reset" class="py-0.5 px-2 bg-gray-50 text-sm font-bold rounded-md text-gray-400 border border-gray-300 hover:bg-gray-200 hover:text-gray-500">
                  Clear
                </button>
              </div>
            </FormSearch>

            <CreateCourseForm  :courses="courses">
              <template #button>

                <button type="button" class="flex ml-4 px-5 py-1.5 bg-gray-50 text-sm font-bold rounded-md text-gray-400 border border-gray-300 hover:bg-gray-200 hover:text-gray-500">
                  <PlusIcon class="w-5 h-5 mr-1 "/>
                  Course
                </button>
              </template>
            </CreateCourseForm>


          </div>
        </header>


        <div>

          <!-- Table -->
          <div >
            <table class="table-auto w-full ">
              <!-- Table header -->
              <thead class="text-xs uppercase font-semibold text-gray-500 bg-gray-50 border-y">

              <tr v-if="course[0]">
                <th scope="col" class="px-2 py-3 pr-5 whitespace-nowrap">
                  <div class="font-semibold  text-left">Course</div>
                </th>

                <th scope="col" class="px-2 py-3 pr-5 whitespace-nowrap">
                  <div class="font-semibold  text-left">Status</div>
                </th>
                <th scope="col" class="px-2 py-3 pr-5 whitespace-nowrap">
                  <div class="font-semibold  text-left">Status</div>
                </th>
              </tr>
              </thead>

              <!-- Table body -->
              <tbody>
              <tr v-for="course in courses.data"
                  :key="course.id"
                  class="text-sm border-t border-gray-200">

                <td class="px-2 py-2" >
                  <div class="flex items-center">
                    <div>
                      <img v-bind:src="'/storage/thumbnails/' + course.thumbnail"  class="object-cover rounded-md h-86 md:h-auto md:w-48 " />
                    </div>

                    <div class="flex flex-col p-4 leading-normal">
                      <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 ">{{course.title}}</h5>
                    </div>

                  </div>
                </td>

                <td class="justify-items-center  whitespace-nowrap w-px">
                  <div v-if="!course.deleted_at" class="bg-emerald-100 text-emerald-600  rounded-full text-center  ">Active</div>
                  <div v-if="course.deleted_at" class=" bg-amber-100 text-amber-600 rounded-full text-center">Disabled</div>
                </td>

                <td class="px-2 first:pl-5 last:pr-5  whitespace-nowrap w-px">
                  <div class="space-x-1 inline-flex">

                    <Link :href="route('course.edit', course.id)"  class="text-gray-400 hover:text-gray-500 rounded-full">
                      <span class="sr-only">Edit</span>
                      <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                        <path d="M19.7 8.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM12.6 22H10v-2.6l6-6 2.6 2.6-6 6zm7.4-7.4L17.4 12l1.6-1.6 2.6 2.6-1.6 1.6z"></path>
                      </svg>
                    </Link>

                    <ModalDelete >
                      <div class="flex ml-2 justify-between">
                        <Link :href="route('course.destroy', course.id)" as="button" type="button" method="DELETE"
                              class="btn bg-red-600 text-sm text-white hover:bg-red-700 ">
                          Yes, delete
                        </Link>
                      </div>
                    </ModalDelete>
                  </div>
                </td>
              </tr>
              </tbody>

              <tr v-if="course[0]">
                <td v-if="courses.meta.total === 0" class="px-6 py-4 "  >
                  <span>No course found.</span>
                </td>
              </tr>
              <tr v-if="!course[0]">

                <td class="h-[calc(70vh-84px)] " >
                  <div class="px-4 sm:py-10 lg:mx-28 bg-transparent max-w-7xl sm:px-6 lg:px-8">
                    <div class="grid items-center grid-cols-1 gap-y-8 sm:grid-cols-2 ">
                      <div class="order-2 ml-20">
                        <img class="w-3/4 sm:w-full  " src="/asset/podcasts.svg" alt="" />
                      </div>

                      <div class="order-1">
                        <FirstCreate
                          title="From Knowledge to Transformation: Creating Your First Online Course Step by Step!"
                          subtitle="Unveiling the Doors of Online Education: Unlock Your Potential, Inspire Students, and Create a Memorable Course to Transform Lives!"
                        />
                        <CreateCourseForm :course="courses">
                          <template #button>
                            <button type="button" class="btn mt-10 bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                              Create Now
                            </button>
                          </template>
                        </CreateCourseForm>

                      </div>
                    </div>

                  </div>
                </td>
              </tr>
            </table>






          </div>
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



  </AdminLayout>
</template>


<script setup>
import { ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import { PlusIcon } from '@heroicons/vue/24/outline';
import {Link, Head, usePage} from "@inertiajs/inertia-vue3";
import ModalDelete from "@/Components/ModalDelete.vue";
import Pagination from "@/Components/Pagination.vue";
import FormSearch from "@/Components/FormSearch.vue";
import AdminLayout from "@/Pages/Admin/Layouts/AdminLayout.vue";
import FirstCreate from "@/Pages/Admin/Course/Partials/FirstCreate.vue";
import CreateCourseForm from "@/Pages/Admin/Course/Partials/CreateCourseForm.vue";
import {RadioGroup, RadioGroupLabel, RadioGroupOption} from "@headlessui/vue";


const { auth } = usePage().props;

const props = defineProps(
  {
    courses: Object,
    course: Object,
    filters: Object,
  });

let search = ref('');
watch(search, (value) => {Inertia.get("/admin/course", {
    search: value }, {preserveState: true,
  }
);
});

let trashed = ref('');
watch(trashed, (value) => {Inertia.get("/admin/course", {
  trashed: value }, {preserveState: true,
  }
);
});
function reset() {
  search.value = ''
  trashed.value = ''
}


const { meta } = props.courses;

</script>
