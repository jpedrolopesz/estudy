<template>

  <main>
    <div  class="flex px-4  max-w-7xl xl:px-5">
      <Navigation/>
      <HeaderForm>
        <main >
          <slot/>
        </main>
      </HeaderForm>
    </div>
  </main>
</template>


<script setup>
import Navigation from "./Navigation.vue";
import HeaderForm from "./HeaderForm.vue";
</script>
