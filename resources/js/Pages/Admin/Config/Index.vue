<template>

  <div class=" m-10 sm:m-32">
    <h2  class="text-3xl font-bold leading-tight text-black sm:text-4xl">Registration and Introduction to the Platform</h2>
    <h3  class="text-sm font-lite mt-4 leading-tight text-black ">Establishing Your Online Presence: Create Your First Account and Access the Software with Ease</h3>

    <form @submit.prevent="submit">
      <div class="mt-10 grid grid-cols-1  gap-x-6 gap-y-8 sm:grid-cols-6">

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





      <div class="flex items-center justify-end mt-4">


        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Register
        </PrimaryButton>
      </div>

    </form>
  </div>




</template>


<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
  first_name: '',
  last_name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('config.store'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
    onSuccess: () => window.location.href = '/admin/dashboard',

  });
};
</script>
