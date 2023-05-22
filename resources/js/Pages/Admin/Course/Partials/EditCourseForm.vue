<template>
  <div>
    <div class="flex justify-between items-start">
      <h2 class="font-medium break-words text-lg lg:text-2xl opacity-75">{{ form.title }}</h2>

      <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">

      <FormSlideOver>
        <template #button>
          <button type="button" class="px-1 py-0.5 text-lg font-bold rounded-md text-gray-900 hover:bg-gray-200 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">

            <svg class="w-7 h-7 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
            </svg>
          </button>
        </template>

        <template #title>
          <h2> Edit Course</h2>
        </template>

        <template #form>

          <form @submit.prevent="courseUpdate">


            <div class="justify-center">
              <FormInput
                v-model="form.title"
                class="w-86 "
                required
                label="Title"
                placeholder="Module title"
                id="module-id"
                :autofocus="true"/>


              <FormDescriptionEditor
                v-model="form.description"
                class="w-86"
                label="Description"
                placeholder="Module description"
                id="module-id"
              />


              <div  class="mb-4">




              </div>

              <ButtonForm color="dark" :loading="form.processing">Update</ButtonForm>
            </div>
          </form>

        </template>
      </FormSlideOver>

        </div>
    </div>
    <p class="normal-case break-words mt-1 text-sm text-gray-600">{{ form.description }}</p>

  </div>
</template>

<script setup>
import FormInput from "@/Components/Form/FormInput.vue";
import ButtonForm from "@/Components/Button/ButtonForm.vue";
import FormSlideOver from "@/Components/Form/FormSlideOver.vue";
import FormDescriptionEditor from "@/Components/Form/FormDescriptionEditor.vue";
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
  course:Object,
});
const form = useForm({
  id: props.course.id,
  title: props.course.title,
  description: props.course.description,
  thumbnail: props.course.thumbnail,
});

const courseUpdate = () => {
  form.put(route('course.update', {
    course: props.course.id
    }),{
      onError: (error) => {
        console.error(error);
      },
    }
  )
 }
</script>
