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
              <InputError class="mt-2" :message="form.errors.title" />



              <FormDescriptionEditor
                v-model="form.description"
                class="w-86"
                label="Description"
                placeholder="Module description"
                id="module-id"
              />
              <InputError class="mt-2" :message="form.errors.description" />



              <div  class="mb-4">

                <div class="col-span-full">
                  <label for="thumbnail" class="block text-sm font-medium leading-6 text-gray-900">Thumbnail</label>
                  <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                      <input type="file" ref="imageInputRef" name="thumbnail" @change="updateImagePreview" class="sr-only"/>

                      <div  class="flex hover:opacity-80 flex-col items-center justify-center w-full max-w-4xl mx-auto grid grid-cols-1 ">
                        <div class="relative  p-3 col-start-2 row-start-5 flex flex-col-reverse rounded-lg  ">
                          <button type="button"  @click.prevent="selectNewImage" class="flex px-1.5 py-1.5 bg-gray-50 text-sm font-bold rounded-md text-gray-400 border border-gray-300 hover:bg-gray-200 hover:text-gray-500">
                            <ArrowPathRoundedSquareIcon class="w-5 h-5 mr-2"/>
                            Image Change
                          </button>
                        </div>
                        <div class="grid gap-4 col-start-1 col-end-3 row-start-1 sm:mb-6 sm:grid-cols-4 lg:gap-6 lg:col-start-2 lg:row-end-6 lg:row-span-6 lg:mb-0">
                          <img  v-if="imagePreview" :src="imagePreview"  class="w-full h-60 mr-16 rounded-lg lg:col-span-full ">
                          <img v-if="!imagePreview" :src="'/storage/' + form.thumbnail"  class="w-full h-60 mr-16 rounded-lg lg:col-span-full  ">

                        </div>

                      </div>
                    </label>
                  </div>
                  <InputError class="mt-2" :message="form.errors.thumbnail" />
                </div>



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
import { ArrowPathRoundedSquareIcon } from '@heroicons/vue/24/outline';
import FormDescriptionEditor from "@/Components/Form/FormDescriptionEditor.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import { defineProps } from 'vue';
import {ref} from "vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
  course:Object,
});
const form = useForm({
  id: props.course.id,
  title: props.course.title,
  description: props.course.description,
  thumbnail: props.course.thumbnail,
});

const imageInputRef = ref(null);
const selectNewImage = () => {
  imageInputRef.value.click();
};

const updateImagePreview = () => {
  const file = imageInputRef.value.files[0];

  const reader = new FileReader();

  reader.onload = (e) => {
    imagePreview.value = e.target.result;
    form.thumbnail = file;
  };

  reader.readAsDataURL(file);
};
const imagePreview = ref(null);

const courseUpdate = () => {
  form.post(route('course.update', {
    _method: 'put',
    course: props.course.id
    }),{
      onError: (error) => {
        console.error(error);
      },
    }
  )
 }
</script>
