<template>
  <Head  title="Plan Edit" />

  <AdminLayout>

    <div>
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">

          <div class="w-full ">
            <div class="sm:flex sm:items-center mx-2 sm:mx-8 sm:justify-between">
              <div class="min-w-0 flex-1">

                <div class="mb-2">
                  <h1 class="font-medium text-2xl lg:text-3xl opacity-75">{{form.name}}</h1>
                </div>
                <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">



                </div>
                <p class="mt-1 text-sm text-gray-600">{{form.description}}</p>


              </div>

            </div>
          </div>

        </div>


        <div class="mt-1 md:col-span-2 md:mt-0">

          <form @submit.prevent="update">
            <div class=" shadow-lg sm:overflow-hidden rounded-t-md sm:rounded-b-md">
              <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                <div class="grid grid-cols-6 gap-6">

                  <div class="col-span-6 sm:col-span-2">
                    <FormInput
                      v-model="form.name"
                      required
                      type="text"
                      label="Plan name"
                      :autofocus="true"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />

                  </div>

                  <div class="col-span-6 sm:col-span-2">
                    <label for="price" class="form-label !pt-1 block mb-2 text-sm font-medium text-gray-900">Price</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                      <select v-model="form.price_currency" name="currencySymbol" class="w-2/4 p-1.5 bg-white rounded-l-md border-r border-gray-300 text-gray-900 text-sm focus:ring-gray-500 focus:border-gray-500 block">
                        <option v-for="option in currencyOptions" :value="option" :key="option">{{ option }}</option>
                      </select>


                      <input  v-model="form.price" type="text" class="w-full p-1.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg focus:ring-gray-500 focus:border-gray-500 block">

                    </div>
                  </div>
                  <InputError class="mt-2" :message="form.errors.price_currency" />
                  <InputError class="mt-2" :message="form.errors.price" />


                  <div class="col-span-6 sm:col-span-2">
                    <label for="recurrence" class="form-label !pt-1 block mb-2 text-sm font-medium text-gray-900">Recurrence</label>
                    <select v-model="form.slug" name="recurrence" class="w-full p-1.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block">
                      <option>Monthly</option>
                      <option>Yearly</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.slug" />

                  </div>


                  <div class="col-span-6 sm:col-span-2">
                    <FormInput
                      v-model="form.stripe_id"
                      required
                      type="text"
                      label="Code Stripe"
                      :autofocus="true"
                    />
                    <InputError class="mt-2" :message="form.errors.stripe_id" />

                  </div>


                </div>

                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-2">
                    <label for="max_users" class="block text-sm font-medium text-gray-700">Features Permissions</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                      <span class=" rounded-l-md border border-r-0 border-gray-300  px-5 text-xs text-gray-500">Max Users</span>

                      <input  v-model="form.max_users" type="number" class="w-full p-1.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg focus:ring-gray-500 focus:border-gray-500 block">

                    </div>
                  </div>
                  <InputError class="mt-2" :message="form.errors.max_users" />



                </div>

                <div class="col-span-10 sm:col-span-8">
                  <FormDescriptionEditor
                    v-model="form.description"
                    type="text"
                    label="Description"
                    placeholder="Describe some information"
                  />
                </div>

              </div>
              <div class="flex justify-between bg-gray-50 pb-16 sm:pb-2 px-4 py-3 text-right sm:px-6">

                <div>
                  <Link :href="route('plan.index')" type="button" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                    </svg>

                    Previous
                  </Link>
                </div>

                <div>


                  <button  type="submit" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                   Update
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>


  </AdminLayout>

</template>


<script setup>

import AdminLayout from "../Layouts/AdminLayout.vue";
import { Link, Head ,useForm } from '@inertiajs/inertia-vue3';
import InputError from "@/Components/InputError.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import FormDescriptionEditor from "@/Components/Form/FormDescriptionEditor.vue";

const props = defineProps({
  plan:Object,
});

const form = useForm({
  name: props.plan.name,
  slug: props.plan.slug,
  price: props.plan.price,
  price_currency: props.plan.price_currency,
  stripe_id: props.plan.stripe_id,
  description: props.plan.description,

  max_users: props.plan.plan_features.max_users
});

const update = () => {
  form.put(route('plan.update', {
      plan: props.plan.id}),)
};

const currencyOptions = [
  'USD',
  'EUR',
  'JPY',
  'GBP',
  'AUD',
  'CAD',
  'CHF',
  'CNY',
  'SEK',
  'NZD',
  'MXN',
  'SGD',
  'HKD',
  'NOK',
  'KRW',
  'TRY',
  'RUB',
  'INR',
  'BRL',
  'ZAR',
  'PHP',
  'TWD',
  'THB',
  'IDR',
  'BBD',
  'COP',
  'KWD',
  'JOD',
  'BND',
  'TTD',
  'FJD',
  'KYD',
  'ARS',
  'SAR',
  'RSD',
  'PKR',
  'ILS',
  'CLP',
  'LKR',
  'BSD',
  'DZD',
  'DOP',
  'PLN',
  'BZD',
  'BMD',
  'BIF',
  'SBD',
  'ZMW',
  'CKD',
  'FKP'
];


function restore () {
  form.put(route('user.restore', props.user.id))

}


</script>

