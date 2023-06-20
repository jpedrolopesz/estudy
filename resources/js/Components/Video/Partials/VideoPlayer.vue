<template>
  <div class="overflow-y-auto">


    <div class="my-8"></div>

  <div class="h-auto bg-transparent flex items-stretch flex-wrap md:flex-nowrap order-1 w-6/6">

    <div class="shadow-md border bg-white border-gray-200  p-2 overflow-x-hidden rounded-sm h-[calc(80vh-64px)] transition-all duration-200  md:mt-6 mt-12  overflow-y-scroll mb-3 md:mb-0 w-full md:w-[220px] lg:w-[290px] xl:w-[390px] !block md:order-1 md:mr-[20px] lg:mr-[20px]">

      <div>
        <TabGroup>

          <TabList class="border-b border-gray-200 ">
            <div class="text-md w-full font-semibold flex items-center">
              <template v-for="(tab, index) in tabs" :key="index">
                <Tab v-slot="{ selected }" class="w-full">
                  <div :class="{ 'text-gray-900 border-b border-b-gray-500': selected }" class="text-gray-500 hover:text-gray-800 whitespace-nowrap">
                    <span >{{ tab }}</span>
                  </div>
                </Tab>
              </template>
            </div>
          </TabList>

        <TabPanels>

          <!-- Tab 1-->
          <TabPanel>
            <div class="text-gray-800 my-2 opacity-70 text-lg font-bold">Lessons</div>
            <ModuleAndLesson
              :course="course"
              :selected-lesson="selectedLesson"
              @update-video-url="updateVideoUrl"
              @update-module="updateModule"
              @lesson-selected="handleLessonSelected"/>
          </TabPanel>

          <!-- Tab 2-->
          <TabPanel>
            <div >
              <div class="text-gray-800 my-2 opacity-70 text-lg font-bold">Comments</div>
              <ul>
                <li  v-for="comment in selectedLesson.comments" :key="comment.id" class="mb-4 relative">
                    <div>
                      <div class="p-4  bg-white rounded-lg border border-gray-200 shadow-sm ">
                        <div class="justify-between items-center mb-3 flex">

                          <div class="flex space-x-2 text-sm font-normal text-gray-500 ">
                            <img class="rounded-full items-baseline w-6 h-6" :src="'/storage/user/' + comment.user.photo">
                            <span class="text-sm font-medium text-gray-500 ">
                              {{comment.user.first_name}}
                            </span>
                          </div>

                          <time class="mb-1 text-xs font-normal text-gray-400">{{moment(comment.created_at).format("DD-MM-YYYY") }}</time>


                        </div>
                        <div class="p-3 text-xs italic font-normal text-gray-500 bg-gray-50 rounded-lg border border-gray-200 ">
                          {{comment.comment}}
                        </div>
                      </div>
                    </div>




                  </li>

                </ul>
            </div>
          </TabPanel>

          <!-- Tab 3-->
          <TabPanel>
            <div class="text-gray-800 my-2 opacity-70 text-lg font-bold">Description</div>
            <div class="bg-gray-200 max-w-screen-md rounded-md w-full p-3 text-white">
              <div class="text-sm text-gray-700 font-medium ">
                {{ selectedLesson.description }}
              </div>
            </div>
          </TabPanel>

        </TabPanels>
        </TabGroup>

      </div>

    </div>
    <div class="px-0 md:px-6 md:mt-6 transition-all duration-200 mb-3 md:mb-0 flex-grow order-first w-full md:w-auto">

      <VideoSection :video-url="videoUrl"/>

      <div class="flex">
        <div class=" justify-start pb-2 sticky w-full">
          <p class="text-left text-xl font-bold text-gray-800">{{ selectedLesson.title }}</p>

        </div>


        <div class="flex mx-2 ">
          <button class="p-2 mr-4 rounded-md bg-gray-200 hover:bg-gray-300">
            <ChevronLeftIcon class="w-5 h-5 text-gray-600 "/>
          </button>

          <button class="p-2 rounded-md bg-gray-200 hover:bg-gray-300 ">
            <ChevronRightIcon class="w-5 h-5 text-gray-600 "/>
          </button>
        </div>




      </div>



    </div>


  </div>


  </div>
</template>


<script>
import moment from "moment";
import VideoSection from "./VideoSection.vue";
import ModuleAndLesson from "./ModuleAndLesson.vue";
import { ChevronLeftIcon, ChevronRightIcon} from '@heroicons/vue/24/outline';
import {Tab, TabGroup, TabList, TabPanel, TabPanels} from "@headlessui/vue";

export default {
  name: 'VideoPlayer',
  components: {
    Tab,
    TabPanel, TabPanels, TabList, TabGroup, VideoSection, ModuleAndLesson, ChevronRightIcon, ChevronLeftIcon},
  props: {
    course: Object,
  },
  emits: ['videoUrl', 'moduleSelect', 'selectedLesson'],
  data() {
    return {
      tabs: ['Lessons', 'Comments', 'Description'],
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
