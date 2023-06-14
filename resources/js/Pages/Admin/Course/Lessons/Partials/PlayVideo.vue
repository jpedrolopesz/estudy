<template>
  <div class="max-w-7xl max-h-screen justify-items-start bg-gray-50 border border-gray-300 rounded-md">
    <VideoPlayer
      class="w-full h-[calc(50vh-54px)] video-player vjs-big-play-centered"
      :src="'/storage/' + lesson.video_url"
      poster="https://vjs.zencdn.net/v/oceans.png"
      crossorigin="anonymous"
      playsinline
      controls
      :volume="0.6"
      :height="320"
      :playback-rates="[0.7, 1.0, 1.5, 2.0]"
      @mounted="handleMounted"
      @loadedmetadata="handleLoadedMetadata"
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

<script lang="ts">
import { defineComponent, shallowRef } from 'vue'
import { VideoJsPlayer } from 'video.js'
import { VideoPlayer } from '@videojs-player/vue'

import 'video.js/dist/video-js.css'

export default defineComponent({
  components: {
    VideoPlayer
  },
  props: {
    lesson: Object,
    label: { type: String, default: "" }
  },
  setup() {
    const player = shallowRef<VideoJsPlayer>()
    const handleMounted = (payload: any) => {
      player.value = payload.player
    }

    const handleEvent = (log: any) => {}

    const handleLoadedMetadata = () => {
      const durationInSeconds = player.value?.duration()
      console.log('Video duration:', convertTime(durationInSeconds))
    }

    const convertTime = (timeInSeconds: number) => {
      const hours = Math.floor(timeInSeconds / 3600)
      const minutes = Math.floor((timeInSeconds % 3600) / 60)
      const seconds = Math.floor(timeInSeconds % 60)

      const formattedHours = String(hours).padStart(2, '0')
      const formattedMinutes = String(minutes).padStart(2, '0')
      const formattedSeconds = String(seconds).padStart(2, '0')

      return `${formattedHours}:${formattedMinutes}:${formattedSeconds}`
    }

    return { player, handleMounted, handleEvent, handleLoadedMetadata, convertTime }
  }
})
</script>
