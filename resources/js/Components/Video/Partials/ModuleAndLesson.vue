<template>
  <div>
    <div v-for="(module, index) in course.modules" :key="index">
      <Disclosure v-slot="{ open }">
        <DisclosureButton
          class="flex justify-between shadow-sm my-3 hover:border-gray-500 items-center px-3 py-3 bg-white rounded lg:flex-grow mb-1 w-full border border-gray-100 hover:bg-gray-50 bg-gray-50"
          @click.prevent="toggleModule(module.id)"
          @click="updateModule(module.id)"
        >
          <button class="truncate  text-left text-sm font-medium text-gray-500]">
            {{ index + 1 }} - {{ module.title }}
          </button>

          <ChevronRightIcon class="w-5 h-5 text-gray-500" :class="open ? 'rotate-90 transform' : ''" />
        </DisclosureButton>

        <DisclosurePanel class="px-2 pb-2 text-sm text-gray-500" v-show="module.isOpen">
          <div>
            <ul>
              <li class="cursor-pointer border mb-1 hover:border-gray-500 flex justify-between items-center px-2 py-2 bg-white rounded "
                  v-for="lesson in module.lessons" :key="lesson.id"
                  @click="selectLesson(lesson)"
              >
                <a @click="updateVideoUrl(lesson.video_url)"
                   class="flex items-center w-full">
                   <div class="flex items-center justify-center bg-gray-100 border border-gray-300 hover:border-gray-800 w-5 h-5  rounded-full">
                     <button @click="toggleWatched(lesson)">
                       <div v-if="lesson.lesson_user_views?.length && lesson.lesson_user_views[0].watched === 1">
                         <div v-for="lessonShow in lesson.lesson_user_views[0].watched" :key="lessonShow">
                           <CheckCircleIcon class="w-6 h-6 text-gray-500"/>
                         </div>
                       </div>

                       <div v-else>
                         <div class="hover:bg-gray-300  items-center rounded-full">
                           <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 100 100">
                             <circle cx="50" cy="50" r="40" fill="transparent" />
                           </svg>
                         </div>
                       </div>
                     </button>
                   </div>

                  <div class="flex-grow mx-1 min-w-0">
                    <h2 class="leading-snug truncate text-ellipsis text-sm">
                       {{lesson.title}}
                    </h2>
                    </div>



                </a>
              </li>
            </ul>
          </div>
        </DisclosurePanel>
      </Disclosure>
    </div>
  </div>
</template>

<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import { ChevronRightIcon, CheckCircleIcon } from '@heroicons/vue/24/outline';
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/inertia-vue3";

const props = defineProps({
   course: Object,
   watched: { type: Boolean, default: false}
 });
const emit = defineEmits(["update-video-url", "update-module", "lesson-selected"]);

const { auth } = usePage().props.value;
const showModule = ref('0');
const modulesState = {};




const toggleModule = (moduleId) => {
  Object.keys(modulesState).forEach((id) => {
    if (id === moduleId) {
      modulesState[id].isOpen = true;
    } else {
      modulesState[id].isOpen = false;
    }
  });
};



const updateVideoUrl = (videoUrl) => {   emit("update-video-url", videoUrl);};

const updateModule = (moduleSelect) => {   emit("update-module", moduleSelect);};

const selectLesson = (lesson) => {   emit('lesson-selected', lesson);};

const toggleWatched = (lesson) => {

  Inertia.post(route('lessons.markAsWatched', {
    _method: 'put',
    user_id: auth.user.id,
    id: lesson.id,
    watched: lesson.watched,
  }), {}, {
    preserveState: true,
  });
}

</script>


