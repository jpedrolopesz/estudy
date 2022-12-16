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

        <div class="flex ml-5 mt-5">


          <div class="grow my-5 mx-4">

            <!-- Panel body -->

          <!-- Billing Information -->
          <section>
            <h3 class="text-xl text-gray-800 font-semibold mb-1">Billing Information</h3>
            <ul>
              <li class="md:flex md:justify-between md:items-center py-3 border-b border-gray-200">
                <!-- Left -->
                <div class="text-sm text-gray-800">Payment Method</div>
                <!-- Right -->
                <div class="text-sm text-gray-800 ml-4">
                  <span class="mr-3">Mastercard ending 9282</span>
                  <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Edit</a>
                </div>
              </li>
              <li class="md:flex md:justify-between md:items-center py-3 border-b border-gray-200">
                <!-- Left -->
                <div class="text-sm text-gray-800 ">Billing Interval</div>
                <!-- Right -->
                <div class="text-sm text-gray-800 ml-4">
                  <span class="mr-3">Annually</span>
                  <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Edit</a>
                </div>
              </li>
              <li class="md:flex md:justify-between md:items-center py-3 border-b border-gray-200">
                <!-- Left -->
                <div class="text-sm text-gray-800">VAT/GST Number</div>
                <!-- Right -->
                <div class="text-sm text-gray-800ml-4">
                  <span class="mr-3">UK849700927</span>
                  <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Edit</a>
                </div>
              </li>
              <li class="md:flex md:justify-between md:items-center py-3 border-b border-gray-200">
                <!-- Left -->
                <div class="text-sm text-gray-800 ">Your Address</div>
                <!-- Right -->
                <div class="text-sm text-gray-800ml-4">
                  <span class="mr-3">34 Savoy Street, London, UK, 24E8X</span>
                  <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Edit</a>
                </div>
              </li>
              <li class="md:flex md:justify-between md:items-center py-3 border-b border-gray-200">
                <!-- Left -->
                <div class="text-sm text-gray-800 ">Billing Address</div>
                <!-- Right -->
                <div class="text-sm text-gray-800 ml-4">
                  <span class="mr-3">hello@cruip.com</span>
                  <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Edit</a>
                </div>
              </li>
            </ul>
          </section>

          <!-- Invoices -->
          <section>
            <h3 class="text-xl mt-5  text-gray-800 font-semibold mb-1">Invoices</h3>
            <!-- Table -->
            <table class="table-auto w-full">
              <!-- Table header -->
              <thead class="text-xs uppercase text-gray-400">
              <tr class="flex flex-wrap md:table-row md:flex-no-wrap">
                <th class="w-full block md:w-auto md:table-cell py-2">
                  <div class="font-medium text-left">Year</div>
                </th>
                <th class="w-full hidden md:w-auto md:table-cell py-2">
                  <div class="font-medium text-left">Plan</div>
                </th>
                <th class="w-full hidden md:w-auto md:table-cell py-2">
                  <div class="font-medium text-left">Amount</div>
                </th>
                <th class="w-full hidden md:w-auto md:table-cell py-2">
                  <div class="font-semibold text-right"></div>
                </th>
              </tr>
              </thead>
              <!-- Table body -->
              <tbody class="text-sm">
              <!-- Row -->
              <tr class="flex flex-wrap md:table-row md:flex-no-wrap border-b border-gray-200 py-2 md:py-0">
                <td class="w-full block md:w-auto md:table-cell py-0.5 md:py-2">
                  <div class="text-left  text-gry-800">2021</div>
                </td>
                <td class="w-full block md:w-auto md:table-cell py-0.5 md:py-2">
                  <div class="text-left">Basic Plan - Annualy</div>
                </td>
                <td class="w-full block md:w-auto md:table-cell py-0.5 md:py-2">
                  <div class="text-left ">$349.00</div>
                </td>
                <td class="w-full block md:w-auto md:table-cell py-0.5 md:py-2">
                  <div class="text-right flex items-center md:justify-end">
                    <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">HTML</a>
                    <span class="block w-px h-4 bg-gray-200 mx-2" aria-hidden="true"></span>
                    <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">PDF</a>
                  </div>
                </td>
              </tr>
              <!-- Row -->
              <tr class="flex flex-wrap md:table-row md:flex-no-wrap border-b border-gray-200 py-2 md:py-0">
                <td class="w-full block md:w-auto md:table-cell py-0.5 md:py-2">
                  <div class="text-left  text-gray-800">2020</div>
                </td>
                <td class="w-full block md:w-auto md:table-cell py-0.5 md:py-2">
                  <div class="text-left">Basic Plan - Annualy</div>
                </td>
                <td class="w-full block md:w-auto md:table-cell py-0.5 md:py-2">
                  <div class="text-left ">$349.00</div>
                </td>
                <td class="w-full block md:w-auto md:table-cell py-0.5 md:py-2">
                  <div class="text-right flex items-center md:justify-end">
                    <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">HTML</a>
                    <span class="block w-px h-4 bg-gray-200 mx-2" aria-hidden="true"></span>
                    <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">PDF</a>
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

<script setup>
import AuthenticatedUserLayout from "../../Layouts/Dashboard/AuthenticatedUserLayout.vue";
import AccountUserLayout from "../../Layouts/Account/AccountUserLayout.vue";
import {Link, Head,} from "@inertiajs/inertia-vue3";

</script>
