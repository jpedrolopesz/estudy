<template>

  <div id="course-sidebar"
       class="flex bg-white shadow-md rounded-md mr-4 border border-gray-200 flex-col absolute z-20 pb-4 right-20 w-4/5 md:w-auto md:static  md:bottom-auto md:translate-x-0 transform transition-transform duration-200 ease-in-out"
       :class="msgSidebarOpen ? 'translate-y-10 translate-x-20 ' : '-translate-x-full '"
  >

    <div>

      <header class="px-4 py-2 flex items-center justify-between">
        <h2 class="text-xs font-semibold uppercase text-gray-500 hidden sm:block">
          All Courses {{courses.length}}
        </h2>

      </header>


      <div class="overflow-y-auto ">
        <ul>
          <li class="mx-2 shadow-sm rounded-sm border my-4 border-gray-200  hover:bg-gray-50"
              v-for="course in courses" :key="course.id"
              @click="selectCourse(course)"
              @click.stop="$emit('close-msgsidebar')">
            <div class="flex m-2 gap-x-2">
              <div class="w-1/4">
                <img src="/storage/thumbnails/default.png" class="h-[90px] w-3/3 flex-shrink-0 flex-grow-0 rounded-xl object-cover" />
              </div>
              <div class="flex-grow grid-rows-3 justify-between ">
                <span class="flex-shrink-0 flex-grow-0 text-left text-base font-bold text-gray-600">{{ course.title }}</span>
                <p class="flex-shrink-0 flex-grow-0 text-left text-xs font-medium text-[#7b8392]">40+ lessons · 4+ hours</p>

                <div class=" mt-4 text-sm text-gray-60">Acessar </div>

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
