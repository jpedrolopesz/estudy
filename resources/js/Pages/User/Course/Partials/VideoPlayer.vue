<template>

  <div class="w-full h-full bg-gray-50 flex items-stretch flex-wrap md:flex-nowrap md:pb-6 order-3 md:w-[calc(100%+150px+180px)] lg:w-[calc(100%+280px+150px)]">


    <div class="hidden lg:block transition-all duration-200 mt-2 md:mt-6 mt-12 md:relative overflow-y-scroll md:h-auto mb-3 md:mb-0 w-full md:w-[220px] lg:w-[290px] xl:w-[390px] !block md:order-1 md:mr-[350px] lg:mr-[450px]">

      <!--Modules-->

      <div class="py-6 px-3 md:px-0 pt-0 md:pr-6 md:absolute w-full h-full">
        <div class="flex items-center justify-between bg-gray-50 pb-6 sticky top-0 w-full z-30">
          <h1 class="font-medium text-slate-500 leading-none ">
            Episodes (18)
          </h1>

          <div class="flex items-center">
            <button class="p-2 mr-4 rounded-md bg-gray-200 hover:bg-gray-300">
              <i class='bx bx-left-arrow-alt nav__link'></i>
            </button>

            <button class="p-2 rounded-md bg-gray-200 hover:bg-gray-300 ">
              <i class='bx bx-right-arrow-alt nav__link'></i>
            </button>
          </div>

        </div>


        <div  v-for="module in course.modules"
              :key="module.id"
              @click.prevent="toggleModule(module.id)">

          <Disclosure v-slot="{ open }">
            <DisclosureButton :class="['modules', module.id === showModule ? 'border-slate-300' : '']"
                              class="flex justify-between items-center px-3 py-3 bg-white rounded lg:flex-grow mb-1 w-full border border-gray-100 hover:bg-gray-50 bg-gray-50">
              <span>{{ module.title}}</span>
              <i class='bx bx-chevron-down text-gray-400 bx-sm' :class="open ? 'rotate-180 transform' : ''"></i>

            </DisclosureButton>
            <DisclosurePanel class="px-2 pb-2 text-sm text-gray-500">

              <div v-show="module.id = showModule" >
                <ul

                >

                  <li class="flex justify-between items-center px-3 py-2 bg-white rounded lg:flex-grow mb-1 w-full border border-gray-100  hover:bg-gray-50"
                      v-for="lesson in course.modules[0].lessons" :key="lesson.id"

                  >

                    <a  @click="updateVideoUrl(lesson.video_url)" class="flex items-center w-full">
                      <div
                        class="flex justify-center items-center mr-5 ml-1 min-w-[2.25rem] min-h-[2.25rem] rounded-full bg-gray-100 ">

                      </div>

                      <div class="flex-grow min-w-0">
                        <h2 class=" leading-snug truncate text-ellipsis text-sm">
                          {{lesson.title}}
                        </h2>
                      </div>
                      <div class="text-xs text-dark-2  opacity-75 flex items-center ml-4"><!---->

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



    </div>


    <div class="px-0 md:px-6 md:mt-6 transition-all duration-200 mb-3 md:mb-0 flex-grow order-first w-full md:w-auto">
      <!--Video-->

      <div class="bg-slate-100 mx-auto transition-all duration-200 w-full">
        <div class="relative">
          <div>
            <iframe :src="videoUrl" class="w-full h-[calc(80vh-64px)]"  allow="accelerometer; clipboard-write; picture-in-picture"></iframe>
          </div>
        </div>
      </div>
      <div>
        description
      </div>


    </div>
  </div>

</template>


<script>


import AuthenticatedUserLayout from "@/Pages/User/Layouts/Dashboard/AuthenticatedUserLayout.vue";
import {Disclosure, DisclosureButton, DisclosurePanel} from "@headlessui/vue";
import {ref} from "vue";

export default {
  components: { AuthenticatedUserLayout, Disclosure, DisclosureButton, DisclosurePanel},
  name: 'VideoPlayer',

  props: {
    course: Object,
  },
  data() {
    return {
      videoUrl: '',
    }
  },
  setup() {
    const showModule = ref('0')
    const toggleModule = (moduleId) => showModule.value = moduleId


    return {showModule, toggleModule}
  },
  methods: {
    updateVideoUrl(videoUrl) {
      this.videoUrl = videoUrl;
    }
  }

}
</script>
