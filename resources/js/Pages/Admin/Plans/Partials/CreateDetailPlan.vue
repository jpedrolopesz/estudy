<template>


  <div class="bg-gray-100 rounded-md">
    <form @submit="submitDetail">

      <div class="col-span-6 sm:col-span-2">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input v-model="form.name" type="text" name="name" id="name" autocomplete="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
        <InputError class="mt-2" :message="form.name" />
      </div>


      <button  type="submit" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
        Create
      </button>

    </form>
  </div>
</template>


<script>

import {useForm} from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";

export default{
  components:{InputError},
  setup() {
    const form = useForm({
      name: null
    })
    return {form};

  },
  methods: {
    submitDetail() {
      this.form.post(route('detail.create'))
    },
  }
}
</script>
