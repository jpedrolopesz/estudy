<template>

  <FormSlideOver>
    <template #button>

      <slot name="button"/>

    </template>

    <template #title>
      <h2> Create Course</h2>
    </template>

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


        <div class="mb-2">
          <UploadImage
            v-model="form.thumbnail"
            label="Image"
            labelIdle="Click or drag your files here..."
            accept="image/*"
          />
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
import UploadImage from "@/Components/Uploads/UploadImage.vue";
import ButtonForm from "@/Components/Button/ButtonForm.vue";
import {useForm} from "@inertiajs/inertia-vue3";


const props = defineProps({
  courses:Object,
});

const form = useForm({
  title: "",
  description: "",
  thumbnail: {type: Object}
});


function courseCreate() {
  form.post(route("course.store"), {
    preserveScroll: true,
    onError: (error) => console.log(error),
    onSuccess: () => {
      form.reset();
      this.$inertia.reload();
      isOpen.value = false;
    }
  });
}
</script>
