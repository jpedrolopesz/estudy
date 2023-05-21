<template>
  <AdminLayout>
    <div>
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <div class="w-full ">
            <div class="sm:flex sm:items-center mx-4 sm:justify-between">

             <EditModuleForm :course="course" :module="module" />

            </div>
          </div>
        </div>
        <div class="mt-1 ml-4 md:col-span-2 md:mt-0">
          <form @submit.prevent="lessonUpdate">
            <div class=" shadow-lg sm:overflow-hidden rounded-t-md sm:rounded-b-md">
              <div class="space-y-6 bg-white ">
                <div class="grid gap-2 overflow-y-auto lg:h-[calc(90vh-84px)] ">
                  <div class="max-w-7xl max-h-screen h-auto justify-items-start bg-gray-50 border border-gray-300 rounded-md transition-all duration-200 ">
                    <PlayVideo :course="course" />
                  </div>
                  <div class="mx-2 px-4 py-5 sm:p-6">
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

              <div class="flex items-center  justify-between bg-gray-50 px-4 py-3 text-right sm:px-6">

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
import { useForm, Link} from "@inertiajs/inertia-vue3";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
  course:Object,
  module:Object,
  lesson:Object,
});

const form = useForm({
  title: props.lesson.title,
  description: props.lesson.description,
});

const lessonUpdate = () => {
  form.put(route('course.module.lesson.update', {
    course: props.course.id,
    module: props.module.id,
    lesson: props.lesson.id
  }), );
};
</script>


<style>
.video-js {
  background-color: transparent;
}

</style>
