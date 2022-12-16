<template>

  <AuthenticatedLayout>

    <div class="w-full ">
      <div class="sm:flex sm:items-center mx-8 sm:justify-between">
        <div class="min-w-0 flex-1">

          <div class="mb-2">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Admins</h1>
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
                  <BreadcrumbLink  :active="route().current('admins.index')">
                    Admins
                  </BreadcrumbLink>
                </li>
              </ul>
            </nav>

          </div>
        </div>

        <div class="flex items-center">
          <!-- @include('admin.includes.form-search', ['routerName' => 'courses.index'])-->
          <FormSearch/>
          <div>
            <Link :href="route('admins.create')" type="button" class="btn bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <i class='bx bx-plus table__icon'></i>
              Admins
            </Link>
          </div>

        </div>
      </div>
    </div>

    <div class="bg-white shadow-lg rounded-sm border border-slate-200 relative">
      <header class="px-5 py-4">
        <h2 class="font-semibold text-slate-800">All Admins <span class="text-slate-400 font-medium">248</span></h2>
      </header>
      <div>

        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="table-auto w-full">
            <!-- Table header -->
            <thead class="text-xs font-semibold  uppercase text-slate-500 bg-slate-50 border-t border-b border-slate-200">
            <tr>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                <div class="flex items-center">
                  <label class="inline-flex">
                    <span class="sr-only">Select all</span>
                    <input class="form-checkbox" type="checkbox" v-model="selectAll" @click="checkAll" />
                  </label>
                </div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
                <span class="sr-only">Favourite</span>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Order</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Email</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Location</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold">Orders</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Last order</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold text-left">Total spent</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <div class="font-semibold">Refunds</div>
              </th>
              <th class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                <span class="sr-only">Menu</span>
              </th>
            </tr>
            </thead>
            <!-- Table body -->
            <tbody class="text-sm divide-y divide-slate-200">
            <Customer
              v-for="customer in customers"
              :key="customer.id"
              :customer="customer"
              v-model:selected="selected"
              :value="customer.id"
            />
            </tbody>
          </table>

        </div>
      </div>
    </div>


  </AuthenticatedLayout>

</template>


<script>
import { ref, watch } from 'vue'
import Customer from './Partials/AdmisTableItem.vue'

import Image01 from '../../../../../public/images/user.jpeg'
import AuthenticatedLayout from "@/Layouts/Admin/AuthenticatedLayout.vue";
import BreadcrumbLink from "@/Components/BreadcrumbLink.vue";
import FormSearch from "@/Components/FormSearch.vue";
import { Link } from '@inertiajs/inertia-vue3';



export default {
  name: 'CustomersTable',
  components: {
    Customer,
    AuthenticatedLayout,
    BreadcrumbLink,
    FormSearch,
    Link
  },
  props: ['selectedItems'],
  setup(props, { emit }) {

    const selectAll = ref(false)
    const selected = ref([])

    const checkAll = () => {
      selected.value = []
      if (!selectAll.value) {
        selected.value = customers.value.map(customer => customer.id)
      }
    }

    watch(selected, () => {
      selectAll.value = customers.value.length === selected.value.length ? true : false
      emit('change-selection', selected.value)
    })

    const customers = ref([
      {
        id: '0',
        image: Image01,
        name: 'Patricia Semklo',
        email: 'patricia.semklo@app.com',
        location: '🇬🇧 London, UK',
        orders: '24',
        lastOrder: '#123567',
        spent: '$2,890.66',
        refunds: '-',
        fav: true
      },
      {
        id: '1',
        image: Image01,
        name: 'Dominik Lamakani',
        email: 'dominik.lamakani@gmail.com',
        location: '🇩🇪 Dortmund, DE',
        orders: '77',
        lastOrder: '#779912',
        spent: '$14,767.04',
        refunds: '4',
        fav: false
      },
      {
        id: '2',
        image: Image01,
        name: 'Ivan Mesaros',
        email: 'imivanmes@gmail.com',
        location: '🇫🇷 Paris, FR',
        orders: '44',
        lastOrder: '#889924',
        spent: '$4,996.00',
        refunds: '1',
        fav: true
      },
      {
        id: '3',
        image: Image01,
        name: 'Maria Martinez',
        email: 'martinezhome@gmail.com',
        location: '🇮🇹 Bologna, IT',
        orders: '29',
        lastOrder: '#897726',
        spent: '$3,220.66',
        refunds: '2',
        fav: false
      },
      {
        id: '4',
        image: Image01,
        name: 'Vicky Jung',
        email: 'itsvicky@contact.com',
        location: '🇬🇧 London, UK',
        orders: '22',
        lastOrder: '#123567',
        spent: '$2,890.66',
        refunds: '-',
        fav: true
      },
      {
        id: '5',
        image: Image01,
        name: 'Tisho Yanchev',
        email: 'tisho.y@kurlytech.com',
        location: '🇬🇧 London, UK',
        orders: '14',
        lastOrder: '#896644',
        spent: '$1,649.99',
        refunds: '1',
        fav: true
      },
      {
        id: '6',
        image: Image01,
        name: 'James Cameron',
        email: 'james.ceo@james.tech',
        location: '🇫🇷 Marseille, FR',
        orders: '34',
        lastOrder: '#136988',
        spent: '$3,569.87',
        refunds: '2',
        fav: true
      },
      {
        id: '7',
        image: Image01,
        name: 'Haruki Masuno',
        email: 'haruki@supermail.jp',
        location: '🇯🇵 Tokio, JP',
        orders: '112',
        lastOrder: '#442206',
        spent: '$19,246.07',
        refunds: '6',
        fav: false
      },

    ])

    return {
      selectAll,
      selected,
      checkAll,
      customers,
    }
  }
}
</script>
