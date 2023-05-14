<template>
  <AdminLayout>



    <div>
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">

          <div class="w-full ">
            <div class="sm:flex sm:items-center mx-4 sm:justify-between">
              <div class="min-w-10 flex-1 ml-2">
                <div class="flex  justify-between">
                  <h2 class="capitalize font-medium text-2xl opacity-75">{{ module.title }}</h2>
                  <FormPopover align="right" width="100">
                    <template #trigger >
                      <button type="button" class="px-1 py-0.5 text-lg font-bold rounded-md text-gray-900 hover:bg-gray-200 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">

                        <svg class="w-7 h-7 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                      </button>
                    </template>
                    <template #content>

                      <form @submit.prevent="submit">

                        <div class="justify-center">
                          <FormInput
                            v-model="module.title"
                            class="w-86 "
                            required
                            label="Title"
                            placeholder="Module title"
                            id="module-id"
                            :autofocus="true"/>


                          <FormDescriptionEditor
                            v-model="module.description"
                            class="w-86"
                            label="Description"
                            placeholder="Module description"
                            id="module-id"
                          />


                          <ButtonForm color="dark" :loading="form.processing">Update</ButtonForm>
                        </div>
                      </form>


                    </template>
                  </FormPopover>
                </div>
                <p class="normal-case font-medium text-sm text-gray-600 mt-2 opacity-75">{{ course.description }}</p>

              </div>


            </div>
          </div>

        </div>


        <div class="mt-1 ml-4 md:col-span-2 md:mt-0">


          <form @submit.prevent="submit">
            <div class=" shadow-lg sm:overflow-hidden rounded-t-md sm:rounded-b-md">


              <div class="space-y-6 bg-white ">

                <div class="grid gap-2 overflow-y-auto lg:h-[calc(90vh-84px)] ">
                  <div class="max-w-7xl max-h-screen h-auto justify-items-start bg-gray-50 border border-gray-300 rounded-md transition-all duration-200 ">




                    <video-player
                      class="w-full h-[calc(60vh-64px)] video-player vjs-big-play-centered"
                      :src="'/storage/videos/' + form.video_url"
                      crossorigin="anonymous"
                      playsinline
                      controls
                      :volume="0.6"
                      :height="320"
                      :playback-rates="[0.7, 1.0, 1.5, 2.0]"
                      @mounted="handleMounted"
                      @ready="handleEvent($event)"
                      @play="handleEvent($event)"
                      @pause="handleEvent($event)"
                      @ended="handleEvent($event)"
                      @loadeddata="handleEvent($event)"
                      @waiting="handleEvent($event)"
                      @playing="handleEvent($event)"
                      @canplay="handleEvent($event)"
                      @canplaythrough="handleEvent($event)"
                      @timeupdate="handleEvent(player?.currentTime())"
                    />




                  </div>
                  <div class="mx-2 px-4 py-5 sm:p-6">

                    <div>
                      <FormInput
                        v-model="form.title"
                        label="Title"
                        type="text"
                      />

                      <FormDescriptionEditor
                        label="Description"
                      />

                    </div>
                  </div>
                </div>

              </div>

              <div class="flex items-center  justify-between bg-gray-50 px-4 py-3 text-right sm:px-6">

                <div>
                  <Link :href="route('courses.edit', course)"  class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                    </svg>

                    Previous
                  </Link>
                </div>

                <div>
                  <ButtonForm color="dark" type="submit">Submit</ButtonForm>
                </div>

              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>


<script setup lang="ts">

import AdminLayout from "@/Pages/Admin/Layouts/AdminLayout.vue";
import { useForm, Link} from "@inertiajs/inertia-vue3";
import FormDescriptionEditor from "@/Components/Form/FormDescriptionEditor.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import ButtonForm from "@/Components/Button/ButtonForm.vue";
import FormPopover from "@/Components/Form/FormPopover.vue";
import { shallowRef } from 'vue'
import { VideoJsPlayer } from 'video.js'
import { VideoPlayer } from '@videojs-player/vue'
import 'video.js/dist/video-js.css'



const props = defineProps({
  course:Object,
  module:Object,
  lesson:Object,
})
const form = useForm({
  title: props.lesson.title,
  video_url: props.lesson.video_url,
  progress: null,
  module_id: props.module.id,
  course_id: props.course.id
})


const player = shallowRef<VideoJsPlayer>()

const handleMounted = (payload: any) => {
  player.value = payload.player
  console.log('Basic player mounted', payload)
}

const handleEvent = (log: any) => {
  console.log('Basic player event', log)
}


</script>


<style>
.video-js {
  background-color: transparent;
}

</style>
