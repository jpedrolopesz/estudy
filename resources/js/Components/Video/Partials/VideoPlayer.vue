<template>
  <div class="overflow-y-auto">
    <div class="my-8"></div>
    <div class="h-auto bg-transparent flex items-stretch flex-wrap md:flex-nowrap order-1 w-6/6">

      <div class="shadow-md border bg-white border-gray-200  p-2 overflow-x-hidden rounded-sm h-[calc(80vh-64px)] transition-all duration-200  md:mt-6 mt-12  overflow-y-scroll mb-3 md:mb-0 w-full md:w-[220px] lg:w-[290px] xl:w-[390px] !block md:order-1 md:mr-[20px] lg:mr-[20px]">
        <div>
          <TabGroup>
            <TabList class="border-b border-gray-200 ">
            <div class=" w-full font-semibold flex items-center space-x-1 text-sm ">
              <template v-for="(tab, index) in tabs" :key="index">
                <Tab v-slot="{ selected }" class="w-full">
                  <div :class="{ 'text-gray-900 border-b border-b-gray-500': selected }" class="text-gray-500  hover:text-gray-800 whitespace-nowrap">
                    <span  >{{ tab }}</span>
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
              <div class="flex justify-between items-center">
                <div class="text-gray-800 my-2 opacity-70 text-lg font-bold">Comments</div>
                <CommentLesson  :selectedLesson="selectedLesson">
                  <template #button>
                    <button   class="underline font-semibold text-gray-600">Add Comment</button>
                  </template>
                </CommentLesson>
              </div>
              <ul>
                <li  v-for="comment in selectedLesson.comments" :key="comment.id" class="mb-4 relative">

                    <div>
                      <div class="p-2 bg-white rounded-lg border border-gray-200 shadow-sm ">
                        <div class="justify-between items-center mb-3 flex">

                          <div class="flex space-x-2 text-sm font-normal text-gray-500 ">
                            <img class="rounded-full items-baseline w-6 h-6" :src="'/storage/user/' + comment.user.photo">
                            <span class="text-sm font-medium text-gray-500 ">
                              {{comment.user.first_name}}
                            </span>
                          </div>
                          <time class="mb-1 text-xs font-normal text-gray-400">{{moment(comment.created_at).format("DD-MM-YYYY") }}</time>
                        </div>
                        <div class="max-w-lg">

                          <div class="line-clamp-3 p-2 text-xs italic font-normal text-gray-500 bg-gray-50 rounded-lg border border-gray-200 trucate ">
                            <span class="font-semibold">Title: {{comment.title}}</span>
                            <p class="mt-3">{{comment.comment}}</p>
                          </div>
                          <div class="mt-2">

                          </div>
                        </div>
                        <div>
                          <Modal>
                            <template #button>
                              <div @click="selectComment(comment)" class="text-sm text-gray-500 font-semibold hover:text-gray-900 ">View All</div>
                            </template>
                            <template #title>
                              <div>
                                <span class="text-md font-semibold">{{selectedLesson.title}}</span>
                                <div class="flex items-center">
                                  <ChatBubbleLeftEllipsisIcon class="mr-1 w-4 h-4"/>
                                  <p class="text-sm font-semibold"> {{comment.title}}</p>
                                </div>
                              </div>

                            </template>

                            <template #createForm>

                              <div class="flex h-[calc(91vh-64px)] overflow-y-scroll mt-4 mx-1 flex-col space-y-2 justify-between">

                                <div class="flex flex-row space-x-2 m-2"
                                     :class="$page.props.auth.user.id === comment.user.id ? 'flex flex-row space-x-2 flex-row-reverse space-x-reverse ml-14 ' : ''">
                                  <div class="flex flex-col">
                                    <div class="text-sm font-normal text-gray-500 ">
                                       <span class="flex items-center  mb-1 text-sm font-medium text-gray-500"
                                            :class="$page.props.auth.user.id === comment.user.id ? 'justify-end ' : ''">
                                        <img :src="'/storage/user/' + comment.user.photo"  class=" rounded-full w-5 h-5 mr-2 "/>
                                        {{ comment.user.first_name }} {{comment.user.last_name  }}
                                      </span>
                                      <p class="border bg-gray-50 rounded-b-md  p-5"
                                         :class="$page.props.auth.user.id === comment.user.id ? 'rounded-l-md ' : 'rounded-r-md'">
                                      {{comment.comment}}</p>
                                    </div>
                                  </div>
                                </div>



                                <div v-for="reply in comment.replies" :key="reply.id">

                                  <div class="flex flex-row space-x-2 "
                                       :class="$page.props.auth.user.id === reply.user.id ? 'flex flex-row space-x-2 flex-row-reverse space-x-reverse ml-14 mr-2 ' : ''">
                                    <div class="flex flex-col">
                                      <div class="text-sm font-normal text-gray-500 ">
                                       <span class="flex items-center  mb-1 text-sm font-medium text-gray-500"
                                             :class="$page.props.auth.user.id === reply.user.id ? 'justify-end ' : ''">
                                        <img :src="'/storage/user/' + reply.user.photo"  class=" rounded-full w-5 h-5 mr-2 "/>
                                        {{ reply.user.first_name }}
                                      </span>
                                        <p class="border bg-gray-50 rounded-b-md p-3"
                                           :class="$page.props.auth.user.id === reply.user.id ? 'rounded-l-md' : 'rounded-r-md'">
                                        {{reply.reply}}</p>
                                      </div>
                                    </div>
                                  </div>

                                </div>



                              </div>
                              <form @submit.prevent="replyStore">
                                <label for="chat" class="sr-only">Your message</label>
                                <div class="flex items-center border-t  px-3 py-2 rounded-t-lg bg-gray-50">
                                  <textarea id="chat" rows="1" v-model="form.reply" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500" placeholder="Your message..."></textarea>
                                  <button type="submit" class="inline-flex justify-center p-2 text-gray-600 rounded-full cursor-pointer hover:bg-gray-100 ">
                                    <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                                    <span class="sr-only">Send message</span>
                                  </button>
                                </div>
                              </form>



                            </template>
                          </Modal>

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
          <button class="p-2 mr-4 rounded-md bg-gray-200 hover:bg-gray-300" @click="previousLesson">
            <ChevronLeftIcon class="w-5 h-5 text-gray-600 "/>
          </button>

          <button class="p-2 rounded-md bg-gray-200 hover:bg-gray-300 " @click="nextLesson">
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
import { ChevronLeftIcon, ChevronRightIcon, ChatBubbleLeftEllipsisIcon} from '@heroicons/vue/24/outline';
import {Tab, TabGroup, TabList, TabPanel, TabPanels} from "@headlessui/vue";
import Modal from "@/Components/Modal.vue";
import CommentLesson from "@/Components/Video/Partials/CommentLesson.vue";
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import {ref} from "vue";

export default {
  name: 'VideoPlayer',
  components: {
    CommentLesson,
    Modal,
    Tab,
    TabPanel, TabPanels, TabList, TabGroup, VideoSection, ModuleAndLesson,ChatBubbleLeftEllipsisIcon, ChevronRightIcon, ChevronLeftIcon},
  props: {
    course: Object,
    lesson:Object
  },
  emits: ['videoUrl', 'moduleSelect', 'selectedLesson'],
  data() {
    return {
      tabs: ['Lessons', 'Comments', 'Description'],
      videoUrl: '',
      moduleSelect: '',
      selectedLesson: {type:Object||String, required: true},
      moment: moment
    }
  },
  setup() {
    const selectedComment = ref("")

    const {auth} = usePage().props.value
    const form = useForm({
      reply: '',
    })


    const selectComment = (comment) => {
      selectedComment.value = comment
    }


    return {auth,form, selectComment, selectedComment};
  },


  methods: {

    replyStore(){
      this.form.post(
        route('storeReply', {
          reply: this.form.reply,
          user_id: this.auth.user.id,
          comment_id: this.selectedComment.id ,
          comment: true
        }),
        {
          onSuccess: () => {
            this.form.reply = '';
          }
        }
      );
    },

    updateVideoUrl(videoUrl) {
      this.videoUrl = videoUrl;
    },
    updateModule(moduleSelect) {
      this.moduleSelect = moduleSelect;
    },
    handleLessonSelected(lesson) {
      this.selectedLesson = lesson;
    },
    previousLesson() {
      const lessons = this.course.modules.flatMap(module => module.lessons);
      const currentIndex = lessons.findIndex(lesson => lesson.id === this.selectedLesson.id);

      if (currentIndex > 0) {
        const previousLesson = lessons[currentIndex - 1];
        this.handleLessonSelected(previousLesson);
        this.updateVideoUrl(previousLesson.video_url);
      }
    },

    nextLesson() {
      const lessons = this.course.modules.flatMap(module => module.lessons);
      const currentIndex = lessons.findIndex(lesson => lesson.id === this.selectedLesson.id);

      if (currentIndex < lessons.length - 1) {
        const nextLesson = lessons[currentIndex + 1];
        this.handleLessonSelected(nextLesson);
        this.updateVideoUrl(nextLesson.video_url);
      }
    }
  },

}
</script>
