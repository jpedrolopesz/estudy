<template>
  <Head  title="Password" />


  <AuthenticatedUserLayout>

    <template #header>
      <h2 class="font-medium text-2xl lg:text-3xl opacity-75">Account Settings</h2>
    </template>

    <AccountUserLayout>

        <div class="mt-5 md:col-span-2 md:mt-0">

            <header>
              <h2 class="text-lg ml-5 mt-2.5 font-medium text-gray-900">Update Password</h2>

              <p class="mt-1 ml-5 text-sm text-gray-600">
                Ensure your account is using a long, random password to stay secure.
              </p>
            </header>

            <form @submit.prevent="updatePassword" >
              <div>
                <div class="space-y-6 px-4 py-5 sm:p-6">

                  <div class="col-span-6 sm:col-span-3">
                    <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password*</label>
                    <input v-model="form.current_password" type="password" id="current_password"  ref="currentPasswordInput"  autocomplete="current-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" />
                    <InputError :message="form.errors.current_password" class="mt-2"/>

                  </div>


                  <div class="col-span-6 sm:col-span-3">
                    <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input v-model="form.password" type="password" id="password"  ref="PasswordInput"  autocomplete="new-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" />
                    <InputError :message="form.errors.password" class="mt-2" />

                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input v-model="form.password_confirmation" type="password" id="password_confirmation" autocomplete="new-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" />
                    <InputError :message="form.errors.password_confirmation" class="mt-2" />
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

<script setup>
import AuthenticatedUserLayout from "../../Layouts/UserLayout.vue";
import AccountUserLayout from "../../Layouts/Account/AccountUserLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
});

const updatePassword = () => {
  form.post(route('update.password'), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onError: () => {
      if (form.errors.password) {
        form.reset('password', 'password_confirmation');
        passwordInput.value.focus();
      }
      if (form.errors.current_password) {
        form.reset('current_password');
        currentPasswordInput.value.focus();
      }
    },
  });
};
</script>

