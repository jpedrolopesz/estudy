<template>

  <main>
    <div class="flex mt-4">
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
