<template>

  <Modal>
    <template #button>
      <slot name="button"/>
    </template>

    <template #title>
      <span>{{selectedLesson.title}}</span>
    </template>

    <template #createForm>

      <form @submit.prevent="submit" class="m-4">

        <FormInput
          placeholder="Write a title"
          v-model="form.title"
          label="Title"
        />
        <FormDescriptionEditor
          placeholder="Leave your message"
          v-model="form.comment"
          label="Comment"
        />


        <ButtonForm color="dark" :loading="form.processing">Seed mensage</ButtonForm>
      </form>
    </template>
  </Modal>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import FormInput from "@/Components/Form/FormInput.vue";
import {defineProps} from  "vue";
import {Inertia} from "@inertiajs/inertia";
import FormDescriptionEditor from "@/Components/Form/FormDescriptionEditor.vue";
import ButtonForm from "@/Components/Button/ButtonForm.vue";

const props = defineProps({
  selectedLesson:Object
})

const {auth} = usePage().props.value

const form = useForm({
  title: '',
  comment: ''
})

const submit = () => {
  form.post(route('comments.store',{
    lesson_id: props.selectedLesson.id,
    user_id: auth.user.id
  },{
    preserveScroll: true,
    onSuccess: () => Inertia.reload(),
    onFinish: () => form.reset('title', 'comment'),

  }))
}
</script>
