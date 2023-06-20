<template>

  <h2  class="text-3xl font-bold leading-tight text-black sm:text-4xl">Register</h2>
  <button @click="recarregar">Recarregar</button>

  <form @submit.prevent="submit">
    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

      <div class="sm:col-span-3">

        <InputLabel for="first_name" value="First name" />
        <TextInput id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name" required autofocus autocomplete="name" />
        <InputError class="mt-2" :message="form.errors.first_name" />
      </div>

      <div class="sm:col-span-3">

        <InputLabel for="last_name" value="Last name" />
        <TextInput id="last_name" type="text" class="mt-1 block w-full" v-model="form.last_name" required autofocus autocomplete="name" />
        <InputError class="mt-2" :message="form.errors.last_name" />
      </div>

      <div class="sm:col-span-6">
        <InputLabel for="email" value="Email" />
        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="sm:col-span-3">
        <InputLabel for="password" value="Password" />
        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="sm:col-span-3">
        <InputLabel for="password_confirmation" value="Confirm Password" />
        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
        <InputError class="mt-2" :message="form.errors.password_confirmation" />
      </div>
    </div>


    <div class="flex items-center justify-between mt-4">

      <slot name="register"/>

      <div class="flex items-center justify-end">
        <button @click="selectOption('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
          Already registered?
        </button>

        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Register
        </PrimaryButton>
      </div>

    </div>
  </form>



</template>


<script setup>
import {defineEmits, ref} from "vue";
import { useForm } from '@inertiajs/inertia-vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
  selectedOption: String,
})

const form = useForm({
  first_name: '',
  last_name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const emits = defineEmits(['option-selected']);

function selectOption(option) {
  emits('option-selected', option);
}

function recarregar() {
  window.location.reload();
}

const submit = () => {
  form.post(route('register.noRedirect'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
    onSuccess: () => window.location.reload(),

  });
};
</script>
