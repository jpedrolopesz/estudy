<template>
  <div>
    <div class=" mx-auto aspect-video rounded-md transition-all duration-200 w-full">
      <VideoPlayer
        class="w-full max-h-full lg:h-[calc(80vh-64px)] video-player vjs-big-play-centered"
        :src="videoUrl"
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
    </div>
  </div>
</template>

<script setup lang="ts">

import { shallowRef, computed } from 'vue'
import { VideoPlayer } from '@videojs-player/vue'
import 'video.js/dist/video-js.css'
import {VideoJsPlayer} from "video.js";

const props = defineProps({
  course:Object,
  selectedLesson:Object,
  label: { type: String, default: ""}


})


const videoUrl = computed(() => '/storage/' + props.selectedLesson.video_url);


const player = shallowRef<VideoJsPlayer>()

const handleMounted = (payload: any) => {
  player.value = payload.player
}

const handleEvent = (log: any) => {
}
</script>

