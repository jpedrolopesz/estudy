<template>
  <tr>
    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
      <div class="flex items-center">
        <label class="inline-flex">
          <span class="sr-only">Select</span>
          <input :id="customer.id" class="form-checkbox" type="checkbox" :value="value" @change="check" :checked="checked" />
        </label>
      </div>
    </td>
    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
      <div class="flex items-center relative">
        <button>
          <svg class="w-4 h-4 shrink-0 fill-current" :class="customer.fav ? 'text-amber-500' : 'text-slate-300'" viewBox="0 0 16 16">
            <path d="M8 0L6 5.934H0l4.89 3.954L2.968 16 8 12.223 13.032 16 11.11 9.888 16 5.934h-6L8 0z" />
          </svg>
        </button>
      </div>
    </td>
    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
      <div class="flex items-center">
        <div class="w-10 h-10 shrink-0 mr-2 sm:mr-3">
          <img class="rounded-full" :src="customer.image" width="40" height="40" :alt="customer.name" />
        </div>
        <div class="font-medium text-slate-800">{{customer.name}}</div>
      </div>
    </td>
    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
      <div class="text-left">{{customer.email}}</div>
    </td>
    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
      <div class="text-left">{{customer.location}}</div>
    </td>
    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
      <div class="text-center">{{customer.orders}}</div>
    </td>
    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
      <div class="text-left font-medium text-sky-500">{{customer.lastOrder}}</div>
    </td>
    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
      <div class="text-left font-medium text-emerald-500">{{customer.spent}}</div>
    </td>
    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
      <div class="text-center">{{customer.refunds}}</div>
    </td>
    <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap w-px">
      <!-- Menu button -->
      <div class="ml-3 relative">
        <Dropdown align="right" width="28">
          <template #trigger>
            <button class="text-slate-400 hover:text-slate-500 rounded-full">

              <span class="sr-only">Menu</span>
              <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                <circle cx="16" cy="16" r="2" />
                <circle cx="10" cy="16" r="2" />
                <circle cx="22" cy="16" r="2" />
              </svg>
            </button>

          </template>
          <template #content>
              <ul>
                <li>
                  <!--adicionar o admin.id -->
                  <Link :href="route('admins.index')" class="font-medium text-sm text-slate-600 hover:text-slate-800 flex py-1 px-3">
                    Edit
                  </Link>
                </li>
                <li>
                  <Link :href="route('logout')" method="post" class="font-medium text-sm text-rose-500 hover:text-rose-600 flex py-1 px-3">
                    Remove
                  </Link>
                </li>
              </ul>

          </template>
        </Dropdown>
      </div>
    </td>
  </tr>
</template>

<script>
import { computed } from 'vue'
import Dropdown from "@/Components/Dropdown.vue";
import { Link } from '@inertiajs/inertia-vue3';


export default {
  name: 'CustomersTableItem',
  components: {Dropdown, Link},
  props: ['customer', 'value', 'selected'],
  setup(props, context) {
    const checked = computed(() => props.selected.includes(props.value))

    function check() {
      let updatedSelected = [...props.selected]
      if (this.checked) {
        updatedSelected.splice(updatedSelected.indexOf(props.value), 1)
      } else {
        updatedSelected.push(props.value)
      }
      context.emit('update:selected', updatedSelected)
    }

    return {
      check,
      checked,
    }
  },
}
</script>
