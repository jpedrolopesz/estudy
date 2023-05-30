<template>


  <div id="messages-sidebar"
       class="flex shadow-lg flex-col absolute z-20 top-20 bottom-0 right-1.5 w-4/5 md:w-auto md:static md:top-auto md:bottom-auto md:translate-x-0 transform transition-transform duration-200 ease-in-out"
       :class="msgSidebarOpen ? 'translate-x-0' : '-translate-x-full'"
  >
    <div class="flex rounded-t-lg border-b h-16 bg-white justify-between">
      <h1 class="font-medium m-2 text-lg lg:text-2xl opacity-75">Comments</h1>
      <FormSearchSideBar/>

    </div>
    <div class="flex-auto bg-white rounded-b-lg border-1 border-gray-100 overflow-y-auto">
      <ul>
        <li v-for="comment in comments" :key="comment.id" class="block border-b"
            @click="selectComment(comment)"
            @click.stop="$emit('close-msgsidebar')"
        >
          <div class="border-l-2 border-transparent hover:bg-gray-100 p-3 space-y-2">
            <div class="flex flex-row items-center space-x-2">
              <img v-bind:src="'/storage/user/' + comment.user.photo" :alt="comment.user.first_name" class=" rounded-full w-5 h-5"/>
              <strong class="flex-grow text-sm">{{ comment.user.first_name }}</strong>
              <div class="text-xs text-gray-600">{{moment(comment.created_at).format("DD-MM-YYYY") }}</div>
            </div>

            <div class="flex flex-row items-center space-x-1">
              <svg class="flex-none w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
              <div class="flex-grow truncate text-xs">{{comment.title}} </div>
            </div>
          </div>
        </li>
      </ul>

      <a class="block border-b">
        <div class="border-l-2 border-blue-500 bg-blue-100 p-3 space-y-4">
          <div class="flex flex-row items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <strong class="flex-grow text-sm">Nikola Tesla</strong>
            <div class="text-sm text-gray-600">5hr</div>
          </div>

          <div class="flex flex-row items-center space-x-1">
            <svg class="flex-none w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div class="flex-grow truncate text-xs">some message content whedkjwhed wkjehdkjweh dkjhwekjdhwekjhd </div>
          </div>
        </div>
      </a>

    </div>
  </div>

</template>

<script>

import moment from "moment/moment";
import FormSearch from "@/Components/FormSearch.vue";
import FormSearchSideBar from "@/Components/FormSearchSideBar.vue";


export default {
  name: 'ListChat',
  components: {FormSearchSideBar, FormSearch},
  props: {
    comments: Object,
    msgSidebarOpen:Boolean
  },
  data() {
    return {
      moment: moment,

    }
  },
  emits: ["comment-selected", 'close-msgsidebar'],
  methods: {
    selectComment(comment) {
      this.$emit('comment-selected', comment);
    },

  },

}
</script>

