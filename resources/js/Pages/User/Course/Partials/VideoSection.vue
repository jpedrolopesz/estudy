<template>
  <div>
    <div class="bg-gray-200 mx-auto rounded-md transition-all duration-200 w-full">
      <VideoPlayer
        class="w-full h-[calc(80vh-64px)] video-player vjs-big-play-centered"
        v-bind:src="'/storage/videos/' + videoUrl"

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
    <div>



    </div>.
  </div>
</template>

<script setup lang="ts">

import { shallowRef } from 'vue'
import { VideoPlayer } from '@videojs-player/vue'
import 'video.js/dist/video-js.css'

const props = defineProps({
  course:Object,
  videoUrl: String,

  label: { type: String, default: ""}


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

