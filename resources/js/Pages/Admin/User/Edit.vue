<template>

  <AdminLayout>

    <div>
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">

          <div class="w-full ">
            <div class="sm:flex sm:items-center mx-8 sm:justify-between">
              <div class="min-w-0 flex-1">

                <div class="mb-2">
                  <h1 class="font-medium text-lg lg:text-2xl opacity-75">Account Settings</h1>
                </div>
                <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">


                </div>
                <p class="mt-1 text-sm text-gray-600">This information will be displayed publicly so be careful what you share.</p>


              </div>

            </div>
          </div>

        </div>


        <div class="mt-1 md:col-span-2 md:mt-0">
          <TabGroup>

            <TabList class="py-1 bg-white border-b rounded-t-md items-center">

              <div class="text-sm font-medium flex flex-nowrap mt-2 sm:-mx-6 lg:-mx-8 overflow-x-auto">
                <template v-for="(tab, index) in tabs" :key="index">
                  <Tab v-slot="{ selected }" class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8">
                    <div :class="{ 'text-gray-900': selected }" class="text-gray-500 hover:text-gray-800 whitespace-nowrap flex items-center">
                      <span class="ml-4">{{tab}}</span>
                    </div>
                  </Tab>
                </template>
              </div>
            </TabList>

            <TabPanels >
              <!-- Tab 1 -->
              <TabPanel>
                <ProfileEdit :user="user"/>

              </TabPanel>

              <!-- Tab 2 -->
              <TabPanel>
                <ProfilePassword :user="user"/>
                <input type="hidden" name="tab" value="tab2">

              </TabPanel>

              <!-- Tab 3 - Billing Information -->
              <TabPanel v-if="!invoices.length < 1">
                <div class=" shadow-lg sm:overflow-hidden sm:rounded-b-md">
                  <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                    <!-- Billing Information -->
                    <section >
                            <h3 class="text-xl text-gray-800 font-semibold mb-1">Billing Information</h3>
                            <ul>
                              <li class="md:flex md:justify-between md:items-center py-3 border-b border-gray-200">
                                <!-- Left -->
                                <div class="text-sm text-gray-800">Payment Method</div>
                                <!-- Right -->
                                <div class="text-sm text-gray-800 ml-4">
                                  <span class="mr-3">{{ subscription.pm_type }} ending {{ subscription.pm_last_four }}</span>
                                </div>
                              </li>
                              <li class="md:flex md:justify-between md:items-center py-3 border-b border-gray-200">
                                <!-- Left -->
                                <div class="text-sm text-gray-800 ">Billing Interval</div>
                                <!-- Right -->
                                <div class="text-sm text-gray-800 ml-4">
                                  <span class="mr-3">Annually</span>
                                </div>
                              </li>
                              <li class="md:flex md:justify-between md:items-center py-3 border-b border-gray-200">
                                <!-- Left -->
                                <div class="text-sm text-gray-800">Number</div>
                                <!-- Right -->
                                <div class="text-sm text-gray-800ml-4">
                                  <span class="mr-3">{{ subscription.stripe_id }}</span>
                                </div>
                              </li>

                              <li class="md:flex md:justify-between md:items-center py-3 border-b border-gray-200">
                                <!-- Left -->
                                <div class="text-sm text-gray-800 ">Billing Address</div>
                                <!-- Right -->
                                <div class="text-sm text-gray-800 ml-4">
                                  <span class="mr-3">{{ subscription.email }}</span>
                                </div>
                              </li>
                            </ul>
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
              </TabPanel>
            </TabPanels>
          </TabGroup>
        </div>

      </div>
    </div>

  </AdminLayout>

</template>


<script setup>
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
import AdminLayout from "@/Pages/Admin/Layouts/AdminLayout.vue";
import ProfileEdit from "@/Components/User/ProfileEdit.vue";
import ProfilePassword from "@/Components/User/ProfilePassword.vue";
import {ref} from "vue";

const props = defineProps({
  user: Object,
  invoices:{ type: Object || Array, require: true},
  subscription:{ type: Object || Array, require: true},
});

const tabs = ref(['Account', 'Password', 'Billing' ])





</script>

