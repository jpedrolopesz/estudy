<template>
  <Head title="Create" />

  <AdminLayout>
    <div>
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">

          <div class="w-full mx-2">
            <div class="flex items-center justify-between">
              <h2 class="capitalize font-medium text-2xl opacity-75">{{ props.module.title }}</h2>

              <EditModuleForm :course="course" :module="module" />

            </div>
            <p class="normal-case font-medium text-sm text-gray-600 mt-2 opacity-75">{{ props.module.description }}</p>

          </div>

        </div>


        <div class="mt-1 md:col-span-2 md:mt-0">
          <form @submit.prevent="submit">
          <div class=" shadow-lg sm:overflow-hidden rounded-t-md sm:rounded-b-md">

            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
              <div class="grid gap-2 overflow-y-auto lg:h-[calc(80vh-54px)] ">
                <div class="mx-2">

                  <label  class="form-label !pt-1 block mb-2 text-sm font-medium text-gray-900">
                    Video
                  </label>
                  <div class="bg-gray-50 mx-auto rounded-md w-full">

                    <div class="flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                      <div class="text-center">
                        <FilmIcon class="mx-auto h-12 w-12 text-gray-300" aria-hidden="true" />
                        <div class="mt-4 flex text-sm leading-6 text-gray-600">
                          <label for="file-upload" class="relative px-1 cursor-pointer rounded-md bg-transparent border font-semibold text-gray-900 focus-within:outline-none focus-within:ring-2 focus-within:ring-gray-600 focus-within:ring-offset-2 hover:text-gray-500">
                            <span>Upload a file</span>
                            <input id="file-upload" name="file-upload" type="file" class="sr-only"
                                   @input="form.video_url = $event.target.files[0]" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                              {{ form.progress.percentage }}%
                            </progress>
                          </label>
                          <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs leading-5 text-gray-600">MP4 up to 5GB</p>
                      </div>



                    </div>



                  </div>

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
import { useForm, Link, Head} from "@inertiajs/inertia-vue3";
import FormDescriptionEditor from "@/Components/Form/FormDescriptionEditor.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import ButtonForm from "@/Components/Button/ButtonForm.vue";
import EditModuleForm from "@/Pages/Admin/Course/Partials/EditModuleForm.vue";
import InputError from "@/Components/InputError.vue";
import { FilmIcon } from '@heroicons/vue/24/outline';



  const props = defineProps({
    course:Object,
    module:Object
  })
  const form = useForm({
    title: null,
    video_url: null,
    description: null,
    progress: null,
    course_id: props.course.id,
    module_id: props.module.id
  })

function submit() {
  form.post(`/admin/course/${props.course.id}/module/${props.module}/lesson`, {
    onSuccess: () => form.reset(),
    onProgress: ({ total, loaded }) => {
      const percentage = Math.round((loaded / total) * 100);
      form.progress = { total, loaded, percentage };
    },
  });

}

</script>
