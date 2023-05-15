<template>
  <div class="relative"  >

    <div @click="open = ! open">
      <slot name="trigger" />
      aqui
    </div>

    <!-- Full Screen Dropdown Overlay -->
    <div v-show="open" @click="open = false">

    </div>

    <transition :show="isOpen"
      enter-active-class="transition ease-out duration-200"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95">
      <div v-show="open"
           @close="closeModal"
           class="absolute z-50 mt-2 bg-white rounded-md shadow-lg"
           :class="[alignmentClasses]"
           style="display: none;"
           >
        <div class="rounded-md w-96 p-4 ring-1 ring-black ring-opacity-5">
          <slot name="content" />
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';

const props = defineProps({
  align: {
    default: 'right'
  },
});

const closeOnEscape = (e) => {
  if (open.value && e.key === 'Escape') {
    open.value = false;
  }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));


const isOpen = ref(false)

function closeModal() {
  isOpen.value = false
}
function openModal() {
  isOpen.value = true
}

const alignmentClasses = computed(() => {
  if (props.align === 'left') {
    return 'origin-top-left left-0';
  } else if (props.align === 'right') {
    return 'origin-top-right right-0';
  } else {
    return 'origin-top';
  }
});

const open = ref(false);
</script>
