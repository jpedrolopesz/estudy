<template>
  <AdminLayout>







    <div class="w-full ">
      <div class="sm:flex sm:items-center mx-8 sm:justify-between">
        <div class="min-w-0 flex-1">

          <div class="flex items-center justify-start mb-2">
            <input type="text" v-model="course.title" class="bg-gray-50 font-medium rounded-lg border border-slate-200 text-2xl lg:text-3xl opacity-75 truncate"/>
            <button @click="updateCourse" class="shrink-0 text-indigo-500 hover:text-indigo-600 ml-2">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
              </svg>
            </button>
          </div>

        </div>
      </div>
    </div>


    <div class="grid grid-cols-12 gap-x-4 gap-y-8 mt-8">
      <!-- Tasks column -->
      <div class="col-span-full sm:col-span-6 xl:col-span-3">
        <!-- Column header -->
        <header>
          <div class="flex items-center justify-between mb-2">
            <h2 class="grow font-semibold text-slate-800 truncate">Add Module</h2>
            <button class="shrink-0 text-indigo-500 hover:text-indigo-600 ml-2">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
              </svg>
            </button>
          </div>

          <!-- Cards -->
          <div class="grid gap-2">

            <draggable
              v-model="course.modules"
              tag="ul"
              itemKey="id"
            >
              <template #item="{element: modules, index}">
                <div class="rounded-lg border border-dashed border-transparent">

                  <Disclosure :defaultOpen="index===0" v-slot="{ open, close }">
                    <div
                      class="group flex items-center w-full rounded-lg py-2 text-left text-base font-bold text-gray-900 focus:outline-none focus-visible:ring focus-visible:ring-purple-500 focus-visible:ring-opacity-75">
                      <button class="cursor-grab handle mr-4 opacity-0 group-hover:opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
                        </svg>

                      </button>
                      <DisclosureButton>
                        <svg class="h-4 w-4 text-gray-900 mr-2"
                             :class="open ? 'rotate-90 transform' : ''"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                      </DisclosureButton>

                      <span>{{modules.id}} - {{ modules.title }}</span>

                    </div>

                    <DisclosurePanel class="py-2 text-sm text-gray-500">
                        <draggable
                          :list="course.modules[0].lessons"

                          tag="ul"
                          group="lessons"
                          itemKey="id"
                        >


                          <template #item="{ element: lesson, index }">

                            <li
                              class="flex  py-2x items-center group px-2 hover:bg-gray-100 focus-within:!bg-blue-50 border-gray-200">
                              <div class="w-full md:flex items-center justify space-y-1.5 md:space-y-0">
                                <div class="flex-1">
                                  <div class="flex flex-1 gap-3 sm:gap-2 flex-col justify-start items-start sm:flex-row sm:items-center sm:flex-1 sm:justify-between text-black cursor-pointer text-md">
                              <span>
                                <span class="font-semibold text-gray-500 uppercase">{{ lesson.id }}:</span>
                                {{ lesson.title }}
                              </span>
                                  </div>
                                </div>

                              </div>


                            </li>


                          </template>

                        </draggable>
                    </DisclosurePanel>

                  </Disclosure>





                </div>
              </template>



            </draggable>

          </div>

        </header>

      </div>

      <div class="col-span-full sm:col-span-6 xl:col-span-3">
        <!-- Column header -->
        <header>
          <div class="flex items-center justify-between mb-2">
            <h2 class="grow font-semibold text-slate-800 truncate">Add Lesson</h2>
            <button class="shrink-0 text-indigo-500 hover:text-indigo-600 ml-2">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
              </svg>
            </button>
          </div>

          <!-- Cards -->
          <div class="grid gap-2">
              <ul>
                <li class="bg-white shadow-lg rounded-sm border border-slate-200 mb-2 p-2"
                  v-for="lesson in course.modules[0].lessons" :key="lesson.id" >
                  {{lesson.title}}
                </li>
              </ul>
          </div>

        </header>


      </div>




    </div>

  </AdminLayout>
</template>


<script>
import AdminLayout from "../Layouts/AdminLayout.vue";
import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel
} from "@headlessui/vue";

import draggable from "vuedraggable";
import {ref} from "vue";

export default {
  components: {AdminLayout, draggable, Disclosure, DisclosureButton, DisclosurePanel},
  props: {
    course:Object
  },
  setup() {
    const showModule = ref('0')
    const modulesState = {};

    const toggleModule = (moduleId) => {

      if (modulesState[moduleId] && modulesState[moduleId].open) {
        modulesState[moduleId].open = false;
      } else {
        Object.keys(modulesState).forEach((id) => {
          modulesState[id].open = false;
        });
        modulesState[moduleId] = { open: true };
      }
    };



    return {showModule, toggleModule}
  },
  methods: {
    updateCourse() {
      this.$inertia.put(`/courses/${this.course.id}`, {title: this.course.title})

    },
    updateModule(module) {
      this.$inertia.put(`/courses/${this.course.id}`, { title: module.title });
    }

  }

}
</script>
