<template>
  <Head  title="Password" />

  <div class="bg-white shadow-lg rounded-md">
    <header class="p-4 ml-2">
      <h2 class="text-lg font-medium text-gray-900">Update Password</h2>
      <p class="text-sm text-gray-600">
        Ensure your account is using a long, random password to stay secure.
      </p>
    </header>

    <form @submit.prevent="updatePassword" >
      <div>
        <div class="space-y-6 px-4 py-2 sm:p-6">
          <div class="col-span-6 sm:col-span-3">
            <FormInput
                  v-model="form.current_password"
                  type="password" id="current_password"  ref="currentPasswordInput"
                  required
                  label="Current password"
                  :autofocus="true"
                />
            <InputError :message="form.errors.current_password" class="mt-2"/>
          </div>

          <div class="col-span-6 sm:col-span-3">
                <FormInput
                  v-model="form.password"
                  type="password" id="password" ref="PasswordInput"
                  required
                  label="New password"
                  :autofocus="true"
                />
                <InputError :message="form.errors.password" class="mt-2" />
              </div>

          <div class="col-span-6 sm:col-span-3">
                <FormInput
                  v-model="form.password_confirmation"
                  type="password" id="password_confirmation"
                  required
                  label="Confirmation password"
                  :autofocus="true"
                />
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

</template>


<script setup>

import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import FormInput from "@/Components/Form/FormInput.vue";



const props = defineProps({
  user:Object
})
const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
});

const updatePassword = () => {
  form.put(route('user.password', {
    user: props.user.data.id
  }), {
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

