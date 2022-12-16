<template>
  <Head  title="Profile" />

  <AuthenticatedUserLayout>

    <template #header>
      <h2 class="font-medium text-2xl lg:text-3xl opacity-75">Account Settings</h2>
    </template>

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

                  <div class="mt-2" v-show="!photoPreview && user.image">
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


                <div class="col-span-6 sm:col-span-3">
                  <label for="name" class="block text-sm font-medium text-gray-700">First name*</label>
                  <input  v-model="form.name"  type="text" name="name" id="name" autocomplete="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" />
                  <InputError class="mt-2" :message="form.errors.name" />

                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email address*</label>
                  <input v-model="form.email"  type="text" name="email" id="email" autocomplete="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" />
                  <InputError class="mt-2" :message="form.errors.email" />

                </div>

                <div v-if="form.mustVerifyEmail && form.email_verified_at === null">
                  <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link :href="route('verification.send')" method="post"
                      as="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      Click here to re-send the verification email.
                    </Link>
                  </p>

                  <div v-show="props.status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600">
                    A new verification link has been sent to your email address.
                  </div>
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
  </AuthenticatedUserLayout>

</template>

<script>
import AuthenticatedUserLayout from "../../Layouts/Dashboard/AuthenticatedUserLayout.vue";
import AccountUserLayout from "../../Layouts/Account/AccountUserLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {Link, Head, useForm, usePage} from "@inertiajs/inertia-vue3";



export default {
  components: {
    AuthenticatedUserLayout,
    AccountUserLayout,
    PrimaryButton,
    InputError,
    Link, Head
  },
  setup( props){

    const user = usePage().props.value.auth.user;

    const form = useForm({
      image: props.user.image,
      name: props.user.name,
      email: props.user.email,
      mustVerifyEmail: props.user.email_verified_at,

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
      this.form.post(route("profile.update"));
    },
    resetForm() {
      this.form.clearErrors();
      this.form.reset();
    },
    currentImage() {
      return "/storage/user/" + this.user.image;
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
