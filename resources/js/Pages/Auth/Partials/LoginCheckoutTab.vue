<template>
  <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
    {{ status }}
  </div>
  <h2  class="text-3xl font-bold leading-tight text-black sm:text-4xl">Login</h2>
  <form @submit.prevent="submit">
    <div>
      <InputLabel for="email" value="Email" />
      <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
      <InputError class="mt-2" :message="form.errors.email" />
    </div>

    <div class="mt-4">
      <InputLabel for="password" value="Password" />
      <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
      <InputError class="mt-2" :message="form.errors.password" />
    </div>

    <div class="block mt-4">
      <label class="flex items-center">
        <Checkbox name="remember" v-model:checked="form.remember" />
        <span class="ml-2 text-sm text-gray-600">Remember me</span>
      </label>
    </div>

    <div class="flex items-center justify-between mt-4">

      <slot name="login"/>


      <div class="flex items-center justify-end ">

        <button @click="selectOption('register')" class="underline text-sm text-gray-600 hover:text-gray-900">
          Not already registered?
        </button>

        <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
          Forgot your password?
        </Link>

        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Log in
        </PrimaryButton>
      </div>

    </div>
  </form>
  <div >
    <h3 class="font-semibold mt-4">User</h3>
    <div class="hover:border-gray-500 hover:border-solid hover:bg-white hover:text-gray-500 group w-full flex flex-col items-center justify-center rounded-md border-2 border-dashed border-slate-300 text-sm leading-6 text-slate-900 font-medium py-3">
      <div class="flex">
        <span>E-mail: </span><span class="underline ml-2">user@demo.com</span>
      </div>
      <div class="flex">
        <span>Password: </span><span class="underline ml-2">password</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import {defineEmits, onMounted} from 'vue';
import {Inertia} from "@inertiajs/inertia";


defineProps({
  canResetPassword: Boolean,
  status: String,
  selectedOption: String,

});

const form = useForm({
  email: '',
  password: '',
  remember: false
});

const emits = defineEmits(['option-selected']);

function selectOption(option) {
  emits('option-selected', option);
}


const submit = () => {
  form.post(route('login.noRedirect'), {
    preserveScroll: true,
    onSuccess: () => window.location.reload(),
    onFinish: () => form.reset('password'),
  });
};
</script>

