<template>

  <AuthenticatedLayout>
        <AccountLayout>
          <div class="mt-5 md:col-span-2 md:mt-0">
            <form action="#" method="POST">
              <div class="overflow-hidden">
                <div class="px-4 py-5 sm:p-6">

                  <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                    <div>
                      <label class="block text-sm font-medium text-gray-700">Logo</label>
                      <div class="mt-1 flex items-center">
                            <span class="inline-block h-12 w-12 overflow-hidden rounded-full bg-gray-100">
                              <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                              </svg>
                            </span>
                        <button type="button" class="ml-5 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Change</button>
                      </div>
                    </div>
                  </div>

                  <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                      <label for="first-name" class="block text-sm font-medium text-gray-700">Company name</label>
                      <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                      <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                      <input type="text" name="email-address" id="email-address" autocomplete="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>


                    <div class="col-span-6">
                      <label for="street-address" class="block text-sm font-medium text-gray-700">Street address</label>
                      <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>

                    <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                      <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                      <input type="text" name="city" id="city" autocomplete="address-level2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>

                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                      <label for="region" class="block text-sm font-medium text-gray-700">State / Province</label>
                      <input type="text" name="region" id="region" autocomplete="address-level1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>

                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                      <label for="postal-code" class="block text-sm font-medium text-gray-700">ZIP / Postal code</label>
                      <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    </div>

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

<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import AccountLayout from "@/Pages/Admin/Layouts/Account/AccountLayout.vue";

</script>
