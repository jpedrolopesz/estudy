<template>
    <div>
      <div class="flex ">
        <!-- Close button -->
        <button
          class="md:hidden text-gray-400 hover:text-gray-500 bg-white px-6 py-1 rounded-md border border-gray-200 hover:border-gray-400 "
          @click.stop="$emit('toggle-msgsidebar')"
          aria-controls="messages-sidebar"
          :aria-expanded="msgSidebarOpen"
        >
          <span class="sr-only">Close sidebar</span>
          <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
          </svg>
        </button>
        <!-- People list -->

      </div>

    </div>
</template>

<script>
export default {
  name: 'CourseHeader',
  props: ['msgSidebarOpen'],
}
</script>
