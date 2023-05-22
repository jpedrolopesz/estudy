<template>
  <div>
    <div class="flex justify-between items-center">
      <FormSlideOver>
        <template #button>
          <button type="button" class="px-1 py-0.5 text-lg font-bold rounded-md text-gray-900 hover:bg-gray-200 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">

            <svg class="w-7 h-7 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
            </svg>
          </button>
        </template>

        <template #title>
          <h2>Edit Module</h2>
        </template>

        <template #form>

          <form @submit.prevent="moduleUpdate">


            <div class="justify-center">
              <div class="mb-2">
                <FormInput
                  v-model="form.title"
                  class="w-86 "
                  required
                  label="Title"
                  placeholder="Module title"
                  :autofocus="true"
                />
                <InputError class="mt-2" :message="form.errors.title" />
              </div>


              <div class="mb-2">
                <FormDescriptionEditor
                  v-model="form.description"
                  class="w-86 "
                  label="Description"
                  placeholder="Module description"
                />
                <InputError class="mt-2" :message="form.errors.description" />
              </div>



              <ButtonForm color="dark" :loading="form.processing">Update</ButtonForm>
            </div>
          </form>

        </template>
      </FormSlideOver>
    </div>
  </div>
</template>


<script setup>
import FormSlideOver from "@/Components/Form/FormSlideOver.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import FormDescriptionEditor from "@/Components/Form/FormDescriptionEditor.vue";
import ButtonForm from "@/Components/Button/ButtonForm.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";


const props = defineProps({
    course: Object,
    module: Object,
  })

    const form = useForm({
      title: props.module.title,
      description: props.module.description,
    });

    const moduleUpdate = () => {
      form.put(route('course.module.update', {
        course: props.course.id,
        module: props.module.id,
      }), );
}
</script>
