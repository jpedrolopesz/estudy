<template>
  <div  :class="msgSidebarOpen ? '' : 'flex transform transition-transform duration-9000 ease-in-out'">


  <ListChat
    :comments="comments" @comment-selected="handleCommentSelected"
    :msgSidebarOpen="msgSidebarOpen"
    @close-msgsidebar="msgSidebarOpen = false"
  />

    <div v-if="selectedComment" class="w-full bg-white shadow-md rounded-md flex flex-col justify-between">

      <ChatHeader class="border-b "
        :class="msgSidebarOpen ? 'hidden' : ''"
        :msgSidebarOpen="msgSidebarOpen"
        @toggle-msgsidebar="msgSidebarOpen = !msgSidebarOpen">
        <div class="flex flex-col my-2.5 space-y-1">
          <strong class="truncate" >{{ selectedComment.user.first_name }} {{selectedComment.user.last_name  }}</strong>
          <p class="text-xs md:text-md truncate">{{selectedComment.title}}</p>
        </div>
      </ChatHeader>

      <main class="overflow-y-auto" :class="msgSidebarOpen ? 'hidden' : ''">
        <div class="p-12 w-full ">
          <div class="flex-auto overflow-y-auto space-y-4">
            <div class="flex flex-row space-x-2"
                 :class="$page.props.auth.user.id === selectedComment.user.id ? 'flex flex-row space-x-2 flex-row-reverse space-x-reverse ml-14 ' : ''">
               <div class="flex flex-col">
                  <div class="text-sm font-normal text-gray-500 ">
                    <span class="flex items-center  mb-1 text-sm font-medium text-gray-500"
                          :class="$page.props.auth.user.id === selectedComment.user.id ? 'justify-end ' : ''">
                      <img :src="'/storage/user/' + selectedComment.user.photo"  class=" rounded-full w-5 h-5 mr-2 "/>
                      {{ selectedComment.user.first_name }} {{selectedComment.user.last_name  }}
                    </span>
                    <p class="border bg-gray-50 rounded-md p-5">{{selectedComment.comment}}</p>
                  </div>
              </div>
            </div>

            <ul>
              <li class="flex flex-row my-4" v-for="comment in selectedComment.replies" :key="comment.id" >
                <div class="flex flex-col">
                  <div class="text-sm font-normal text-gray-500 ">
                   <span class="flex items-center  mb-1 text-sm font-medium text-gray-500"
                         :class="$page.props.auth.user.id === selectedComment.user.id ? 'justify-end ' : ''">
                      <UserCircleIcon class="w-6 h-6 mr-1"/>
                      {{ comment.user.first_name }}
                    </span>
                    <p class="border bg-gray-50 rounded-md p-5">
                      {{comment.reply}}
                    </p>
                  </div>

                </div>
              </li>
            </ul>
          </div>
        </div>

      </main>

      <div :class="msgSidebarOpen ? 'hidden' : ''">
        <form>
          <label for="chat" class="sr-only">Your message</label>
          <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50">
            <textarea id="chat" v-model="form.comment" rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500" placeholder="Your message..."></textarea>
            <button type="submit" class="inline-flex justify-center p-2 text-gray-600 rounded-full cursor-pointer hover:bg-gray-100 ">
              <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
              <span class="sr-only">Send message</span>
            </button>
          </div>
        </form>
      </div>

    </div>

  </div>
</template>

<script>
import moment from "moment";
import ListChat from "@/Components/Comments/Partials/ListChat.vue";
import {ref} from "vue";
import ChatHeader from "@/Components/Comments/Partials/ChatHeader.vue";
import FormComment from "@/Components/Form/FormComment.vue";
import { UserCircleIcon } from '@heroicons/vue/24/outline';
import {useForm} from "@inertiajs/inertia-vue3";

export default {
  name: 'Chat',
  components: {FormComment, ChatHeader, ListChat, UserCircleIcon},
  props: {
    comments: Object,
    msgSidebarOpen:Boolean
  },
  emits: ['selectedComment', 'close-msgsidebar', 'toggle-msgsidebar'],
  data() {
    return {
      selectedComment: '',
      moment: moment
    }
  },
  setup() {
    const sidebarOpen = ref(false)
    const msgSidebarOpen = ref(true)

    const form = useForm({
      comment: ''
    })

    return {
      sidebarOpen,
      msgSidebarOpen,
      form
    }
  },
  methods: {
    handleCommentSelected(comment) {
      this.selectedComment = comment;
    },
  }
}
</script>
