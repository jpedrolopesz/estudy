<template>

  <div class="max-w-7xl max-h-screen justify-items-start bg-gray-50 border border-gray-300 rounded-md">
    <VideoPlayer
    class="w-full h-[calc(50vh-54px)] video-player vjs-big-play-centered"
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



</template>


<script setup lang="ts">

import { shallowRef } from 'vue'
import { VideoPlayer } from '@videojs-player/vue'
import 'video.js/dist/video-js.css'
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
  course:Object,
  label: { type: String, default: ""}


})
const form = useForm({
  video_url: props.course.modules[0].lessons[0].video_url
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
