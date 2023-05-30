<template>
  <div class="flex bg-transparent flex-col overflow-hidden">


  <div class="h-auto bg-transparent flex items-stretch flex-wrap md:flex-nowrap -md:pb-16 order-3 md:w-[calc(100%+150px+180px)] lg:w-[calc(100%+280px+150px)]">

    <div class="shadow-md bg-white p-2 overflow-x-hidden rounded-sm h-[calc(80vh-64px)] transition-all duration-200 mt-2 md:mt-6 mt-12  overflow-y-scroll mb-3 md:mb-0 w-full md:w-[220px] lg:w-[290px] xl:w-[390px] !block md:order-1 md:mr-[350px] lg:mr-[450px]">

      <div>



        <ModuleAndLesson class="px-2"
          :course="course"
          @update-video-url="updateVideoUrl"
          @update-module="updateModule"
          @lesson-selected="handleLessonSelected"/>

      </div>

    </div>

    <div class="px-0 md:px-6 md:mt-6 transition-all duration-200 mb-3 md:mb-0 flex-grow order-first w-full md:w-auto">

      <VideoSection :video-url="videoUrl"/>

      <div>
          <div class="flex items-center justify-between bg-gray-50 pb-6 sticky top-0 w-full z-30">


              <p class="flex-shrink-0 flex-grow-0 text-left text-xl font-bold text-gray-800">
              {{ selectedLesson.title }}
              </p>

            <div class="flex mt-2 items-center">
              <button class="p-2 mr-4 rounded-md bg-gray-200 hover:bg-gray-300">
                <ChevronLeftIcon class="w-5 h-5 text-gray-600 "/>
              </button>

              <button class="p-2 rounded-md bg-gray-200 hover:bg-gray-300 ">
                <ChevronRightIcon class="w-5 h-5 text-gray-600 "/>
              </button>
            </div>
        </div>

        <div class="bg-gray-200 max-w-screen-md rounded-md w-full p-3 text-white">
          <div class="text-sm text-gray-700 font-medium mb-6">
            {{ selectedLesson.description }}
          </div>

        </div>


      </div>



    </div>


  </div>

  <div class="order-4 mt-6">
    <div class="text-gray-800 opacity-70 text-lg font-bold">Comments</div>

    <div>
      <ul>
        <li  v-for="comment in selectedLesson.comments" :key="comment.id" class="mb-4 ml-6 relative border-l border-gray-200">
          <span class="flex absolute -left-3 justify-center items-center w-8 h-8 bg-white rounded-full ring-4 ring-white">


             <img class="rounded-full  flex items-baseline w-8 h-8"
                  :src="`https://picsum.photos/id/${(Math.random() * 100).toFixed(0)}/100` || ''"
             >

            </span>
              <div>
                <div class="p-4 ml-4 bg-white rounded-lg border border-gray-200 shadow-sm ">
                  <div class="justify-between items-center mb-3 sm:flex">
                    <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">{{moment(comment.created_at).format("DD-MM-YYYY") }}</time>
                    <div class="text-sm font-normal text-gray-500 ">
                       <span class="text-sm font-medium text-gray-500 ">
                       Joao Pedro Lopes
                       </span> commented on
                      <span class="font-semibold text-gray-900"> Title</span>
                    </div>

                  </div>
                  <div class="p-3 text-xs italic font-normal text-gray-500 bg-gray-50 rounded-lg border border-gray-200 ">
                    {{comment.comment}}
                  </div>
                </div>
              </div>




            </li>

          </ul>



    </div>
  </div>

  </div>
</template>


<script>
import moment from "moment";
import VideoSection from "./VideoSection.vue";
import ModuleAndLesson from "./ModuleAndLesson.vue";
import { ChevronLeftIcon, ChevronRightIcon} from '@heroicons/vue/24/outline';

export default {
  name: 'VideoPlayer',
  components: {VideoSection, ModuleAndLesson, ChevronRightIcon, ChevronLeftIcon},
  props: {
    course: Object,
  },
  emits: ['videoUrl', 'moduleSelect', 'selectedLesson'],
  data() {
    return {
      videoUrl: '',
      moduleSelect: '',
      selectedLesson: '',
      moment: moment
    }
  },
  methods: {
    updateVideoUrl(videoUrl) {
      this.videoUrl = videoUrl;
    },
    updateModule(moduleSelect) {
      this.moduleSelect = moduleSelect;
    },
    handleLessonSelected(lesson) {
      this.selectedLesson = lesson;
    },

  }

}
</script>
