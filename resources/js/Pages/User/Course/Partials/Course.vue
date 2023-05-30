<template>
    <div  :class="msgSidebarOpen ? '' : 'flex transform transition-transform duration-9000 ease-in-out'">

      <ListCourse
        :courses="courses"
        :msgSidebarOpen="msgSidebarOpen"
        @course-selected="handleCourseSelected"
        @close-msgsidebar="msgSidebarOpen = false"/>

      <div class="w-full  bg-white shadow-md rounded-md border border-gray-200 flex flex-col overflow-y-auto">

      <CourseHeader
        :msgSidebarOpen="msgSidebarOpen"
        @toggle-msgsidebar="msgSidebarOpen = !msgSidebarOpen"
      />

      <main :class="msgSidebarOpen ? 'hidden' : ''">

        <div class="p-10 w-full  ">

          <!-- Page content -->
          <div class=" max-w-5xl mx-auto flex flex-col lg:flex-row lg:space-x-4 xl:space-x-10  ">
            <div>
              <div class="mb-6">
                <img class="w-full rounded-sm" :src="'/storage/thumbnails' + selectedComment.thumbnail " width="640" height="360" />
              </div>
              <div class="mb-4 ">
                <h1 class="text-2xl md:text-3xl text-gray-800 font-bold mb-2">{{selectedComment.title}}</h1>
                <p class="mb-6">{{selectedComment.description}}</p>
              </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-4">

              <!-- 1st block -->
              <div class="bg-white p-5 shadow rounded-md border border-gray-200lg:w-72 xl:w-80">
                <div class="space-y-2">
                  <button class="btn w-full bg-gray-500 hover:bg-indigo-600 text-white">
                    <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 16 16">
                      <path d="m2.457 8.516.969-.99 2.516 2.481 5.324-5.304.985.989-6.309 6.284z" />
                    </svg>
                    <span class="ml-1">Acessar</span>
                  </button>
                  <button class="btn w-full shadow border border-gray-200 hover:border-gray-300 text-gray-600">
                    <svg class="w-4 h-4 fill-gray-500 shrink-0" viewBox="0 0 16 16">
                      <path d="M14.682 2.318A4.485 4.485 0 0 0 11.5 1 4.377 4.377 0 0 0 8 2.707 4.383 4.383 0 0 0 4.5 1a4.5 4.5 0 0 0-3.182 7.682L8 15l6.682-6.318a4.5 4.5 0 0 0 0-6.364Zm-1.4 4.933L8 12.247l-5.285-5A2.5 2.5 0 0 1 4.5 3c1.437 0 2.312.681 3.5 2.625C9.187 3.681 10.062 3 11.5 3a2.5 2.5 0 0 1 1.785 4.251h-.003Z" />
                    </svg>
                    <span class="ml-2">Favorite</span>
                  </button>
                </div>
              </div>

              <!-- 2nd block -->
              <div class="bg-white p-5 shadow-lg rounded-sm border border-gray-200 lg:w-72 xl:w-80">
                <div class="flex justify-between space-x-1 mb-5">
                  <div class="text-sm text-gray-800 font-semibold">Teacher (1)</div>
                  <a class="text-sm font-medium text-indigo-500 hover:text-indigo-600" href="#0">View All</a>
                </div>
                <ul class="space-y-3">
                  <li>
                    <div class="flex justify-between">
                      <div class="grow flex items-center">
                        <div class="relative mr-3">
                          <img class="w-8 h-8 rounded-full" src="/storage/thumbnails/default.png" width="32" height="32" alt="User 08" />
                        </div>
                        <div class="truncate">
                          <span class="text-sm font-medium text-gray-800">Carolyn McNeail</span>
                        </div>
                      </div>
                      <button class="text-gray-400 hover:text-gray-500 rounded-full">
                        <span class="sr-only">Menu</span>
                        <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                          <circle cx="16" cy="16" r="2" />
                          <circle cx="10" cy="16" r="2" />
                          <circle cx="22" cy="16" r="2" />
                        </svg>
                      </button>
                    </div>
                  </li>
                </ul>
              </div>

              <!-- 3rd block -->
              <div class="bg-white p-5 shadow-lg rounded-sm border border-gray-200 lg:w-72 xl:w-80">
                <div class="flex justify-between space-x-1 mb-5">
                  <div class="text-sm text-gray-800 font-semibold">Content</div>
                </div>
                <ul class="space-y-3">
                  <li  v-for="module in selectedComment.modules"  >
                    <div class="flex items-center justify-between">

                          <span class="text-sm font-medium text-gray-800 truncate">{{module.title}}</span>

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
import ListCourse from "./ListCourse.vue";
import CourseHeader from "./CourseHeader.vue";
import {ref} from "vue";


export default {
  name: 'Chat',
  components: {CourseHeader, ListCourse},
  props: {
    courses:Object,
  },
  emits: ['selectedCourse', 'close-msgsidebar', 'toggle-msgsidebar'],
  data() {
    return {
      selectedComment: '',
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
      this.selectedComment = course;
    },
  }
}
</script>
