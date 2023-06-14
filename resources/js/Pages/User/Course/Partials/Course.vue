<template>
    <div  :class="msgSidebarOpen ? '' : 'flex transform transition-transform duration-9000 ease-in-out'">

      <ListCourse
        :courses="courses"
        :msgSidebarOpen="msgSidebarOpen"
        @course-selected="handleCourseSelected"
        @close-msgsidebar="msgSidebarOpen = false"/>

      <div class="w-full bg-white shadow-md rounded-md flex flex-col overflow-y-auto">

      <CourseHeader
        :msgSidebarOpen="msgSidebarOpen"
        @toggle-msgsidebar="msgSidebarOpen = !msgSidebarOpen"
      />

      <main :class="msgSidebarOpen ? 'hidden' : ''">

        <div class="p-10 w-full  ">

          <!-- Page content -->
          <div class=" max-w-5xl mx-auto flex flex-col lg:flex-row lg:space-x-4 xl:space-x-10  ">
            <div>
              <div class="mb-4">
                <h1 class="text-2xl md:text-3xl text-gray-800 font-semibold mb-2">{{selectedContent.title}}</h1>
              </div>
              <div class="flex items-center mb-2 sm:mr-4">
                <a class="block mr-2 shrink-0">
                  <img class="rounded-full" :src="'/storage/user/' + selectedContent.photo" width="32" height="32"  />
                </a>
                <div class="text-sm whitespace-nowrap">
                  created by
                  <span class="font-semibold text-gray-800">{{ selectedContent.first_name }}</span>
                </div>
              </div>
              <div class="mb-6">
                <img class="w-full shadow-sm rounded-sm" :src="'/storage/' + selectedContent.thumbnail " width="640" height="360" />
              </div>
              <div class="mb-4">
                <p class="mb-6">{{selectedContent.description}}</p>
              </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-4">

              <!-- 1st block -->
              <div class="bg-white p-5 shadow-sm rounded-md border border-gray-200lg:w-72 xl:w-80">
                <div class="space-y-2">
                  <Link :href="route('showCourse', selectedContent)" class="btn w-full bg-gray-500 hover:bg-gray-600 text-white">
                    <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 16 16">
                      <path d="m2.457 8.516.969-.99 2.516 2.481 5.324-5.304.985.989-6.309 6.284z" />
                    </svg>
                    <span class="ml-1">Acessar</span>
                  </Link>

                </div>
              </div>

              <div class="bg-white p-5 shadow-sm rounded-md border border-gray-200 lg:w-72 xl:w-80 overflow-y-auto overflow-x-hidden h-[calc(64vh-24px)]">
                <div class="flex justify-between space-x-1 mb-5">
                  <div class="text-sm text-gray-800 font-semibold">Content</div>
                </div>
                <ul class="space-y-2">
                  <li class="cursor-pointer border hover:border-gray-500 flex justify-between items-center px-3 py-2 bg-white rounded  mb-1"
                      v-for="module in selectedContent.modules">

                    <div class="flex items-center justify-between">
                          <div class="flex items-center grow">
                            <div class="flex relative justify-center w-6 h-6 items-center mr-3  rounded-full bg-gray-100">
                              <PlayIcon class="w-5 h-5 ml-0.5 text-gray-500"/>

                            </div>
                            <p class="text-sm">
                              {{module.title}}
                            </p>

                          </div>

                    </div>
                  </li>
                </ul>
              </div>


            </div>

          </div>

        </div>
      </main>


      </div>

    </div>



</template>

<script>
import { Link} from '@inertiajs/inertia-vue3';
import ListCourse from "./ListCourse.vue";
import CourseHeader from "./CourseHeader.vue";
import { PlayIcon } from '@heroicons/vue/24/outline';

import {ref} from "vue";


export default {
  components: {CourseHeader, ListCourse,PlayIcon, Link},
  props: {
    courses:Object,
  },
  emits: ['selectedCourse', 'close-msgsidebar', 'toggle-msgsidebar'],
  data() {
    return {
      selectedContent: '',
    }
  },
  setup() {
    const sidebarOpen = ref(false)
    const msgSidebarOpen = ref(true)

    return {
      sidebarOpen,
      msgSidebarOpen,
    }
  },
  methods: {
    handleCourseSelected(course) {
      this.selectedContent = course;
    },
  }
}
</script>
