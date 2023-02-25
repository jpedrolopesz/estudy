<template>

  <div>
    <div v-for="module in course.modules" :key="module.id" >
      <Disclosure v-slot="{ open }">
        <DisclosureButton
          :class="['modules', module.id === showModule ? 'border-slate-300' : '']"
          class="flex justify-between items-center px-3 py-3 bg-white rounded lg:flex-grow mb-1 w-full border border-gray-100 hover:bg-gray-50 bg-gray-50"
          @click.prevent="toggleModule(module.id)"
          @click="updateModule(module.title)"
        >
        <button  class="truncate text-base text-sm">
          {{ module.title}}
        </button>
          <i class='bx bx-chevron-down text-gray-400 bx-sm' :class="open ? 'rotate-180 transform' : ''"></i>

        </DisclosureButton>

        <DisclosurePanel class="px-2 pb-2 text-sm text-gray-500">
          <div v-show="module.id = showModule" >
            <ul>
              <li class="flex justify-between items-center px-3 py-2 bg-white rounded lg:flex-grow mb-1 w-full border border-gray-100  hover:bg-gray-50"
                  v-for="lesson in course.modules[0].lessons" :key="lesson.id"
                  @click="selectLesson(lesson)">

                <a  @click="updateVideoUrl(lesson.video_url)" class="flex items-center w-full">
                  <div class="flex justify-center items-center mr-5 ml-1 min-w-[2.25rem] min-h-[2.25rem] rounded-full bg-gray-100">
                    Icon
                  </div>
                  <div class="flex-grow min-w-0">
                    <h2 class="leading-snug truncate text-ellipsis text-sm">
                      {{lesson.title}}
                    </h2>
                  </div>
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

  </div>

</template>

<script>

import {Disclosure, DisclosureButton, DisclosurePanel} from "@headlessui/vue";
import {ref} from "vue";

export default {
  components: { Disclosure, DisclosureButton, DisclosurePanel},
  name: 'ModuleAndLesson',
  props: {
    course: Object,
  },
  emits: ["update-video-url", "update-module", "lesson-selected"],

  setup() {
    const showModule = ref('0')
    const modulesState = {};

    const toggleModule = (moduleId) => {

      if (modulesState[moduleId] && modulesState[moduleId].open) {
        modulesState[moduleId].open = false;
      } else {
        Object.keys(modulesState).forEach((id) => {
          modulesState[id].open = false;
        });
        modulesState[moduleId] = { open: true };
      }
    };



    return {showModule, toggleModule}
  },
  methods: {
    updateVideoUrl(videoUrl) {
      this.$emit("update-video-url", videoUrl);
    },
    updateModule(moduleSelect) {
      this.$emit("update-module", moduleSelect);
    },
    selectLesson(lesson) {
      this.$emit('lesson-selected', lesson);
    },
  },

}
</script>

