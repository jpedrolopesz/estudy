<template>
  <AdminLayout>



    <div>
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">

          <div class="w-full ">
            <div class="sm:flex sm:items-center mx-4 sm:justify-between">
              <div class="min-w-0 flex-1">

                <div class="mb-2">
                  <h1 class="font-medium text-2xl lg:text-3xl opacity-75">{{course.title}}</h1>
                </div>
                <p class="mt-1 text-sm text-gray-600">{{course.description}}</p>
              </div>

            </div>
          </div>

        </div>


        <div class="mt-1 md:col-span-2 md:mt-0">

          <div class=" shadow-lg sm:overflow-hidden rounded-t-md sm:rounded-b-md">
            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

              <div class="flex items-center justify-between">

                  <h2 class="grow font-semibold text-slate-800 truncate">Add Module</h2>
                  <FormPopover align="right" width="100">
                    <template #trigger >
                      <button type="button" class=" px-1.5 py-1 bg-gray-50 text-lg font-bold rounded-md text-gray-400 hover:bg-gray-200 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <svg  class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                          <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                        </svg>
                      </button>
                    </template>
                    <template #content>

                      <form @submit.prevent="submit">

                      <div class="justify-center">
                        <FormInput
                          v-model="form.title"
                          class="w-86 "
                          required
                          label="Title"
                          placeholder="Module title"
                          id="module-id"
                          :autofocus="true"/>


                        <FormDescriptionEditor
                          v-model="form.description"
                          class="w-86 "
                          label="Description"
                          placeholder="Module description"
                          id="module-id"
                        />

                        <ButtonForm color="dark" :loading="form.processing">Create</ButtonForm>
                      </div>
                      </form>


                    </template>
                  </FormPopover>
              </div>

              <div class="grid gap-2 overflow-y-auto h-96 ">

                <draggable
                  v-model="course.modules"
                  tag="ul"
                  itemKey="id"
                >
                  <template #item="{element: module}">
                    <div class="bg-transparent shadow-sm rounded-sm mx-4 border mb-2 border-slate-100 p-0.5">

                      <Disclosure v-slot="{ open, close }">
                        <div class="flex justify-between items-start">
                          <div class="group flex items-center w-full rounded-lg py-2 text-left text-base font-bold text-gray-900 focus:outline-none focus-visible:ring focus-visible:ring-purple-500 focus-visible:ring-opacity-75">
                            <button class="cursor-grab handle mr-4 opacity-0 group-hover:opacity-100">
                              <svg class="w-6 h-6 fill-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
                              </svg>
                            </button>
                            <DisclosureButton>
                              <svg class="h-4 w-4 text-gray-900 mr-2"
                                   :class="open ? 'rotate-90 transform' : ''"
                                   xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                              </svg>
                            </DisclosureButton>
                            <div class="font-medium text-gray-800 ml-2">{{module.id}}</div>

                            <div class="grow mx-4 ">
                              <input v-model="module.title" @click="showInput = true" class="font-medium text-gray-800 w-full ml-2"/>
                            </div>

                            <div class="justify-end space-x-3 " v-if="showInput">

                              <button class="text-slate-400 hover:text-indigo-500">
                                <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                  <path d="M19.7 8.3c-.4-.4-1-.4-1.4 0l-10 10c-.2.2-.3.4-.3.7v4c0 .6.4 1 1 1h4c.3 0 .5-.1.7-.3l10-10c.4-.4.4-1 0-1.4l-4-4zM12.6 22H10v-2.6l6-6 2.6 2.6-6 6zm7.4-7.4L17.4 12l1.6-1.6 2.6 2.6-1.6 1.6z"></path>
                                </svg>
                              </button>
                            </div>

                          </div>
                        </div>


                        <DisclosurePanel class="py-2 m-4 text-sm text-gray-500">
                          <Link :href="route('lesson.create',[course.id, module.id])">
                            <button type="button" class="bg-gray-50 font-medium text-gray-600 text-center w-full shadow-sm rounded-sm border mb-2 border-gray-100 p-1.5 hover:bg-gray-100">
                              Add lesson
                            </button>
                          </Link>

                          <draggable
                            v-model="module.lessons"
                            tag="ul"
                            group="lessons"
                            itemKey="id"
                          >
                            <template #item="{ element: lesson }">
                              <li class="shadow-sm rounded-sm border mb-2 border-slate-100 p-1.5">
                                <div class="w-full md:flex items-center justify space-y-1.5 md:space-y-0">
                                  <div class="flex-1">


                                    <div class="flex  gap-3 sm:gap-2 flex-col justify-start items-start sm:flex-row sm:items-center sm:flex-1 sm:justify-start text-black cursor-pointer text-md">
                                      <button class="cursor-grab handle mr-4 group-hover:opacity-100">
                                        <svg class="w-6 h-6 fill-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
                                        </svg>
                                      </button>

                                      <div class="grow mt-0.5 mb-3 sm:mb-0 space-y-3">

                                        <span>{{lesson.id}}:
                                          <span class="font-medium text-gray-600 ml-2">{{ lesson.title }}</span>
                                        </span>
                                      </div>
                                      <div class="flex items-center justify-end space-x-3">
                                        <button class="text-slate-400 hover:text-indigo-500">
                                          <svg class="w-4 h-4 shrink-0 fill-current mr-1.5" viewBox="0 0 16 16">
                                            <path d="M11 0c1.3 0 2.6.5 3.5 1.5 1 .9 1.5 2.2 1.5 3.5 0 1.3-.5 2.6-1.4 3.5l-1.2 1.2c-.2.2-.5.3-.7.3-.2 0-.5-.1-.7-.3-.4-.4-.4-1 0-1.4l1.1-1.2c.6-.5.9-1.3.9-2.1s-.3-1.6-.9-2.2C12 1.7 10 1.7 8.9 2.8L7.7 4c-.4.4-1 .4-1.4 0-.4-.4-.4-1 0-1.4l1.2-1.1C8.4.5 9.7 0 11 0zM8.3 12c.4-.4 1-.5 1.4-.1.4.4.4 1 0 1.4l-1.2 1.2C7.6 15.5 6.3 16 5 16c-1.3 0-2.6-.5-3.5-1.5C.5 13.6 0 12.3 0 11c0-1.3.5-2.6 1.5-3.5l1.1-1.2c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4L2.9 8.9c-.6.5-.9 1.3-.9 2.1s.3 1.6.9 2.2c1.1 1.1 3.1 1.1 4.2 0L8.3 12zm1.1-6.8c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4l-4.2 4.2c-.2.2-.5.3-.7.3-.2 0-.5-.1-.7-.3-.4-.4-.4-1 0-1.4l4.2-4.2z" />
                                          </svg>
                                        </button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </li>
                            </template>
                          </draggable>


                        </DisclosurePanel>
                      </Disclosure>
                    </div>
                  </template>
                </draggable>


              </div>



            </div>
            <div class="flex justify-between bg-gray-50 px-4 py-3 text-right sm:px-6">

              <div>
                <Link :href="route('pages.plans.show')" type="button" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                  </svg>

                  Previous
                </Link>
              </div>

              <div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>


<script>
import AdminLayout from "../Layouts/AdminLayout.vue";
import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel
} from "@headlessui/vue";

import draggable from "vuedraggable";
import FormPopover from "@/Components/Form/FormPopover.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import ButtonForm from "@/Components/Button/ButtonForm.vue";
import {useForm, Link} from "@inertiajs/inertia-vue3";
import FormDescriptionEditor from "@/Components/Form/FormDescriptionEditor.vue";

export default {
  components: {
    FormDescriptionEditor, Link,
    ButtonForm, FormInput, FormPopover, AdminLayout,
    draggable, Disclosure, DisclosureButton, DisclosurePanel
  },
  props: {
    course:Object
  },
  data() {
    return {
      showInput: false,
    }
  },
  setup(props) {
    const form = useForm({
      id: props.course.id,
      title: props.course.modules.title,
      description: props.course.modules.description,
    })
    return {form}
  },
  methods: {
    submit() {
      this.form.post(route("module.store", this.course.id), {
        preserveScroll: true,
        onError: (error) => console.log(error),
        onSuccess: () => {
          form.reset();
          isOpen.value = false;
        }
      });
      },
    updateCourse() {
      this.$inertia.put(`/courses/${this.course.id}`, {title: this.course.title})

    },
    updateModule(module) {
      this.$inertia.put(`/courses/${this.course.id}`, { title: module.title });
    }

  }

}
</script>
