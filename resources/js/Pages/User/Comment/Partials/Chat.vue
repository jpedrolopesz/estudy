<template>
  <div  :class="msgSidebarOpen ? '' : 'flex transform transition-transform duration-9000 ease-in-out'">


  <ListChat
    :comments="comments" @comment-selected="handleCommentSelected"
    :msgSidebarOpen="msgSidebarOpen"
    @close-msgsidebar="msgSidebarOpen = false"
  />

    <div class="w-full  bg-white  shadow-md rounded-md flex flex-col overflow-y-auto">

      <ChatHeader
        :msgSidebarOpen="msgSidebarOpen"
        @toggle-msgsidebar="msgSidebarOpen = !msgSidebarOpen">
        <div class="flex flex-col space-y-1">
          <strong class="truncate" v-if="selectedComment">{{ selectedComment.user.first_name }} {{selectedComment.user.last_name  }}</strong>
        </div>

      </ChatHeader>

      <main :class="msgSidebarOpen ? 'hidden' : ''">
        <p v-if="selectedComment" class="text-xs mx-5 md:text-md truncate">{{selectedComment.title}}</p>


        <div class="p-10 w-full ">
          <div class="flex-auto overflow-y-auto p-5 space-y-4">
            <div class="flex flex-row space-x-2">
              <svg class="flex-none w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>

              <div class="flex flex-col">
                <div class="text-sm font-normal text-gray-500 ">
            <span v-if="selectedComment" class="text-sm font-medium text-gray-500 ">
              {{ selectedComment.user.first_name }} {{selectedComment.user.last_name  }}
            </span>
                </div>
                <div class="bg-gray-100 rounded p-5">
                  {{selectedComment.comment}}

                </div>
                <div class="text-sm text-gray-600">4hr ago</div>
              </div>
            </div>

            <ul>
              <li class="flex mt-6 flex-row space-x-2" v-for="comment in selectedComment.replies" :key="comment.id" >
                <svg class="flex-none w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div class="flex flex-col">
                  <div class="text-sm font-normal text-gray-500 ">
            <span class="text-sm font-medium text-gray-500 ">
              {{ comment.user.first_name }}
            </span>
                  </div>
                  <p class="bg-gray-100 rounded p-5">
                    {{comment.reply}}
                  </p>
                  <div class="text-sm text-gray-600">4hr ago</div>
                </div>
              </li>
            </ul>

            <div class="flex flex-row justify-center text-sm text-gray-600">
              You assigned this conversation to yourself 5d ago
            </div>

            <div class="flex flex-row space-x-2 flex-row-reverse space-x-reverse">
              <svg class="flex-none w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>

              <div class="flex flex-col">
                <div class="bg-blue-100 rounded p-5">
                  Some message text
                </div>
                <div class="text-sm text-gray-600">5hr ago</div>
              </div>
            </div>

          </div>

          <div class="flex-none m-2">
            <form class="grow flex">
              <div class="grow mr-3">
                <label for="message-input" class="sr-only">Type a message</label>
                <input id="message-input" class="form-input w-full bg-slate-100 border-transparent focus:bg-white focus:border-slate-300" type="text" placeholder="Aa" />
              </div>
              <button type="submit" class="btn bg-indigo-500 hover:bg-indigo-600 text-white whitespace-nowrap">Send -&gt;</button>
            </form>
          </div>
        </div>

      </main>
  </div>

  </div>
</template>

<script>
import moment from "moment";
import ListChat from "@/Pages/User/Comment/Partials/ListChat.vue";
import {ref} from "vue";
import ChatHeader from "@/Pages/User/Comment/Partials/ChatHeader.vue";

export default {
  name: 'Chat',
  components: {ChatHeader, ListChat},
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

    return {
      sidebarOpen,
      msgSidebarOpen,
    }
  },
  methods: {
    handleCommentSelected(comment) {
      this.selectedComment = comment;
    },
  }
}
</script>
