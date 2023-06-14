<template>
  <div class="overflow-y-auto ">

  <div class="h-auto bg-white border border-gray-500  flex items-stretch flex-wrap md:flex-nowrap -md:pb-16 order-1 w-6/6">

    <div class="shadow-md border border-gray-500  bg-white p-2 overflow-x-hidden rounded-sm h-[calc(80vh-64px)] transition-all duration-200  md:mt-6 mt-12  overflow-y-scroll mb-3 md:mb-0 w-full md:w-[220px] lg:w-[290px] xl:w-[390px] !block md:order-1 md:mr-[20px] lg:mr-[20px]">

      <div>
        <TabGroup>

          <TabList class="border-b border-gray-200 rounded-t-md">

            <!-- Start -->
            <div class="text-md w-full font-semibold flex items-center ">
              <Tab  v-slot="{ selected }" class="w-full  ">
                <div :class="{ 'text-gray-900 border-b border-b-blue-500 ': selected }" class="text-gray-500 hover:text-gray-800 whitespace-nowrap ">

                  <span>Lessons</span>
                </div>
              </Tab>
              <Tab v-slot="{ selected }" class="w-full ">
                <div :class="{ 'text-gray-900 border-b border-b-blue-500 ': selected }" class="text-gray-500 hover:text-gray-800 whitespace-nowrap ">

                  <span>Comments</span>
                </div>
              </Tab>

              <Tab v-slot="{ selected }" class="w-full ">
                <div :class="{ 'text-gray-900 border-b border-b-blue-500 ': selected }" class="text-gray-500 hover:text-gray-800 whitespace-nowrap ">

                  <span>Description</span>
                </div>
              </Tab>


            </div>
            <!-- End -->
          </TabList>

        <TabPanels>

          <!-- Tab 1-->
          <TabPanel>
            <ModuleAndLesson
              class="px-2 "
              :course="course"
              :selected-lesson="selectedLesson"
              @update-video-url="updateVideoUrl"
              @update-module="updateModule"
              @lesson-selected="handleLessonSelected"/>
          </TabPanel>

          <!-- Tab 2-->
          <TabPanel>
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
          </TabPanel>


          <TabPanel>
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
        <div class=" justify-start bg-blue-500 pb-2 sticky w-3/4">
          <p class="text-left text-xl font-bold text-gray-800">{{ selectedLesson.title }}</p>

        </div>
          <div class=" bg-red-500  w-2/6">


            <div class="flex flex-wrap justify-end">
              <div>
                <button class="px-6 py-1.5 m-1 rounded-md bg-gray-200 hover:bg-gray-300">
                  Visto
                </button>
              </div>

              <div class="flex">
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
