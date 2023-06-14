<template>

  <div>

    <div v-for="(module, index) in course.modules" :key="index" >
      <Disclosure v-slot="{ open }">
        <DisclosureButton
          :class="['modules', module.id === showModule ? 'border-gray-500 ' : '']"
          class="flex justify-between shadow-sm my-3 hover:border-gray-500 items-center px-3 py-3 bg-white rounded lg:flex-grow mb-1 w-full border border-gray-100 hover:bg-gray-50 bg-gray-50"
          @click.prevent="toggleModule(module.id)"
          @click="updateModule(module.id)"
        >
        <button class="truncate  text-left text-sm font-medium text-gray-500]">
        {{index + 1 }} - {{ module.title }}
        </button>

          <ChevronRightIcon class="w-5 h-5 text-gray-500" :class="open ? 'rotate-90 transform' : ''"/>

        </DisclosureButton>

        <DisclosurePanel class="px-2 pb-2 text-sm text-gray-500">
          <div v-show="module.id = showModule" >
            <ul>
              <li class="cursor-pointer border hover:border-gray-500 flex justify-between items-center px-3 py-2 bg-white rounded lg:flex-grow mb-1 w-full"
                  v-for="lesson in module.lessons" :key="lesson.id"
                  @click="selectLesson(lesson)"
              >
                <a @click="updateVideoUrl(lesson.video_url)"
                   class="flex items-center w-full">
                   <div class="flex justify-center w-6 h-6 items-center mr-5  rounded-full bg-gray-100">
                     <div v-if="lesson.lesson_user_views && lesson.lesson_user_views.length > 0">
                       <div v-for="lessonShow in lesson.lesson_user_views[0].watched" :key="lessonShow">
                         <CheckCircleIcon class="w-6 h-6  text-gray-500"/>
                      </div>
                     </div>

                   </div>

                  <div class="flex-grow min-w-0">
                    <h2 class="leading-snug truncate text-ellipsis text-sm">
                       {{lesson.title}}
                    </h2>
                    </div>
                   <button @click="toggleWatched(lesson)">

Aqui
                    </button>


                  <div class="text-xs text-dark-2 opacity-75 flex items-center ml-4">
                    <div class="whitespace-nowrap">05:40</div>
                  </div>

                </a>
              </li>
            </ul>
          </div>
        </DisclosurePanel>
      </Disclosure>
    </div>


    {{watched}}


  </div>

</template>

<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import { ChevronRightIcon, PlayIcon, CheckCircleIcon } from '@heroicons/vue/24/outline';
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




const toggleModule = (moduleId) => { if (modulesState[moduleId] && modulesState[moduleId].open) {
  modulesState[moduleId].open = false;
} else { Object.keys(modulesState).forEach((id) => { modulesState[id].open = false;});
  modulesState[moduleId] = { open: true };
}};


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
    onSuccess: () => {
    },
  });
}

</script>


