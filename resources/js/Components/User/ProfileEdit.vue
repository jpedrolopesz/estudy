<template>

  <Head  title="Information" />

  <div class="bg-white shadow-lg rounded-md">
    <header class="p-4 ml-2">
      <h2 class="text-lg  font-medium text-gray-900">Profile Information</h2>
      <p class=" text-sm text-gray-600">
        Update your account's profile information and email address.
      </p>
    </header>
    <form @submit.prevent="submit">
      <div>
        <div class="space-y-6 px-4 py-2 sm:p-6">

          <div>
            <label class="block text-sm font-medium text-gray-700">Photo</label>

            <div class=" flex items-center">
              <label for="image"  value="Image"/>
              <input type="file" class="hidden" ref="photo" @change="updatePhotoPreview"/>

              <div class="mt-2" v-show="!photoPreview && form.photo">
                <img :src="'/storage/user/' + form.photo" class="rounded-full h-14 w-14 object-cover"/>
              </div>

              <div class="mt-2" v-show="photoPreview">
                <span class="block rounded-full w-14 h-14" :style="
                 'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                 photoPreview +'\');'">
                </span>
              </div>
              <InputError :message="form.errors.photo"></InputError>
              <button class="ml-2 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                      type="button" @click.prevent="selectNewPhoto">
                Select a New Photo
              </button>
            </div>
          </div>
          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-2">
              <FormInput
                v-model="form.first_name"
                required
                label="First name"
                :autofocus="true"
              />
              <InputError class="mt-2" :message="form.errors.first_name" />
            </div>
            <div class="col-span-6 sm:col-span-2">
              <FormInput
                v-model="form.last_name"
                required
                label="Last name"
                :autofocus="true"
              />
              <InputError class="mt-2" :message="form.errors.last_name" />
            </div>
            <div class="col-span-6 sm:col-span-1">
              <label for="role" class="form-label !pt-1 block mb-2 text-sm font-medium text-gray-900">Owner</label>
              <select v-model="form.owner" name="role" class="w-full p-1.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block">
                <option :value="false">No</option>
                <option :value="true">Yes</option>
              </select>
              <InputError class="mt-2" :message="form.errors.owner" />
            </div>
          </div>
          <div class="col-span-6">
            <FormInput
              v-model="form.email"
              required
              label="Email"
            />
            <InputError class="mt-2" :message="form.errors.email" />
          </div>

        </div>
        <div class="border-t rounded-b-lg px-4 py-3 text-right sm:px-6">
          <div class="grid justify-items-end">
            <div class="flex items-center gap-4">
              <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
              </Transition>
              <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import InputError from "@/Components/InputError.vue";
import BreadcrumbLink from "@/Components/BreadcrumbLink.vue";
import FormSearch from "@/Components/FormSearch.vue";
import {Head, Link, useForm} from "@inertiajs/inertia-vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import FormInput from "@/Components/Form/FormInput.vue";


export default {
  components: {
    FormInput,
    Head,
    PrimaryButton,
    InputError,
    BreadcrumbLink,
    FormSearch,
    Link
  },
  setup( props){
    const form = useForm({

      id: props.user.data.id,
      photo: props.user.data.photo,
      first_name: props.user.data.first_name,
      last_name: props.user.data.last_name,
      email: props.user.data.email,
      owner: props.user.data.owner,

    });
    return {form};
  },
  props:{
    user:Object,
  },
  data() {
    return {
      photoPreview: null,
    };
  },
  methods: {
    submit(props) {
      if (this.$refs.photo) {
        this.form.photo = this.$refs.photo.files[0];
      }
      this.form.post(route("user.update",{
        _method: 'put',
        user: this.form.id
      }));
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
