<template>

  <main>
    <div  class="flex px-8 mx-auto my-6 max-w-7xl xl:px-5">
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
import Navigation from "../Partials/Navigation.vue";
import HeaderForm from "../Partials/HeaderForm.vue";
</script>
