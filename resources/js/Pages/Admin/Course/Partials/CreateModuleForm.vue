<template>
  <FormSlideOver>
    <template #button>
      <slot name="button"/>
    </template>

    <template #title>
      <h2>Create Module</h2>
    </template>

    <template #form>
      <form  @submit.prevent="create">
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


          <ButtonForm color="dark" :loading="form.processing">Create</ButtonForm>
        </div>
      </form>
    </template>
  </FormSlideOver>
</template>

<script setup>

import FormDescriptionEditor from "@/Components/Form/FormDescriptionEditor.vue";
import FormSlideOver from "@/Components/Form/FormSlideOver.vue";
import ButtonForm from "@/Components/Button/ButtonForm.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
  course:Object
})

const form = useForm({
  id: props.course.id,
  title: '',
  description: '',
})

const create = () => {
  form.post(route("course.module.store", {
    course: props.course.id
  }), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
      this.$inertia.reload();

    },
    onError: (error) => console.error(error)
  });
}

</script>
