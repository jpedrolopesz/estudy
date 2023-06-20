<template>
  <Head  title="User Edit" />

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

              <!-- Start -->
                  <div class="text-sm font-medium flex flex-nowrap mt-2 sm:-mx-6 lg:-mx-8 overflow-x-auto ">
                    <Tab  v-slot="{ selected }" class="pb-3 sm:ml-4 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8">
                      <div :class="{ 'text-gray-900': selected }" class="text-gray-500 hover:text-gray-800 whitespace-nowrap flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <span>Account</span>
                      </div>
                    </Tab>
                    <Tab v-slot="{ selected }" class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8">
                      <div :class="{ 'text-gray-900': selected }" class="text-gray-500 hover:text-gray-800 whitespace-nowrap flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                        <span>Password</span>
                      </div>
                    </Tab>
                    <Tab v-if="!invoices.length < 1" v-slot="{ selected }" class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8">
                      <div :class="{ 'text-gray-900': selected }" class="text-gray-500 hover:text-gray-800 whitespace-nowrap flex items-center">
                        <svg class="w-4 h-4 shrink-0 fill-current text-slate-400 mr-2" viewBox=" 0 0 16 16">
                          <path d="M3.414 2L9 7.586V16H7V8.414l-5-5V6H0V1a1 1 0 011-1h5v2H3.414zM15 0a1 1 0 011 1v5h-2V3.414l-3.172 3.172-1.414-1.414L12.586 2H10V0h5z" />
                        </svg>
                        <span>Billing</span>
                      </div>
                    </Tab>
                  </div>
                <!-- End -->
            </TabList>

            <TabPanels>
              <!-- Tab 1 - Account -->
              <TabPanel>
                <form @submit.prevent="update">
                  <div class=" shadow-lg sm:overflow-hidden sm:rounded-b-md">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                      <div>
                        <label class="block text-sm font-medium text-gray-700">Photo</label>
                        <div class="mt-1 flex items-center">
                          <span class="inline-block h-12 w-12 overflow-hidden rounded-full bg-gray-100">
                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                          </span>
                          <label class="relative ml-4 cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                            <span class="ml-2 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Upload a file</span>

                            <input  type="file" name="image" @input="form.photo = $event.target.files[0]" style="display: none" class="sr-only">
                          </label>
                        </div>
                      </div>
                      <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-2">
                          <FormInput
                            v-model="form.first_name"
                            required
                            label="First name"
                            :autofocus="true"
                          />
                          <InputError class="mt-2" :message="form.errors.first_name" />

                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <FormInput
                              v-model="form.last_name"
                              required
                              label="Last name"
                            />
                          <InputError class="mt-2" :message="form.errors.last_name" />
                        </div>

                        <div class="col-span-6 sm:col-span-1">
                          <label for="role" class="form-label !pt-1 block mb-2 text-sm font-medium text-gray-900">Owner</label>
                          <select v-model="form.owner" name="role" class="w-full p-1.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block">
                            <option :value="false">No</option>
                            <option :value="true">Yes</option>

                          </select>
                          <InputError class="mt-2" :message="form.errors.owner" />
                        </div>

                        <div class="col-span-6">
                          <FormInput
                            v-model="form.email"
                            required
                            label="Email"
                          />
                          <InputError class="mt-2" :message="form.errors.email" />
                        </div>


                      </div>

                    </div>
                    <div class="flex justify-between bg-gray-50 px-4 py-3 text-right sm:px-6">

                      <div>
                        <Link :href="route('user.index')" type="button" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                          </svg>

                          Previous
                        </Link>
                      </div>

                      <div>
                        <TrashedMessage v-if="user.deleted_at"  @restore="restore"> This user has been deleted.  </TrashedMessage>

                        <button v-if="!user.deleted_at" type="submit" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                          Update
                        </button>
                      </div>

                    </div>
                  </div>
                </form>

              </TabPanel>

              <!-- Tab 2 - Password -->
              <TabPanel>
                <form @submit.prevent="form.put(route('user.update', this.user.id))">
                  <div class=" shadow-lg sm:overflow-hidden sm:rounded-b-md">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">


                      <div class="col-span-6 sm:col-span-2">
                        <FormInput
                          required
                          v-model="form.password_current"
                          type="password"
                          label="Password Current*"
                        />
                        <InputError class="mt-2" :message="form.errors.password_current" />

                      </div>

                      <div class="col-span-6 sm:col-span-2">
                        <FormInput
                          required
                          v-model="form.password"
                          type="password"
                          label="Password New"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />

                      </div>
                      <div class="col-span-6 sm:col-span-2">
                        <FormInput
                          required
                          v-model="form.password_confirmation"
                          type="password"
                          label="Password Confirmation"
                        />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />

                      </div>

                    </div>
                    <div class="flex justify-between bg-gray-50 px-4 py-3 text-right sm:px-6">

                      <div>
                        <Link :href="route('user.index')" type="button" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                          </svg>

                          Previous
                        </Link>
                      </div>

                      <div>
                        <TrashedMessage v-if="user.deleted_at"  @restore="restore"> This user has been deleted.  </TrashedMessage>

                        <button v-if="!user.deleted_at" type="submit" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                          Update
                        </button>
                      </div>
                    </div>
                  </div>
                </form>

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
import {Link,useForm, Head} from "@inertiajs/inertia-vue3";
import TrashedMessage from "@/Components/TrashedMessage.vue";
import InputError from "@/Components/InputError.vue";
import AdminLayout from "@/Pages/Admin/Layouts/AdminLayout.vue";
import FormInput from "@/Components/Form/FormInput.vue";

const props = defineProps({
  user: Object,
  invoices:{ type: Object || Array, require: true},
  subscription:{ type: Object || Array, require: true},
});

const form = useForm({
  first_name: props.user.first_name,
  last_name: props.user.last_name,
  email: props.user.email,
  owner: props.user.owner,
  photo: '',
  password: '',
  password_current: props.user.password_current,
  password_confirmation: props.user.password_confirmation,
});

const update = () => {
  form.put(route('user.update', {
    user: props.user.id}),
    {
    onSuccess: () => form.reset('password', 'photo'),
  })
};

function restore () {
  form.put(route('user.restore', props.user.id))

}

</script>

