<template>
  <Head  title="Plan Edit" />

  <AuthenticatedLayout>

    <div>
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">

          <div class="w-full ">
            <div class="sm:flex sm:items-center mx-8 sm:justify-between">
              <div class="min-w-0 flex-1">

                <div class="mb-2">
                  <h1 class="font-medium text-2xl lg:text-3xl opacity-75">Plan Settings</h1>
                </div>
                <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">

                  <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ul class="inline-flex flex-wrap text-sm font-medium">
                      <li class="after:content-['/'] last:after:hidden after:text-slate-400 after:px-2">
                        <BreadcrumbLink :href="route('dashboard')" :active="route().current('dashboard')">
                          Home
                        </BreadcrumbLink>
                      </li>
                      <li class="after:content-['/'] last:after:hidden after:text-slate-400 after:px-2">
                        <BreadcrumbLink  :active="route().current('pages.plans.index')">
                          Plans
                        </BreadcrumbLink>
                      </li>
                      <li class="after:content-['/'] last:after:hidden after:text-slate-400 after:px-2">
                        <BreadcrumbLink  :active="route().current('pages.plans.edit')">
                          Edit
                        </BreadcrumbLink>
                      </li>
                    </ul>
                  </nav>


                </div>
                <p class="mt-1 text-sm text-gray-600">This information will be displayed publicly so be careful what you share.</p>


              </div>

            </div>
          </div>

        </div>


        <div class="mt-1 md:col-span-2 md:mt-0">
          <TabGroup>
            <TabList class="mt-1 p-2 bg-white border-b rounded-t-md items-center">

              <!-- Start -->
              <div class="text-sm font-medium flex flex-nowrap mt-3 sm:-mx-6 lg:-mx-8 overflow-x-auto ">
                <Tab  v-slot="{ selected }" class="pb-3 sm:ml-4 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8">
                  <div :class="{ 'text-gray-900': selected }" class="text-gray-500 hover:text-gray-800 whitespace-nowrap flex items-center">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                    </svg>

                    <span>Plan</span>
                  </div>
                </Tab>
                <Tab v-slot="{ selected }" class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8">
                  <div :class="{ 'text-gray-900': selected }" class="text-gray-500 hover:text-gray-800 whitespace-nowrap flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <span>Details</span>
                  </div>
                </Tab>
                <Tab  v-slot="{ selected }" class="pb-3 mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8">
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

                      <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                          <label for="name" class="block text-sm font-medium text-gray-700">Plan name</label>
                          <input  v-model="form.name"  type="text" name="name" id="name" autocomplete="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />

                          <InputError class="mt-2" :message="form.errors.name" />
                        </div>




                        <div class="col-span-6 sm:col-span-2">
                          <label for="street-address" class="block text-sm font-medium text-gray-700">Price</label>
                          <input v-model="form.price" type="number" name="price" id="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                          <label for="recurrence" class="block text-sm font-medium text-gray-700">Recurrence</label>
                          <select v-model="form.slug" name="recurrence" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <option>{{form.slug}}</option>
                            <option>Monthly</option>
                            <option>Yearly</option>
                          </select>
                          <InputError class="mt-2" :message="form.errors.slug" />

                        </div>


                        <div class="col-span-6 sm:col-span-3">
                          <label for="stripe_id"  class="block text-sm font-medium text-gray-700">Code Stripe</label>
                          <input v-model="form.stripe_id" type="text" name="stripe_id" id="stripe_id"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>


                      </div>

                      <div class="col-span-10 sm:col-span-8">
                        <label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
                        <div class="mt-1">
                          <textarea v-model="form.description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" ></textarea>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Brief description for your profile. URLs are hyperlinked.</p>
                      </div>

                    </div>
                    <div class="flex justify-between bg-gray-50 px-4 py-3 text-right sm:px-6">

                      <div>
                        <Link :href="route('pages.plans.index')" type="button" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                          </svg>

                          Previous
                        </Link>
                      </div>

                      <div>
                        <TrashedMessage v-if="plan.deleted_at"  @restore="restore"> This plan has been deleted.  </TrashedMessage>

                        <button v-if="!plan.deleted_at" type="submit" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                          Update
                        </button>
                      </div>

                    </div>
                  </div>
                </form>

              </TabPanel>
              <!-- Tab 2 - Password -->
              <TabPanel>
                Details Plan
              </TabPanel>
              <TabPanel>Billing Information</TabPanel>
            </TabPanels>
          </TabGroup>
        </div>

      </div>
    </div>

  </AuthenticatedLayout>

</template>


<script>

import AuthenticatedLayout from "../Layouts/Dashboard/AuthenticatedLayout.vue";
import BreadcrumbLink from "@/Components/BreadcrumbLink.vue";
import { Link, Head ,useForm } from '@inertiajs/inertia-vue3';
import InputError from "@/Components/InputError.vue";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
import FileInput from "@/Components/FileInput.vue";
import TrashedMessage from "@/Components/TrashedMessage.vue";

export default {
  components: {
    TrashedMessage,
    AuthenticatedLayout,
    BreadcrumbLink,
    FileInput,
    InputError,
    Head, Link,
    TabGroup, TabList,
    Tab, TabPanels, TabPanel,
  },
  props: {
    plan: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        name: this.plan.name,
        slug: this.plan.slug,
        price: this.plan.price,
        stripe_id: this.plan.stripe_id,
        description: this.plan.description

      }),
    }
  },
  methods: {
    update() {
      this.form.put(route('plans.update', this.plan.id))
    },
    destroy() {
      if (confirm('Are you sure you want to delete this user?')) {
        this.$inertia.delete(`/plan/${this.user.id}`)
      }
    },

    restore() {
      this.form.put(route('plans.restore', this.plan.id))

    },
  },
}
</script>

