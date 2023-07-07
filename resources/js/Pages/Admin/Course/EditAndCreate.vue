<template>
  <Head title="Edit and Create" />

  <AdminLayout>
    <div>
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <div class="w-full ">
            <div class="sm:flex sm:items-center mx-8 sm:justify-between">
              <div class="min-w-0 flex-1">
                <EditCourseForm :course="course"/>
              </div>

            </div>
          </div>
        </div>
        <div class="mt-1 md:col-span-2 md:mt-0">
          <div class="shadow-lg bg-white overflow-hidden rounded-md">
            <div v-if="course.modules[0]" class="mt-2">

              <TabGroup>
                <TabList class="py-1 border-b rounded-t-md items-center">
                  <div class="text-sm font-medium flex flex-nowrap mt-1 sm:-mx-6 lg:-mx-8 overflow-x-auto">
                  <Tab  v-slot="{ selected }" class="pb-3 sm:ml-4 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8">
                    <div :class="{ 'text-gray-900': selected }" class="text-gray-500 hover:text-gray-800 whitespace-nowrap flex items-center">
                      <FolderIcon class="w-5 h-4.5 mr-1"/>
                      <span>Modules pica</span>
                    </div>
                  </Tab>
                  </div>

                </TabList>
                <TabPanels>
                  <!-- TAB 1 -->
                  <TabPanel>

                    <div class="flex mx-5 my-2  justify-between">


                        <div class="items-center mt-2 text-center">

                          <span class="text-lg font-medium text-gray-800 ">Content</span>

                        </div>


                      <div class="flex">


                          <Link :href="route('course.show', course.id)"
                                class="px-1.5 py-1.5 mr-2 bg-transparent text-sm font-bold rounded-md text-gray-500 border border-gray-300 hover:bg-gray-200 hover:text-gray-500">
                            <EyeIcon class="w-5 h-5"/>
                          </Link>


                        <CreateModuleForm :course="course">
                          <template #button>
                            <button type="button" class="flex px-1.5 py-1.5 bg-transparent text-sm font-bold rounded-md text-gray-500 border border-gray-300 hover:bg-gray-200 hover:text-gray-500">
                              <PlusIcon class="w-5 h-5 "/>
                              Module
                            </button>
                          </template>
                        </CreateModuleForm>
                      </div>

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
                            <div class="group cursor-grab hover:border-gray-500 rounded-md mx-4 border mb-4 border-gray-300 p-0.5">

                              <Disclosure v-slot="{ open, close }">
                                <div class="flex justify-between items-start">
                                  <div class="group flex items-center w-full rounded-lg py-2 text-left text-base font-bold text-gray-900 focus:outline-none focus-visible:ring focus-visible:ring-purple-500 focus-visible:ring-opacity-75">
                                    <button class="cursor-grab ">

                                      <ChevronUpDownIcon class="w-6 h-6 hover:fill-gray-800 "/>

                                    </button>
                                    <DisclosureButton>
                                      <ChevronRightIcon class="ml-2 w-4 h-4 hover:fill-gray-900" :class="open ? 'rotate-90 transform' : ''" />
                                    </DisclosureButton>

                                    <div class="grow flex justify-between items-center mx-4">
                                      <span class="font-medium text-gray-800 w-full ml-2 bg-transparent">{{module.title}}</span>
                                      <div class="flex" v-if="open">
                                        <ModalDelete  >
                                          <div class="flex ml-2 justify-between ">
                                            <Link :href="route('course.module.destroy', [course.id, module.id])" as="button" type="button" method="DELETE"
                                                  class="btn bg-red-600 text-sm text-white hover:bg-red-700 ">
                                              Yes, delete
                                            </Link>
                                          </div>
                                        </ModalDelete>
                                        <EditModuleForm :course="course" :module="module" >
                                          <template #button>
                                            <button  type="button" class="text-gray-400 hover:text-gray-500 px-2 py-0.5  rounded-md hover:bg-gray-200">
                                              <EllipsisHorizontalIcon />
                                            </button>
                                          </template>
                                        </EditModuleForm>
                                      </div>

                                    </div>
                                  </div>
                                </div>
                                <DisclosurePanel class="py-2 m-4 text-sm text-gray-500">
                                  <Link :href="route('course.module.lesson.create', [this.course, module.id])">
                                    <button type="button" class="w-full mb-2 px-1.5 py-1.5 bg-gray-50 text-sm font-bold rounded-md text-gray-400 border border-gray-300 hover:bg-gray-200 hover:text-gray-500">
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
                                      <li class="bg-white hover:border-gray-500 rounded-md border mb-4 border-gray-300 p-0.5">
                                     rola
                                      </li>
                                    </template>
                                  </Draggable>


                                </DisclosurePanel>
                              </Disclosure>
                            </div>
                          </template>
                        </Draggable>
                    </div>

                    <div class="flex  justify-between bg-gray-50 px-4 py-1 text-right sm:px-6">
                      <div>
                        <Link :href="route('course.index')" type="button" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
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
                </TabPanels>
              </TabGroup>
            </div>


            <div v-else class="h-[calc(80vh-84px)] " >
              <div class="px-4 sm:py-10  bg-transparent max-w-7xl sm:px-6 lg:px-8">
                <div class="items-center">

                  <div class="order-1">
                    <FirstCreate
                      title="From Knowledge to Transformation: Creating Your First Online Course Step by Step!"
                      subtitle="Unveiling the Doors of Online Education: Unlock Your Potential, Inspire Students, and Create a Memorable Course to Transform Lives!"
                    />
                    <CreateModuleForm :course="course">
                      <template #button>
                        <button type="button" class="btn mt-10 bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                          Create Now
                        </button>
                      </template>
                    </CreateModuleForm>

                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import {ref, watch} from "vue";
import {Link, Head} from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';
import Draggable from "vuedraggable";
import { EllipsisHorizontalIcon,EyeIcon,PaintBrushIcon,PlusIcon,ChevronRightIcon,ChevronUpDownIcon,BanknotesIcon,FolderIcon  } from '@heroicons/vue/24/outline';
import AdminLayout from "../Layouts/AdminLayout.vue";
import EditCourseForm from "@/Pages/Admin/Course/Partials/EditCourseForm.vue";
import CreateModuleForm from "@/Pages/Admin/Course/Partials/CreateModuleForm.vue";
import EditModuleForm from "@/Pages/Admin/Course/Partials/EditModuleForm.vue";
import FirstCreate from "@/Pages/Admin/Course/Partials/FirstCreate.vue";
import ModalDelete from "@/Components/ModalDelete.vue";
import {Disclosure, DisclosureButton, DisclosurePanel, Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";

const props = defineProps({
  course: Object
});

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
</script>


