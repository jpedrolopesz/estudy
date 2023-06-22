<template>

  <Modal>
    <template #button>
      <slot name="button"/>
    </template>

    <template #title>
      Escrever comentario
    </template>

    <template #createForm>
      {{selectedLesson.title}}

      <form @submit.prevent="submit">

        <FormInput
          v-model="form.title"
          label="Title"
        />
        <FormInput
          v-model="form.comment"
          label="Comment"
        />


        <button type="submit">AQUI</button>
      </form>
    </template>
  </Modal>
</template>

<script setup>
import Modal from "@/Components/Modal.vue";
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import FormInput from "@/Components/Form/FormInput.vue";
import {defineProps} from  "vue";

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
  }))
}
</script>
