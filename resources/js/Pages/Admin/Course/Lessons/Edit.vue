<template>
  <Head title="Edit" />

  <AdminLayout>
    <div>
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <div class="w-full mx-2 ">
            <div class="flex items-center justify-between">

              <h2 class="capitalize font-medium text-2xl opacity-75">{{ props.module.title }}</h2>
              <EditModuleForm :course="course" :module="module"/>
            </div>
            <p class="normal-case font-medium text-sm text-gray-600 mt-2 opacity-75">{{ props.module.description }}</p>
          </div>
        </div>
        <div class="mt-1  md:col-span-2 md:mt-0">
          <form @submit.prevent="lessonUpdate">
            <div class="shadow-lg sm:overflow-hidden rounded-t-md sm:rounded-b-md">
              <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                <div class="grid gap-2 overflow-y-auto lg:h-[calc(84vh-78px)] ">

                  <div class="mx-2">
                    <div class="flex justify-between items-center mb-2">
                      <label  class="form-label !pt-1 block text-sm font-medium text-gray-900">
                        Video
                      </label>
                      <button type="button" class="flex px-1.5 py-1.5 bg-gray-50 text-sm font-bold rounded-md text-gray-400 border border-gray-300 hover:bg-gray-200 hover:text-gray-500">
                        <ArrowPathRoundedSquareIcon class="w-5 h-5 mr-2"/>
                        <input type="file"  @change="handleVideoChange" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                          {{ form.progress.percentage }}%
                        </progress>
                        Video Change
                      </button>
                    </div>

                    <PlayVideo :course="course"/>

                    <div>

                      <div class="mb-2">
                        <FormInput
                          v-model="form.title"
                          label="Title"
                          placeholder="Lesson title"
                          type="text"
                        />
                        <InputError class="mt-2" :message="form.errors.title" />
                      </div>

                      <div class="mb-2">
                        <FormDescriptionEditor
                          v-model="form.description"
                          label="Description"
                          placeholder="Lesson description"
                          type="text"
                        />
                        <InputError class="mt-2" :message="form.errors.description" />
                      </div>


                    </div>
                  </div>
                </div>
              </div>

              <div class="flex items-center justify-between bg-gray-50 px-4 py-1 text-right sm:px-6">

                <div>
                  <Link :href="route('course.edit', this.course)" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                    </svg>

                    Previous
                  </Link>
                </div>

                <div>
                  <ButtonForm color="dark" type="submit">Submit</ButtonForm>
                </div>

              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>


<script setup>

import AdminLayout from "@/Pages/Admin/Layouts/AdminLayout.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import ButtonForm from "@/Components/Button/ButtonForm.vue";
import PlayVideo from "@/Pages/Admin/Course/Lessons/Partials/PlayVideo.vue";
import EditModuleForm from "@/Pages/Admin/Course/Partials/EditModuleForm.vue";
import FormDescriptionEditor from "@/Components/Form/FormDescriptionEditor.vue";
import { useForm, Link, Head} from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";
import { ArrowPathRoundedSquareIcon } from '@heroicons/vue/24/outline';


const props = defineProps({
  course:Object,
  module:Object,
  lesson:Object,
});

const form = useForm({
  title: props.lesson.title,
  description: props.lesson.description,
  video_url: props.lesson.video_url,
});

const handleVideoChange = (event) => {
  form.video_url = URL.createObjectURL(event.target.files[0]);
};

const lessonUpdate = () => {
  form.put(route('course.module.lesson.update', {
    course: props.course.id,
    module: props.module.id,
    lesson: props.lesson.id
  }),

  )
};
</script>


<style>
.video-js {
  background-color: transparent;
}

</style>
