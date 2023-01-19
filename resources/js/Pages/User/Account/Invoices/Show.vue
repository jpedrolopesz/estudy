<template>
  <Head  title="Billing & Invoices" />

  <AuthenticatedUserLayout>

    <template #header>
      <h2 class="font-medium text-2xl lg:text-3xl opacity-75">Account Settings</h2>
    </template>
    <AccountUserLayout>
      <div class="mt-5 md:col-span-2 md:mt-0">
        <header>
          <h2 class="text-lg ml-5 mt-2.5 font-medium text-gray-900">Billing & Invoices</h2>

          <p class="mt-1 ml-5 text-sm text-gray-600">
            If you wish to keep using the application, please choose a subscription plan below.
          </p>
        </header>

        <div class="flex ml-1 mt-5">
          <div class="grow my-5 mx-4">
          <!-- Billing Information -->
          <section>
            <h3 class="text-xl text-gray-800 font-semibold mb-1">Billing Information</h3>
            <ul>
              <li class="md:flex md:justify-between md:items-center py-3 border-b border-gray-200">
                <!-- Left -->
                <div class="text-sm text-gray-800">Payment Method</div>
                <!-- Right -->
                <div class="text-sm text-gray-800 ml-4">
                  <span class="mr-3">{{ subscription.pm_type }} ending {{ subscription.pm_last_four }}</span>
                  <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Edit</a>
                </div>
              </li>
              <li class="md:flex md:justify-between md:items-center py-3 border-b border-gray-200">
                <!-- Left -->
                <div class="text-sm text-gray-800 ">Current Plan</div>
                <!-- Right -->
                <div class="text-sm text-gray-800 ml-4">
                  <span class="mr-3">Plan Name</span>
                  <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Edit</a>
                </div>
              </li>
              <li class="md:flex md:justify-between md:items-center py-3 border-b border-gray-200">
                <!-- Left -->
                <div class="text-sm text-gray-800">Number</div>
                <!-- Right -->
                <div class="text-sm text-gray-800ml-4">
                  <span class="mr-3">{{ subscription.stripe_id }}</span>
                  <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Edit</a>
                </div>
              </li>

              <li class="md:flex md:justify-between md:items-center py-3 border-b border-gray-200">
                <!-- Left -->
                <div class="text-sm text-gray-800 ">Billing Address</div>
                <!-- Right -->
                <div class="text-sm text-gray-800 ml-4">
                  <span class="mr-3">{{ subscription.email }}</span>
                  <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Edit</a>
                </div>
              </li>

            </ul>

            <div class="md:flex md:justify-between md:items-center py-3 border-b border-gray-200">
              <!-- Left -->
              <div  class="text-sm text-gray-800 ">Subscribed</div>
              <!-- Right -->
              <div class="flex text-sm text-gray-800 ml-4">

                <form v-if="!onGracePeriod" @submit.prevent="cancel">
                  <div class="flex">
                    <p class="text-sm mr-3 text-gray-800">
                      Nome Plano
                    </p>
                    <button type="submit" class="font-medium text-red-500 hover:text-red-600">Cancel </button>
                  </div>
                </form>

                <form v-if="onGracePeriod" @submit.prevent="resume">
                  <div class="flex justify-between">
                    <p  class="text-sm mr-3 font-medium text-orange-800">
                      You're on a <strong>grace period</strong> until <span ></span>.
                      If you wish to continue using the application after that date. <strong>
                    </strong>
                    </p>
                    <button type="submit" class="font-medium text-indigo-500 hover:text-indigo-600">Resubscribe</button>
                  </div>
                </form>


              </div>
            </div>
          </section>



          <!-- Invoices -->
            <section  >
              <h3 class="text-xl mt-5  text-gray-800 font-semibold mb-1">Invoices</h3>
              <!-- Table -->
              <table class="table-auto w-full">
                <!-- Table header -->
                <thead class="text-xs uppercase text-gray-400">
                <tr class="flex flex-wrap md:table-row md:flex-no-wrap">
                  <th class="w-full block md:w-auto md:table-cell py-2">
                    <div class="font-medium text-left">Invoice Number</div>
                  </th>
                  <th class="w-full hidden md:w-auto md:table-cell py-2">
                    <div class="font-medium text-left">Plan</div>
                  </th>
                  <th class="w-full hidden md:w-auto md:table-cell py-2">
                    <div class="font-semibold text-right"></div>
                  </th>
                </tr>
                </thead>
                <!-- Table body -->
                <tbody v-for="invoice in invoices" :key="invoice.id" class="text-sm">
                <!-- Row -->
                <tr class="flex flex-wrap md:table-row md:flex-no-wrap border-b border-gray-200 py-2 md:py-0">

                  <td class="w-full block md:w-auto md:table-cell py-0.5 md:py-2">
                    <div class="text-left">{{ invoice.number }}</div>
                  </td>
                  <td class="w-full block md:w-auto md:table-cell py-0.5 md:py-2">
                    <div class="text-left ">{{ invoice.lines.data[0].description }}</div>
                  </td>
                  <td class="w-full block md:w-auto md:table-cell py-0.5 md:py-2">
                    <div class="text-right flex items-center md:justify-end">
                      <a class="font-medium text-indigo-500 hover:text-indigo-600"
                         target="_blank" :href=invoice.hosted_invoice_url>Link</a>
                      <span class="block w-px h-4 bg-gray-200 mx-2" aria-hidden="true"></span>
                      <a class="font-medium text-indigo-500 hover:text-indigo-600"
                         :href=invoice.invoice_pdf>Download</a>
                    </div>
                  </td>
                </tr>
                </tbody>
              </table>
            </section>

            </div>
        </div>
      </div>



    </AccountUserLayout>
  </AuthenticatedUserLayout>

</template>

<script>
import AuthenticatedUserLayout from "../../Layouts/Dashboard/AuthenticatedUserLayout.vue";
import AccountUserLayout from "../../Layouts/Account/AccountUserLayout.vue";
import {Link, Head, useForm,} from "@inertiajs/inertia-vue3";

export default {

  components: {AuthenticatedUserLayout,AccountUserLayout, Link, Head,},

  props: {
    invoices: {
      type: Object || Array,
      require: true
    },
    subscription:String,
    onGracePeriod: Boolean,


  },
  setup(props){
    console.log(props.subscription)

    const form = useForm({
      _method: 'post',
    });
    return {form};
  },
  methods: {
   cancel() {
     this.form.post(route('subscription.cancel'))

   },
    resume() {
     this.form.post(route('subscription.resume'))

   }
  },
}

</script>
