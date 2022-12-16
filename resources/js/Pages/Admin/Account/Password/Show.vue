<template>

  <AuthenticatedLayout>
    <AccountLayout>

      <div class="mt-5 md:col-span-2 md:mt-0">
        <form @submit.prevent="submit">
          <div class="overflow-hidden">
            <div class="px-4 py-5 sm:p-6">

              <div class="mt-4">
                <InputLabel for="password_current" value="Password Current" />
                <TextInput id="password_current" type="password" class="mt-1 block w-full" v-model="form.password_current" required  />
                <InputError class="mt-2" :message="form.errors.password_current" />
              </div>

              <div class="mt-4">
                <InputLabel for="password" value="New Password" />
                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                <InputError class="mt-2" :message="form.errors.password" />
              </div>

              <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
              </div>

            </div>

            <div class="shadow sm:overflow-hidden sm:rounded-md">
              <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
              </div>
            </div>
          </div>



        </form>
      </div>


    </AccountLayout>
  </AuthenticatedLayout>

</template>

<script>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import AccountLayout from "@/Pages/Admin/Account/Partials/AccountLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {Link, useForm} from "@inertiajs/inertia-vue3";

export default {
  components: {
    InputError,
    AccountLayout,
    InputLabel,
    TextInput,
    AuthenticatedLayout,
    Link
  },
  setup( props){
    const form = useForm({
      password_current: '',
      password: '',
      password_confirmation: '',
    });
    return {form};
  },
  props:{
    user:Object
  },
  methods: {
    submit() {
      this.form.put(route("account.password.update"));
    },
  },
}


</script>
