<template>

  <FormSlideOver>

    <template #button>
      <button type="button" class="px-1.5 py-1 bg-gray-50 text-lg font-bold rounded-md text-gray-400 border border-slate-300 hover:bg-gray-200 hover:text-gray-500">
        <svg  class="w-4 h-4 fill-current" viewBox="0 0 16 16">
          <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
        </svg>
      </button>
    </template>

    <template #title>
      <h2> Edit Module</h2>
    </template>

    <template #form>

      <form  @submit.prevent="update">

        <div class="justify-center">
          <FormInput
            v-model="form.title"
            class="w-86 "
            required
            label="Title"
            placeholder="Module title"
            :autofocus="true"/>


          <FormDescriptionEditor
            v-model="form.description"
            class="w-86 "
            label="Description"
            placeholder="Module description"
          />

          <ButtonForm color="dark" :loading="form.processing">Create</ButtonForm>
        </div>
      </form>

    </template>

  </FormSlideOver>


</template>



<script>


import {defineComponent} from "vue";
import FormSlideOver from "@/Components/Form/FormSlideOver.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import FormDescriptionEditor from "@/Components/Form/FormDescriptionEditor.vue";
import ButtonForm from "@/Components/Button/ButtonForm.vue";
import {useForm} from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    ButtonForm, FormDescriptionEditor, FormInput, FormSlideOver
  },
  props: {
    course:Object
  },
  setup(props) {
    const form = useForm({
      id: props.course.id,
      title: props.course.modules.title,
      description: props.course.modules.description,
    })
    return {form}
  }
})
</script>
