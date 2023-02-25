<template>
  <div class="sticky top-16">
    <div class="flex items-center justify-between bg-white border-b border-slate-200 px-4 sm:px-6 md:px-5 h-16">

      <div class="flex">
       <slot/>
      </div>

      <div class="flex items-center">
        <!-- Close button -->
        <button
          class="md:hidden  text-slate-400 hover:text-slate-500 mr-4"
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
  </div>
</template>

<script>
export default {
  name: 'ChatHeader',
  props: ['msgSidebarOpen'],
}
</script>
