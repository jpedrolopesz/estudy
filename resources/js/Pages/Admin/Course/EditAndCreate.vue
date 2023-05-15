<template>
  <AdminLayout>
    <div>
      <div class="md:grid md:grid-cols-3 md:gap-6 ml-6">
        <div class="md:col-span-1">
          <div class="w-full ">
            <div class="sm:flex sm:items-center mx-4 sm:justify-between">

              <EditCourseForm :course="course"/>

            </div>
          </div>
        </div>
        <div class="mt-1 md:col-span-2 md:mt-0">
          <div class="shadow-lg bg-white overflow-hidden rounded-md">
            <div v-if="course.modules[0]" class="mt-2">
              <TabGroup>
                <TabList class="p-2 mx-2 text-sm font-medium flex ">

                  <Tab v-slot="{ selected }" class="mx-2 mr-4">
                    <button :class="['flex text-slate-800',
                       selected ? '' : 'text-slate-200 hover:text-slate-600']">
                      <svg class="w-4 h-4 shrink-0 fill-current text-slate-400 mr-2" viewBox=" 0 0 16 16">
                        <path d="M15 4c.6 0 1 .4 1 1v10c0 .6-.4 1-1 1H3c-1.7 0-3-1.3-3-3V3c0-1.7 1.3-3 3-3h7c.6 0 1 .4 1 1v3h4zM2 3v1h7V2H3c-.6 0-1 .4-1 1zm12 11V6H2v7c0 .6.4 1 1 1h11zm-3-5h2v2h-2V9z" />
                      </svg>
                      <span>Modules</span>
                    </button>
                  </Tab>

                  <Tab v-slot="{ selected }" class="mx-2 mr-4">
                    <button :class="['flex text-slate-800',
                       selected ? '' : 'text-slate-200 hover:text-slate-600']">
                      <svg class="w-4 h-4 shrink-0 fill-current text-slate-400 mr-2" viewBox=" 0 0 16 16">
                        <path d="M15 4c.6 0 1 .4 1 1v10c0 .6-.4 1-1 1H3c-1.7 0-3-1.3-3-3V3c0-1.7 1.3-3 3-3h7c.6 0 1 .4 1 1v3h4zM2 3v1h7V2H3c-.6 0-1 .4-1 1zm12 11V6H2v7c0 .6.4 1 1 1h11zm-3-5h2v2h-2V9z" />
                      </svg>
                      <span>Billing</span>
                    </button>

                  </Tab>


                </TabList>
                <TabPanels>
                  <!-- TAB 1 -->
                  <TabPanel>
                    <div class="flex items-center mx-6 mb-4 justify-between">
                      <h2 class=" font-semibold text-slate-800">Add Module</h2>
                      <CreateModuleForm :course="course">
                        <template #button>
                          <button type="button" class="px-1.5 py-1 bg-gray-50 text-lg font-bold rounded-md text-gray-400 border border-slate-300 hover:bg-gray-200 hover:text-gray-500">
                            <svg  class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                              <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                            </svg>
                          </button>
                        </template>
                      </CreateModuleForm>
                    </div>

                    <div class="grid gap-2 overflow-y-auto  h-[calc(80vh-84px)] ">
                      <Draggable
                          tag="ul"
                          itemKey="id"
                          group="modules"
                          :list="course.modules"
                          @change="onModuleDrag"
                        >
                          <template #item="{element: module}">
                            <div class="group cursor-grab hover:border-slate-500 rounded-md mx-4 border mb-4 border-slate-300 p-0.5">

                              <Disclosure v-slot="{ open, close }">
                                <div class="flex justify-between items-start">
                                  <div class="group flex items-center w-full rounded-lg py-2 text-left text-base font-bold text-gray-900 focus:outline-none focus-visible:ring focus-visible:ring-purple-500 focus-visible:ring-opacity-75">
                                    <button class="cursor-grab ">
                                      <svg  width="40" height="30" viewBox="0 96 960 960">
                                        <path d="M357.27 878.717q-24.616 0-42.301-17.934-17.686-17.935-17.686-42.672 0-24.071 17.91-41.77t42.446-17.699q24.244 0 41.981 17.948 17.738 17.947 17.738 42.018 0 24.738-17.913 42.423-17.913 17.686-42.175 17.686Zm245.032 0q-24.365 0-42.051-17.934-17.686-17.935-17.686-42.672 0-24.071 17.925-41.77 17.924-17.699 42.279-17.699 24.063 0 41.967 17.948 17.904 17.947 17.904 42.018 0 24.738-17.987 42.423-17.986 17.686-42.351 17.686ZM357.27 635.871q-24.616 0-42.301-17.456-17.686-17.455-17.686-42.748 0-24.355 17.91-42.113t42.446-17.758q24.244 0 41.981 17.84 17.738 17.841 17.738 42.293 0 25.391-17.913 42.666-17.913 17.276-42.175 17.276Zm245.032 0q-24.365 0-42.051-17.456-17.686-17.455-17.686-42.748 0-24.355 17.925-42.113 17.924-17.758 42.279-17.758 24.063 0 41.967 17.84 17.904 17.841 17.904 42.293 0 25.391-17.987 42.666-17.986 17.276-42.351 17.276ZM357.27 393.358q-24.616 0-42.301-17.935-17.686-17.934-17.686-42.671 0-24.071 17.91-41.77t42.446-17.699q24.244 0 41.981 17.948 17.738 17.947 17.738 42.018 0 24.738-17.913 42.423-17.913 17.686-42.175 17.686Zm245.032 0q-24.365 0-42.051-17.935-17.686-17.934-17.686-42.671 0-24.071 17.925-41.77 17.924-17.699 42.279-17.699 24.063 0 41.967 17.948 17.904 17.947 17.904 42.018 0 24.738-17.987 42.423-17.986 17.686-42.351 17.686Z"/>
                                      </svg>
                                    </button>
                                    <DisclosureButton>
                                      <svg height="14" viewBox="0 96 960 960" width="14"
                                           class="ml-2"
                                           :class="open ? 'rotate-90 transform' : ''">
                                        <path d="M321 994.088 231.912 905l329-329-329-329L321 157.912 739.088 576 321 994.088Z"/></svg>

                                    </DisclosureButton>

                                    <span class="font-medium text-gray-800 ml-2">{{module.sort_order}}</span>

                                    <div class="grow mx-4 ">

                                      <input v-model="module.title"
                                             @click="showInput = true"
                                             class="font-medium text-gray-800 w-full ml-2 bg-transparent"
                                      />
                                    </div>
                                    <div class="justify-end space-x-3 " v-if="showInput">
                                      <button @submit.prevent="submitUpdate" class="text-slate-400 hover:text-indigo-500">
                                        <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                          <path d="M19.7 8.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM12.6 22H10v-2.6l6-6 2.6 2.6-6 6zm7.4-7.4L17.4 12l1.6-1.6 2.6 2.6-1.6 1.6z"></path>
                                        </svg>
                                      </button>
                                    </div>
                                  </div>
                                </div>
                                <DisclosurePanel class="py-2 m-4 text-sm text-gray-500">
                                  <Link :href="route('lesson.create',[course.id, module.id])">
                                    <button type="button" class="bg-gray-50 font-medium text-center w-full rounded-sm mb-2 p-1.5 text-gray-600 border border-slate-300 hover:bg-gray-200 hover:text-gray-500">
                                      Add lesson
                                    </button>
                                  </Link>

                                  <Draggable
                                    :list="module.lessons"
                                    tag="ul"
                                    group="lessons"
                                    itemKey="id"
                                    @change="onLessonDrag"
                                  >
                                    <template #item="{ element: lesson }">
                                      <li class="bg-white rounded-sm border mb-2 border-slate-200 p-1.5 hover:bg-slate-50">
                                        <div class="w-full md:flex items-center justify space-y-1.5 md:space-y-0">
                                          <div class="flex-1">


                                            <div class="flex  gap-3 sm:gap-2 flex-col justify-start items-start sm:flex-row sm:items-center sm:flex-1 sm:justify-start text-black cursor-pointer text-md">
                                              <button class="cursor-grab handle mr-4 group-hover:opacity-100">
                                                <svg class="w-6 h-6 fill-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
                                                </svg>
                                              </button>

                                              <div class="grow mt-0.5 mb-3 sm:mb-0 space-y-3">

                                                <span>{{lesson.sort_order}}:
                                                  <span class="font-medium text-gray-600 ml-2">{{ lesson.title }}</span>
                                               </span>
                                              </div>
                                              <div class="flex items-center justify-end space-x-3">

                                                <Link :href="route('lesson.edit',[course.id, module.id, lesson.id])" class="text-slate-400 hover:text-indigo-500">
                                                  <svg class="w-4 h-4 shrink-0 fill-current mr-1.5" viewBox="0 0 16 16">
                                                    <path d="M11 0c1.3 0 2.6.5 3.5 1.5 1 .9 1.5 2.2 1.5 3.5 0 1.3-.5 2.6-1.4 3.5l-1.2 1.2c-.2.2-.5.3-.7.3-.2 0-.5-.1-.7-.3-.4-.4-.4-1 0-1.4l1.1-1.2c.6-.5.9-1.3.9-2.1s-.3-1.6-.9-2.2C12 1.7 10 1.7 8.9 2.8L7.7 4c-.4.4-1 .4-1.4 0-.4-.4-.4-1 0-1.4l1.2-1.1C8.4.5 9.7 0 11 0zM8.3 12c.4-.4 1-.5 1.4-.1.4.4.4 1 0 1.4l-1.2 1.2C7.6 15.5 6.3 16 5 16c-1.3 0-2.6-.5-3.5-1.5C.5 13.6 0 12.3 0 11c0-1.3.5-2.6 1.5-3.5l1.1-1.2c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4L2.9 8.9c-.6.5-.9 1.3-.9 2.1s.3 1.6.9 2.2c1.1 1.1 3.1 1.1 4.2 0L8.3 12zm1.1-6.8c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4l-4.2 4.2c-.2.2-.5.3-.7.3-.2 0-.5-.1-.7-.3-.4-.4-.4-1 0-1.4l4.2-4.2z" />
                                                  </svg>
                                                </Link>

                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </li>
                                    </template>
                                  </Draggable>


                                </DisclosurePanel>
                              </Disclosure>
                            </div>
                          </template>
                        </Draggable>
                    </div>

                    <div class="flex  justify-between bg-gray-50 px-4 py-3 text-right sm:px-6">
                      <div>
                        <Link :href="route('courses.index')" type="button" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                          </svg>
                          Previous
                        </Link>
                      </div>
                      <div>
                      </div>
                    </div>
                  </TabPanel>
                  <!-- TAB 2 -->
                  <TabPanel>
                    <div class="flex items-center mx-6 mb-4 justify-between">
                      <h2 class=" font-semibold text-slate-800">Billing</h2>
                    </div>
                  </TabPanel>
                </TabPanels>
              </TabGroup>
            </div>

            <div class="h-[calc(80vh-84px)]" v-else >
              <div class="m-20">
                <FirstCreate
                  title="Create Your Own Module for the Course."
                  subtitle="Customize Your Learning Experience and Share Your Knowledge."
                />
                <CreateModuleForm :course="course">
                  <template #button>
                    <button type="button" class="btn mt-3 bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                      Create Module
                    </button>
                  </template>
                </CreateModuleForm>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script>
import {ref, watch} from "vue";
import {Link} from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';
import Draggable from "vuedraggable";
import { Disclosure, DisclosureButton, DisclosurePanel,
  Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";
import AdminLayout from "../Layouts/AdminLayout.vue";
import EditCourseForm from "@/Pages/Admin/Course/Partials/EditCourseForm.vue";
import CreateModuleForm from "@/Pages/Admin/Course/Partials/CreateModuleForm.vue";
import FirstCreate from "@/Pages/Admin/Course/Partials/FirstCreate.vue";
export default {
  components: {
    FirstCreate,
    CreateModuleForm,
    EditCourseForm,
    TabGroup,
    TabPanel,
    TabPanels,
    Tab,
    TabList, Link,
     AdminLayout,
    Draggable, Disclosure, DisclosureButton, DisclosurePanel
  },
  props: {
    course:Object
  },
  data() {
    return {
      showInput: false,
    }
  },
  setup(props) {

    const modulesData = ref(props.course.modules);
    watch(() => props.course.modules, (value) => {
      modulesData.value = value;
    });
    function onModuleDrag(e) {
      if (e.moved) {
        const data = modulesData.value.map((module, index) => {
          return { sort_order: index + 1, id: module.id };
        });
        Inertia.put(
          route("module.draggable", [route().params.course]),
          {
            payload: data,
            type: "module"
          },
          {
            preserveScroll: true,
            onSuccess: () => (modulesData.value = props.course.modules),
            onError: (error) => console.error(error) // Log any errors to the console
          }
        );
      }
    }

    const lessonsData = ref([]);
    watch(() => props.course.modules, (modules) => {
      lessonsData.value = modules.flatMap((module) => module.lessons);
    }, { deep: true });

    function onLessonDrag(e) {
      if (e.moved) {
        const data = lessonsData.value.map((lesson, index) => {
          return { sort_order: index + 1, id: lesson.id };
        });
        Inertia.put(
          route("module.draggable", [route().params.course]),
          {
            payload: data,
            type: "lesson"
          },
          {
            preserveScroll: true,
            onSuccess: (value) => (lessonsData.value = value),
            onError: (error) => console.error(error)
          }
        );
      }
    }


    return {onModuleDrag, onLessonDrag,}
  },
}
</script>


