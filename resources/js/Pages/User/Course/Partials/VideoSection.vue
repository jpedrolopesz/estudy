<template>
  <div>
    <div class="bg-gray-200 mx-auto rounded-md transition-all duration-200 w-full">
      <div class="relative">
        <div>
          <iframe :src="videoUrl" class="w-full h-[calc(80vh-64px)] rounded-md" allow="accelerometer; clipboard-write; picture-in-picture"></iframe>
        </div>
      </div>
    </div>
    <div>


    </div>
  </div>
</template>

<script>
export default {
  name: 'VideoSection',
  props: {
    videoUrl: String,
    course: Object,
  },
}
</script>
