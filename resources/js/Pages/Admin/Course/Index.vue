<template>
  <Head title="Courses" />

  <AdminLayout>


    <div class="bg-white ml-2 shadow-lg rounded-md border border-slate-200 relative">
      <header class="px-4 py-4 flex items-center justify-between">
        <h2 class="text-xs font-semibold uppercase text-slate-500">All Courses <span class="text-slate-400 font-medium"> {{meta.total}} </span></h2>

        <div class="flex items-center">

          <Modal >
            <template #button>
              <button type="button" class="text-slate-500 bg-gray-100 hover:bg-gray-200 font-medium rounded-md text-sm px-4 py-1.5 text-center inline-flex items-center ">

                <svg class="w-5 h-5 mr-2 -ml-1 text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Course
              </button>
            </template>


            <template #title>
              <h2> Create Course</h2>
            </template>

            <template #createForm>

              <form @submit.prevent="submit" >

                <div class="mb-4">
                  <FormInput
                    required
                    label="Title"
                    placeholder="Title course"
                    id="course-tile"
                    :autofocus="true"
                    v-model="form.title"
                    :error="form.errors?.title"/>
                  <InputError class="mt-2" :message="form.errors.title" />
                </div>

                <div class="mb-4">
                  <FormDescriptionEditor

                    label="Description"
                    placeholder="Enter short project description"
                    v-model="form.description"
                    :error="form.errors?.description"
                  />
                  <InputError class="mt-2" :message="form.errors.description" />
                </div>


                <div  class="mb-4">


                  <UploadImage
                    v-model="form.thumbnail"
                     accept="image/*"

                  />

                </div>




                <FormListBox
                label="Teachers">

                  <ul>
                    <li v-for="user in users.data" :key="user.name">
                      <label
                        :class="{'bg-dark-100':user.id}"
                        class="flex  border-b text-sm w-full hover:bg-gray-100 justify-between items-center px-2 py-1 cursor-pointer">
                        <span>{{ user.name }}</span>

                        <input
                          :id="user.id"
                          class="rounded-full appearance-none checked:bg-primary-600 text-primary-600 focus:ring-primary-600 h-5 w-5"
                          :value="user.id"
                          v-model="form.members"
                          type="checkbox" />
                      </label>

                    </li>
                  </ul>


                </FormListBox>





                <div class="pt-6 w-80 ml-14">
                  <ButtonForm color="dark" :loading="form.processing">Create Project</ButtonForm>
                </div>
              </form>
            </template>
          </Modal>


          <div class="ml-3 mt-1 relative">
            <Dropdown align="right" width="48">
              <template #trigger>
                <button type="button" class=" px-1 py-0.5 text-lg font-bold rounded-md text-gray-900 hover:bg-gray-200 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                  </svg>
                </button>
              </template>
              <template  #content>
                <div class="pt-0.5 pb-2 px-3 mb-1 border-b border-slate-200">
                  zz

                </div>

              </template>
            </Dropdown>
          </div>
        </div>
      </header>


      <div>

        <!-- Table -->
        <div class="overflow-x-auto  ">
          <table class="table-auto w-full">
            <!-- Table header -->
            <thead class="text-xs py-2.5 font-semibold uppercase text-slate-500 bg-slate-50 border-t border-b">
            <tr>
              <th class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Courses</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Price</div>
              </th>
              <th colspan="2" class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Users</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <div class="font-semibold text-left">Status</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <span class="font-semibold text-left">Action</span>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <span class="sr-only">Menu</span>
              </th>

            </tr>
            </thead>

            <!-- Table body -->
            <tbody>
            <tr
              class="text-sm "
              v-for="(course, idx) in courses.data"
              :key="course.id"
              :class="[idx === 0 ? 'border-dark-300' : 'border-gray-200', 'border-t']">

              <td class="px-2 first:pl-5 last:pr-5 py-2.5 whitespace-nowrap ">
                <div class="flex items-center">
                  <div class="w-8 h-8 shrink-0 mr-2 sm:mr-3">
                    <img v-bind:src="'/storage/thumbnails/' + course.thumbnail"  width="80" height="88" />
                  </div>

                  <div class="font-medium text-slate-800">{{course.title}}</div>
                </div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5  whitespace-nowrap">
                <div class="text-left"></div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <div class="text-left"></div>
              </td>
              <td class="px-2 first:pl-5 last:pr-5 whitespace-nowrap">
                <div class="sr-only"></div>
              </td>



              <td class="px-2 inline-flex first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div v-if="!course.deleted_at" class="bg-emerald-100 text-emerald-600 text-left rounded-full text-center px-2.5 ">Active</div>
                <div v-if="course.deleted_at" class=" bg-amber-100 text-amber-600 text-left rounded-full text-center px-2.5">Disabled</div>
              </td>

              <td class="px-2 first:pl-5 last:pr-5  whitespace-nowrap w-px">
                <div class="space-x-1 inline-flex">

                  <Link :href="route('courses.edit', course.id)"  class="text-slate-400 hover:text-slate-500 rounded-full">
                    <span class="sr-only">Edit</span>
                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                      <path d="M19.7 8.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM12.6 22H10v-2.6l6-6 2.6 2.6-6 6zm7.4-7.4L17.4 12l1.6-1.6 2.6 2.6-1.6 1.6z"></path>
                    </svg>
                  </Link>


                  <ModalDelete >

                    <div class="flex ml-2 justify-between">


                      <Link :href="route('courses.destroy', course.id)" as="button" type="button" method="DELETE"
                            class="btn bg-red-600 text-sm text-white hover:bg-red-700 ">
                        Yes, delete
                      </Link>

                    </div>
                  </ModalDelete>

                </div>
              </td>

            </tr>


            </tbody>

          </table>

          <div
            class="grid px-4 py-4 text-xs font-semibold uppercase text-slate-500 bg-slate-50 dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
          <span class="flex items-center col-span-3">
              Showing {{ meta.from }}-{{ meta.to }} of {{ meta.total }}
          </span>
            <span class="col-span-2"></span>
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            <Pagination :links="meta.links" />
          </span>
          </div>



        </div>
      </div>
    </div>



  </AdminLayout>
</template>


<script setup>
import {Link, Head, usePage, useForm} from "@inertiajs/inertia-vue3";
import ModalDelete from "@/Components/ModalDelete.vue";
import AdminLayout from "@/Pages/Admin/Layouts/AdminLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import Dropdown from "@/Components/Dropdown.vue";
import Modal from "@/Components/Modal.vue";
import ButtonForm from "@/Components/Button/ButtonForm.vue";
import UploadImage from "@/Components/Uploads/UploadImage.vue";
import InputError from "@/Components/InputError.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import FormDescriptionEditor from "@/Components/Form/FormDescriptionEditor.vue";
import FormListBox from "@/Components/Form/FormListBox.vue";
import {onMounted, ref} from "vue";

const { auth } = usePage().props;

const props = defineProps(
  {
    users: Object,
    courses: Object,
  });

const { meta } = props.courses;

const form = useForm({
  title: "",
  description: "",
  thumbnail: {type: Object}
});


defineEmits(["update:modelValue"]);

function submit() {
  form.post(route("courses.store"), {
    preserveScroll: true,
    onError: (error) => console.log(error),
    onSuccess: () => {
      form.reset();
      isOpen.value = false;
    }
  });
}
</script>
