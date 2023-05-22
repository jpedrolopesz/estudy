<template>
  <Combobox v-model="selectedItem"
            class="flex-1 relative flex flex-col items-center justify-center">
    <div>
      <div
        class="relative w-full text-gray-400 focus-within:text-gray-600"
      >
        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none" aria-hidden="true">
          <MagnifyingGlassIcon class="h-5 w-5 " aria-hidden="true" />
        </div>
        <ComboboxInput
          placeholder="Search courses and users"
          :displayValue="(item) => item?.name"
          class="block border-gray-300 text-gray-900 text-sm rounded-md p-2 w-full border-gray-100 bg-transparent py-1 pl-10 pr-4 placeholder-gray-500 focus:ring-gray-300 focus:border-gray-300"
          @change="query = $event.target.value"
        />
      </div>
      <TransitionRoot
        leave="transition ease-in duration-100"
        leaveFrom="opacity-100"
        leaveTo="opacity-0"
        @after-leave="query = ''"
      >
        <ComboboxOptions
          class="absolute inset-x-0 mt-3 max-h-60 w-full overflow-y-auto rounded-b-lg bg-white/80 shadow-2xl ring-1 ring-black ring-opacity-5 backdrop-blur backdrop-filter transition-all"
        >
          <div
            v-if="searchResults.length === 0 && query !== ''"
            class="relative text-center cursor-default select-none py-6 px-4 text-gray-700"
          >
            No results matching your search.
          </div>
          <ComboboxOption
            v-for="item in searchResults"
            as="template"
            :key="item.id"
            :value="item"
            v-slot="{ selected, active }"
          >
            <Link :href="item.link"
                  class="relative flex select-none items-center p-2 text-gray-900"
                  :class="{ 'bg-dark-100 text-white': active}">
              <div v-if="item.type==='PROJECT'"
                   :class="['flex h-6 w-6 flex-none items-center justify-center rounded-lg', `bg-${item.color}-600`]">
                <component :is="iconPicker[item.icon]" class="h-4 w-4 text-white" aria-hidden="true" />
              </div>
              <div v-else-if="item.type==='TASK'"
                   :class="['flex h-6 w-6 flex-none items-center justify-center rounded-lg', `bg-${item.color}-600`]">
                <CheckCircleIcon class="h-4 w-4 text-white" aria-hidden="true" />
              </div>
              <div v-else-if="item.type==='USER'"
                   :class="['flex h-6 w-6 flex-none items-center justify-center rounded-lg', `bg-${item.color}-600`]">
                <img :src="item.avatar" class="h-6 w-6 rounded-full" alt="" />
              </div>
              <div class="ml-4 flex-auto flex items-center">
                <p class="text-md font-medium text-gray-700">
                  {{ item.name }}
                </p>
                <p class="text-dark-500 ml-auto text-xxs">
                  {{ item.type }}
                </p>
              </div>
            </Link>
          </ComboboxOption>
        </ComboboxOptions>
      </TransitionRoot>
    </div>
  </Combobox>
</template>

<script setup>
import {
  Combobox,
  TransitionRoot,
  ComboboxInput,
  ComboboxOptions,
  ComboboxOption
} from "@headlessui/vue";
import { MagnifyingGlassIcon, CheckCircleIcon } from "@heroicons/vue/24/outline";
import { onMounted, onUnmounted, ref, watch } from "vue";
import { usePage, Link } from "@inertiajs/inertia-vue3";
import { debounce } from "lodash";
import {Inertia} from "@inertiajs/inertia";

const { auth } = usePage().props;
const query = ref("");
const searchResults = ref([]);
const isMobile = ref(false);
const selectedItem = ref(null);

watch(() => query.value, (_) => {
  search();
});

watch(() => selectedItem.value, (value) => {
  if (value && value.link) {
    Inertia.get(value?.link);
    selectedItem.value = null;
  }
});

function onKeyDown(event) {
  if ((event.metaKey || event.ctrlKey) && event.key === "k") {
    isOpen.value = true;
  }
}

function handleSelectedItemChange() {
  console.log(selectedItem.value);
}

const search = debounce(() => {
  if (!query.value || query.value?.length < 2) return;
  axios.get(route("search", { q: query.value }))
    .then(response => searchResults.value = response.data?.results)
    .catch(error => console.log(error));
}, 200);


onMounted(() => {
  window.addEventListener("keydown", onKeyDown);
});

onUnmounted(() => {
  window.removeEventListener("keydown", onKeyDown);
  const platform =
    navigator?.userAgentData?.platform || navigator?.platform || "unknown";
  isMobile.value = /(Mac|iPhone|iPod|iPad)/i.test(platform);
});
</script>

<style scoped>

</style>
