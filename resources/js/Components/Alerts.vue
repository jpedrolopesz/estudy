<!-- Success -->
<template>
  <div v-if="$page.props.flash.success"
    class="px-4 py-2 rounded-sm text-sm bg-emerald-100 border border-emerald-200 text-emerald-600">
    <div class="flex w-full justify-between items-start">
      <div class="flex">
        <svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3" viewBox="0 0 16 16">
          <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zM7 11.4L3.6 8 5 6.6l2 2 4-4L12.4 6 7 11.4z" />
        </svg>
        <div>{{$page.props.flash.success}}</div>
      </div>
      <button class="opacity-70 hover:opacity-80 ml-3 mt-[3px]" @click="open = false">
        <div class="sr-only">Close</div>
        <svg class="w-4 h-4 fill-current">
          <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
        </svg>
      </button>
    </div>
  </div>
  <div v-if="$page.props.flash.alert"
       class="px-4 py-2 rounded-sm text-sm bg-emerald-100 border border-emerald-200 text-emerald-600">
    <div class="flex w-full justify-between items-start">
      <div class="flex">
        <svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3" viewBox="0 0 16 16">
          <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zM7 11.4L3.6 8 5 6.6l2 2 4-4L12.4 6 7 11.4z" />
        </svg>
        <div>{{$page.props.flash.alert}}</div>
      </div>
      <button class="opacity-70 hover:opacity-80 ml-3 mt-[3px]" @click="open = false">
        <div class="sr-only">Close</div>
        <svg class="w-4 h-4 fill-current">
          <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
        </svg>
      </button>
    </div>
  </div>

</template>

