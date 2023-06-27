<template>
  <Head  title="Profile" />

  <UserLayout>
    <AccountUserLayout>

      <div class="mt-5 md:col-span-2 md:mt-0">
        <header>
          <h2 class="text-lg ml-5 mt-2.5 font-medium text-gray-900">Profile Information</h2>

          <p class="mt-1 ml-5 text-sm text-gray-600">
            Update your account's profile information and email address.
          </p>
        </header>
        <form @submit.prevent="submit">
          <div >
            <div class="space-y-6 px-4 py-5 sm:p-6">

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
                  <InputError :message="form.errors.photo"></InputError>
                  <button class="ml-2 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                          type="button" @click.prevent="selectNewPhoto">
                    Select a New Photo
                  </button>
                </div>
              </div>


              <div class="grid grid-cols-6 gap-6">

                <div class="col-span-6 sm:col-span-3">
                  <label for="name" class="block text-sm font-medium text-gray-700">First name*</label>
                  <input  v-model="form.first_name"  type="text" name="name" id="name" autocomplete="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" />
                  <InputError class="mt-2" :message="form.errors.first_name" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="name" class="block text-sm font-medium text-gray-700">Last name*</label>
                  <input  v-model="form.last_name"  type="text" name="name" id="name" autocomplete="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" />
                  <InputError class="mt-2" :message="form.errors.last_name" />

                </div>

              </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email address*</label>
                  <input v-model="form.email"  type="text" name="email" id="email" autocomplete="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" />
                  <InputError class="mt-2" :message="form.errors.email" />

                </div>


            </div>
            <div class="bg-gray-50 rounded-b-lg px-4 py-3 text-right sm:px-6">

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

    </AccountUserLayout>
  </UserLayout>

</template>

<script>
import UserLayout from "../../Layouts/UserLayout.vue";
import AccountUserLayout from "../../Layouts/Account/AccountUserLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {Link, Head, useForm, usePage} from "@inertiajs/inertia-vue3";



export default {
  components: {
    UserLayout,
    AccountUserLayout,
    PrimaryButton,
    InputError,
    Link, Head
  },
  setup( props){

    const {auth} = usePage().props.value.auth.user;

    const form = useForm({
      id: props.user.id,
      photo: props.user.photo,
      first_name: props.user.first_name,
      last_name: props.user.last_name,
      email: props.user.email,
    });
    return {form, auth};
  },
  props:{
    user:Object,
    mustVerifyEmail:Boolean,
    status:Object
  },
  data() {
    return {
      photoPreview: null,
    };
  },
  methods: {
    submit() {
      if (this.$refs.photo) {
        this.form.photo = this.$refs.photo.files[0];
      }
      this.form.post(route("profile.update",{
        _method: 'put',
        user: this.form.id
      }))
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
