<template>


  <div id="messages-sidebar"
       class="flex bg-white shadow-md rounded-md mx-2 border border-gray-200 flex-col absolute right-20 w-5/6 md:w-auto md:static  md:bottom-auto md:translate-x-0 transform transition-transform duration-200 ease-in-out"
       :class="msgSidebarOpen ? 'translate-y-1 translate-x-20 ' : '-translate-x-full '"
  >
    <div class="flex rounded-t-lg border-b h-16 bg-white justify-between">
      <h1 class="font-medium m-2 text-lg lg:text-2xl opacity-75">Comments</h1>
      <FormSearchSideBar/>

    </div>
    <div  class="overflow-y-auto h-[calc(92vh-64px)]">

      <ul>
        <li v-for="comment in comments" :key="comment.id" class="ml-2 rounded-sm border cursor-pointer my-2 border-gray-200 hover:bg-gray-50"
            @click="selectComment(comment)"
            @click.stop="$emit('close-msgsidebar')"
        >
          <div class="border-l-2 border-transparent hover:bg-gray-100 p-3 space-y-2">
            <div class="flex flex-row items-center space-x-2">
              <img v-bind:src="'/storage/user/' + comment.user.photo" :alt="comment.user.first_name" class=" rounded-full w-5 h-5"/>
              <strong class="flex-grow text-sm">{{ comment.user.first_name }}</strong>
              <div class="text-xs text-gray-600">{{moment(comment.created_at).format("DD-MM-YYYY") }}</div>
            </div>

            <div class="flex items-center">
              <BookmarkIcon class="w-4 h-4 mr-0.5"/>
              <p class="truncate text-xs">{{comment.title}}</p>
            </div>
            <div class="flex items-center">
              <PhotoIcon class="w-4 h-4 mr-0.5"/>
              <p class="text-xs">{{ comment.lesson.title }}</p>
            </div>

          </div>
        </li>
      </ul>


    </div>
  </div>

</template>

<script>

import moment from "moment/moment";
import FormSearch from "@/Components/FormSearch.vue";
import FormSearchSideBar from "@/Components/FormSearchSideBar.vue";
import { BookmarkIcon, PhotoIcon } from '@heroicons/vue/24/outline';



export default {
  name: 'ListChat',
  components: {FormSearchSideBar, BookmarkIcon,PhotoIcon, FormSearch},
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

