<template>

  <Head  title="User Create" />

  <AuthenticatedLayout>



      <div>
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1">

            <div class="w-full ">
              <div class="sm:flex sm:items-center mx-8 sm:justify-between">
                <div class="min-w-0 flex-1">

                  <div class="mb-2">
                    <h1 class="font-medium text-2xl lg:text-3xl opacity-75">User</h1>
                  </div>
                  <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">

                    <nav class="flex mb-2" aria-label="Breadcrumb">
                      <ul class="inline-flex flex-wrap text-sm font-medium">
                        <li class="after:content-['/'] last:after:hidden after:text-slate-400 after:px-2">
                          <BreadcrumbLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Home
                          </BreadcrumbLink>
                        </li>
                        <li class="after:content-['/'] last:after:hidden after:text-slate-400 after:px-2">
                          <BreadcrumbLink  :active="route().current('users.index')">
                            Users
                          </BreadcrumbLink>
                        </li>
                        <li class="after:content-['/'] last:after:hidden after:text-slate-400 after:px-2">
                          <BreadcrumbLink  :active="route().current('users.create')">
                            Create
                          </BreadcrumbLink>
                        </li>
                      </ul>
                    </nav>
                  </div>
                  <p class="mt-1 text-sm text-gray-600">This information will be displayed publicly so be careful what you share.</p>

                </div>

              </div>
            </div>

          </div>

          <div class="mt-5 md:col-span-2 md:mt-0">
            <form @submit.prevent="submit">
              <div class="shadow-lg sm:overflow-hidden sm:rounded-md">
                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                  <div>
                    <label class="block text-sm font-medium text-gray-700">Photo</label>

                    <div class=" flex items-center">
                      <label for="image"  value="Image"/>
                      <input type="file" class="hidden" ref="photo" @change="updatePhotoPreview"/>

                      <div class="mt-2" v-show="!photoPreview">
                        <img :src="currentImage()" class="rounded-full h-14 w-14 object-cover"/>
                      </div>

                      <div class="mt-2" v-show="photoPreview">
                        <span class="block rounded-full w-14 h-14" :style="
                          'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                          photoPreview +'\');'">
                        </span>
                      </div>
                      <InputError :message="form.errors.image"></InputError>
                      <button class="ml-2 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                              type="button" @click.prevent="selectNewPhoto">
                        Select a New Photo
                      </button>
                    </div>

                  </div>

                  <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-2">
                          <label for="name" class="block text-sm font-medium text-gray-700">First name</label>
                          <input v-model="form.first_name" type="text" name="name" id="name" autocomplete="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                          <InputError class="mt-2" :message="form.errors.first_name" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                          <label for="name" class="block text-sm font-medium text-gray-700">Last name</label>
                          <input v-model="form.last_name" type="text" name="name" id="name" autocomplete="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                          <InputError class="mt-2" :message="form.errors.last_name" />
                        </div>

                        <div class="col-span-6 sm:col-span-1">
                          <label for="role" class="block text-sm font-medium text-gray-700">Owner</label>
                          <select v-model="form.owner" name="role" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <option :value="false">No</option>
                            <option :value="true">Yes</option>

                          </select>
                          <InputError class="mt-2" :message="form.errors.owner" />
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                          <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                          <input v-model="form.email" type="text" name="email" id="email" autocomplete="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                          <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="col-span-6">
                          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                          <input v-model="form.password" type="password" name="password" id="password"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                          <InputError class="mt-2" :message="form.errors.password" />
                        </div>


                      </div>

                </div>
                <div class="flex justify-between bg-gray-50 px-4 py-3 text-right sm:px-6">
                  <div>
                    <Link :href="route('users.index')" type="button" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                      </svg>
                      Previous
                    </Link>
                  </div>
                  <div>
                    <button  type="submit" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                      Create
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>





  </AuthenticatedLayout>

</template>


<script>

import AuthenticatedLayout from "../Layouts/AdminLayout.vue";
import BreadcrumbLink from "@/Components/BreadcrumbLink.vue";
import FormSearch from "@/Components/FormSearch.vue";
import { useForm, Link, Head } from '@inertiajs/inertia-vue3'
import InputError from "@/Components/InputError.vue";

export default {
  components: {
    InputError,
    AuthenticatedLayout,
    BreadcrumbLink,
    FormSearch,
    Link,
    Head
  },
  setup(){
      const form = useForm({
        image: null,
        first_name: null,
        last_name: null,
        owner: false,
        email: null,
        password: null,

      });
      return {form};
    },
  props:{
    user:Object
  },
  data() {
    return {
      photoPreview: null,
    };
  },
    methods: {
      submit() {
        if (this.$refs.photo) {
          this.form.image = this.$refs.photo.files[0];
        }
        this.form.post(route("users.store"));
      },
      resetForm() {
        this.form.clearErrors();
        this.form.reset();
      },
      currentImage() {
        return "/storage/user/default.png";
      },
      selectNewPhoto() {
        this.$refs.photo.click();
      },
      updatePhotoPreview() {
        const reader = new FileReader();
        reader.onload = (e) => {
          this.photoPreview = e.target.result;
        };
        reader.readAsDataURL(this.$refs.photo.files[0]);
      },
    }

}
</script>
