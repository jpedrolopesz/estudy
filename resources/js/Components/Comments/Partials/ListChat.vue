<template>


  <div id="messages-sidebar"
       class="flex bg-white shadow-md  rounded-md sm:mx-2 border border-gray-200 flex-col absolute right-20 w-full sm:w-auto  sm:static sm:bottom-auto sm:translate-x-0 transform transition-transform duration-200 ease-in-out"
       :class="msgSidebarOpen ? 'translate-y-1 translate-x-20 ' : '-translate-x-full '"
  >
    <div class="flex rounded-t-lg border-b h-16 bg-white justify-between">
      <h1 class="font-medium m-2 text-lg lg:text-2xl opacity-75">Comments</h1>
      <FormSearch class="w-2/3 mx-2 " v-model="search" @reset="reset">

        <RadioGroup v-model="reply">
          <RadioGroupLabel class="text-xs font-semibold uppercase text-gray-500 px-1">Filters</RadioGroupLabel>
          <RadioGroupOption v-slot="{ checked }" value="answered">
                  <span class="flex items-center text-xs font-semibold uppercase text-gray-500  border-t border-gray-100 hover:bg-gray-50 py-1 px-1.5 cursor-pointer"
                        :class="checked ? 'bg-gray-100' : 'flex items-center w-full hover:bg-gray-50 py-1 px-1.5 cursor-pointer'">
                    Answered
                  </span>
          </RadioGroupOption>


          <RadioGroupOption v-slot="{ checked }" value="unanswered">
                  <span class="flex items-center text-xs font-semibold uppercase text-gray-500  border-t border-gray-100 hover:bg-gray-50 py-1 px-1.5 cursor-pointer"
                        :class="checked ? 'bg-gray-100' : 'flex items-center w-full hover:bg-gray-50 py-1 px-1.5 cursor-pointer'">
                   Unanswered
                  </span>
          </RadioGroupOption>
        </RadioGroup>

        <div class="py-2 px-1 border-t border-gray-100 bg-gray-50">
          <button @click="reset" class="py-0.5 px-2 bg-gray-50 text-xs font-semibold uppercase text-gray-500 rounded-md  border border-gray-300 hover:bg-gray-200 hover:text-gray-500">
            Clear
          </button>
        </div>

      </FormSearch>

    </div>
    <div  class="overflow-y-auto h-[calc(92vh-64px)]">

      <ul v-if="comments.length > 0">
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
      <p v-else class="font-semibold justify-center m-2">No comments found.</p>



    </div>
  </div>

</template>

<script>

import moment from "moment/moment";
import FormSearch from "@/Components/FormSearch.vue";
import { BookmarkIcon, PhotoIcon } from '@heroicons/vue/24/outline';
import {computed, ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import { usePage} from "@inertiajs/inertia-vue3";

import {RadioGroup, RadioGroupLabel, RadioGroupOption} from "@headlessui/vue";



export default {
  name: 'ListChat',
  components: {RadioGroupOption, RadioGroupLabel, RadioGroup, BookmarkIcon,PhotoIcon, FormSearch},
  props: {
    comments: Object,
    msgSidebarOpen:Boolean
  },
  data() {
    return {
      moment: moment,

    }
  },
  setup(){

    const {auth} = usePage().props.value;
    let search = ref('');
    let reply = ref('');

    let isAdmin = ref(auth.user.owner);

    let commentsUrl = computed(() => {
      return isAdmin.value ? "/admin/comments" : "/support";
    });

    watch(search, (value) => {
      Inertia.get(commentsUrl.value, {
        search: value
      }, {
        preserveState: true
      });
    });

    watch(reply, (value) => {
      Inertia.get(commentsUrl.value, {
        reply: value
      }, {
        preserveState: true
      });
    });


    function reset() {
      search.value = ''
      reply.value = ''
    }

    return {search, reset, reply, auth}
  },
  emits: ["comment-selected", 'close-msgsidebar'],
  methods: {
    selectComment(comment) {
      this.$emit('comment-selected', comment);
    },

  },

}
</script>

