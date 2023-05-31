<template>
    <div>
      <div class="flex justify-end  rounded-t-lg   px-4 p-1 sm:px-6 md:px-5 ">

        <div class="flex ">
          <slot/>
        </div>
        <!-- Close button -->
        <button
          class="md:hidden text-gray-400 hover:text-gray-500  px-2 py-0.5 rounded-md border border-gray-200 hover:border-gray-400 "
          @click.stop="$emit('toggle-msgsidebar')"
          aria-controls="messages-sidebar"
          :aria-expanded="msgSidebarOpen"
        >
          <span class="sr-only">Close sidebar</span>
          <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
          </svg>
        </button>



      </div>
    </div>
</template>

<script>
export default {
  name: 'CourseHeader',
  props: ['msgSidebarOpen'],
}
</script>
