<template>

  <div id="course-sidebar"
       class="flex bg-white shadow-md  rounded-md mx-2 border border-gray-200 flex-col absolute right-20 w-5/6 md:w-auto md:static  md:bottom-auto md:translate-x-0 transform transition-transform duration-200 ease-in-out"
       :class="msgSidebarOpen ? 'translate-y-1 translate-x-20 ' : '-translate-x-full '"
  >
    <div class="flex rounded-t-lg border-b h-16 bg-white justify-between">
      <h1 class="font-medium m-2 text-lg lg:text-2xl opacity-75">Courses</h1>

    </div>

    <div>

      <header class="px-4 py-2 flex items-center justify-between">
        <h2 class="text-xs font-semibold uppercase text-gray-500 hidden sm:block">
          All Courses {{courses.length}}
        </h2>

      </header>


      <div class="overflow-y-auto h-[calc(84vh-64px)]">
        <ul>
          <li class="mx-2 shadow-sm rounded-sm border my-2 border-gray-200 cursor-pointer hover:bg-gray-50"
              v-for="course in courses" :key="course.id"
              @click="selectCourse(course)"
              @click.stop="$emit('close-msgsidebar')">
            <div class="flex m-2 gap-x-2">
              <div >
                <img :src="'/storage/' + course.thumbnail" class="h-[90px] w-46  rounded-xl object-cover" />
              </div>
              <div class="flex-grow grid-rows-3 justify-between ">
                <span class="flex-shrink-0 flex-grow-0 text-left text-base font-bold text-gray-600">{{ course.title }}</span>
                <h2 class="text-xs mt-2 font-semibold uppercase text-gray-500 hidden sm:block">
                  Progress
                </h2>


                <div class="w-full bg-gray-200 rounded-full">
                  <div class="bg-gray-600 text-xs font-medium text-blue-100 text-center  leading-none rounded-full" :style="{width: course.progressPercentage + '%'}">
                    {{ Math.round(course.progressPercentage) }}%
                  </div>
                </div>

              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>


  </div>


</template>



<script setup>
import { defineEmits, defineProps } from 'vue';

const props = defineProps({
  courses: Object,
  msgSidebarOpen:Boolean
})

const emit = defineEmits(["course-selected", "close-msgsidebar"]);
const { meta } = props.courses;

const selectCourse = (course) => {
  emit("course-selected", course);
};


</script>
