<template>

  <FormSlideOver >
    <template #button> <slot name="button"/> </template>

    <template #title> <h2> Create Course</h2> </template>

    <template #form>
      <form @submit.prevent="courseCreate" >
        <div class="mb-2">
          <FormInput
            required
            label="Title"
            placeholder="Title course"
            id="course-tile"
            :autofocus="true"
            v-model="form.title"
            :error="form.errors?.title"
          />
          <InputError class="mt-2" :message="form.errors.title" />
        </div>

        <div class="mb-2">
          <FormDescriptionEditor
            label="Description"
            placeholder="Enter short project description"
            v-model="form.description"
            :error="form.errors.description"
          />
          <InputError class="mt-2" :message="form.errors.description" />
        </div>


        <div class="col-span-full">
          <label for="thumbnail" class="block text-sm font-medium leading-6 text-gray-900">Thumbnail</label>
            <div class="flex items-center justify-center w-full">
              <label for="dropzone-file" class="flex flex-col items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                <div v-if="!imagePreview" class="flex flex-col items-center justify-center ">
                   <CloudArrowUpIcon class="w-10 h-10 mb-1 text-gray-400"/>
                  <p class="mb-2 text-sm text-gray-500">
                    <span class="font-semibold"
                          type="button" @click.prevent="selectNewImage">
                      Click to upload
                    </span> or drag and drop</p>
                  <p class="text-xs text-gray-500 mb-1">PNG or JPG (MAX. 800x400px)</p>
                </div>
                <input type="file" ref="imageInputRef" @change="updateImagePreview" class="sr-only"/>

                <div v-if="imagePreview" class="flex hover:opacity-80 flex-col items-center justify-center w-full max-w-4xl mx-auto grid grid-cols-1 ">
                  <div class="relative  p-3 col-start-2 row-start-5 flex flex-col-reverse rounded-lg bg-gradient-to-t from-gray-500/95 via-gray-500/80  ">
                    <button type="button"  @click.prevent="selectNewImage" class="flex px-1.5 py-1.5 bg-gray-50 text-sm font-bold rounded-md text-gray-400 border border-gray-300 hover:bg-gray-200 hover:text-gray-500">
                      <ArrowPathRoundedSquareIcon class="w-5 h-5 mr-2"/>
                      Image Change
                    </button>
                  </div>
                  <div class="grid  gap-4 col-start-1 col-end-3 row-start-1 sm:mb-6 sm:grid-cols-4 lg:gap-6 lg:col-start-2 lg:row-end-6 lg:row-span-6 lg:mb-0">
                    <img :src="imagePreview" alt="" class="w-full h-60 mr-16 rounded-lg lg:col-span-full  " >
                  </div>

                </div>
              </label>

            </div>
          <InputError class="mt-2" :message="form.errors.thumbnail" />

        </div>
        <div class="pt-6 w-80 ml-14">
          <ButtonForm color="dark" :loading="form.processing">Create Project</ButtonForm>
        </div>
      </form>
    </template>
  </FormSlideOver>
</template>

<script setup>
import FormSlideOver from "@/Components/Form/FormSlideOver.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import FormDescriptionEditor from "@/Components/Form/FormDescriptionEditor.vue";
import InputError from "@/Components/InputError.vue";
import { CloudArrowUpIcon, ArrowPathRoundedSquareIcon } from '@heroicons/vue/24/outline'
import ButtonForm from "@/Components/Button/ButtonForm.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {ref} from "vue";


const props = defineProps({
  courses:Object,
});

const form = useForm({
  title: "",
  description: "",
  thumbnail: {type: Object}
});

const imageInputRef = ref(null);
const selectNewImage = () => {
  imageInputRef.value.click();
};
const updateImagePreview = () => {
  const reader = new FileReader();
  reader.onload = (e) => {
    imagePreview.value = e.target.result;
  };
  reader.readAsDataURL(
    form.thumbnail = imageInputRef.value.files[0]);
};
const imagePreview = ref(null);

function courseCreate() {
  form.post(route("course.store"), {
    preserveScroll: true,
    onError: (error) => console.log(error),
    onSuccess: () => {
      form.reset();
    }
  });
}
</script>
