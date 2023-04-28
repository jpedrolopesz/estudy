<template>
  <div>
    <h1>Create Lesson</h1>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" v-model="form.title">
      </div>
      <div class="form-group">
        <label for="content">Content:</label>
        <textarea class="form-control" id="content" v-model="form.content"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Create Lesson</button>
    </form>
  </div>

  <div v-for="lesson in lessons" :key="lesson.id">
    {{lesson.title}}
  </div>
</template>

<script>
import { reactive } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

export default {
  props: {
    lessons: Object
  },
  setup(props) {
    const { post, processing, errors } = useForm({
      title: '',
      content: '',
    });

    const form = reactive({
      title: '',
      content: '',
    });

    function submitForm() {
      post(route('lesson.store', [this.params.course.id, this.params.module.id]), form);
    }

    return { form, submitForm, processing, errors };
  },
};

</script>
