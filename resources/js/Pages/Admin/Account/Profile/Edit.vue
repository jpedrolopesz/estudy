<template>

  <AuthenticatedLayout>
    <AccountLayout>
      <div class="mt-5 md:col-span-2 md:mt-0">
        <form @submit.prevent="submit">
          <div class=" shadow-lg sm:overflow-hidden sm:rounded-b-md">
            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

              <div>
                <label class="block text-sm font-medium text-gray-700">Photo</label>

                <div class=" flex items-center">
                <label for="image"  value="Image"/>
                <input type="file" class="hidden" ref="photo"
                       @change="updatePhotoPreview"/>

                  <div class="mt-2" v-show="!photoPreview && $page.props.auth.user.photo">
                    <img v-bind:src="'/storage/user/' + $page.props.auth.user.photo" class="rounded-full h-14 w-14 object-cover"/>
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
                <div class="col-span-6 sm:col-span-3">
                  <label for="name" class="block text-sm font-medium text-gray-700">First name*</label>
                  <input  v-model="form.name"  type="text" name="name" id="name" autocomplete="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />

                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email address*</label>
                  <input v-model="form.email"  type="text" name="email" id="email" autocomplete="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                  <InputError class="mt-2" :message="form.errors.email" />

                </div>


                <div class="col-span-6 sm:col-span-3">
                  <label for="street-address" class="block text-sm font-medium text-gray-700">Country</label>
                  <input v-model="form.country" type="text" name="country" id="country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="street-address" class="block text-sm font-medium text-gray-700">Street address</label>
                  <input v-model="form.street_address" type="text" name="street-address" id="street-address" autocomplete="street-address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                  <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                  <input v-model="form.city" type="text" name="city" id="city" autocomplete="address-level2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                  <label for="state-province" class="block text-sm font-medium text-gray-700">State / Province</label>
                  <input v-model="form.state_province" type="text" name="state-province" id="state-province"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                  <label for="zip-code" class="block text-sm font-medium text-gray-700">ZIP / Postal code</label>
                  <input v-model="form.zip_code" type="number" name="zip-code" id="zip-code" autocomplete="postal-code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>
              </div>

            </div>
            <div class=" bg-gray-50 px-4 py-3 text-right sm:px-6">

              <div>
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                  Update
                </button>
              </div>

            </div>
          </div>
        </form>


            </div>
    </AccountLayout>
  </AuthenticatedLayout>

</template>

<script>
import AuthenticatedLayout from '../../Layouts/Dashboard/AuthenticatedLayout.vue';
import AccountLayout from "../Partials/AccountLayout.vue";
import InputError from "@/Components/InputError.vue";
import BreadcrumbLink from "@/Components/BreadcrumbLink.vue";
import FormSearch from "@/Components/FormSearch.vue";
import {Link, useForm} from "@inertiajs/inertia-vue3";


export default {
  components: {
    InputError,
    AccountLayout,
    AuthenticatedLayout,
    BreadcrumbLink,
    FormSearch,
    Link
  },
  setup( props){
    const form = useForm({
      image: props.user.image,
      name: props.user.name,
      email: props.user.email,
      country: props.user.country,
      street_address: props.user.street_address,
      state_province: props.user.state_province,
      city: props.user.city,
      zip_code: props.user.zip_code,

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
      this.form.post(route("account.profile.update"));
    },
    resetForm() {
      this.form.clearErrors();
      this.form.reset();
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
  },
}
</script>
