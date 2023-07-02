<template>
  <div class="group relative m-auto">
      <div class="absolute top-0 h-full w-full rounded-3xl border border-gray-100 bg-white shadow-2xl shadow-gray-600/10  transition duration-500 group-hover:scale-105 lg:group-hover:scale-110"
      ></div>
      <div class="relative sm:flex">
        <div class="space-y-8 p-8 pb-20 sm:w-7/12 sm:pb-8">
          <div class="flex items-center justify-between">
            <h5 class="text-xl font-semibold text-gray-700">{{selected.name}}</h5>

            <div class="relative flex justify-around">
              <div class="flex">
                <div class="text-gray-800 font-bold">
                  <span class="text-4xl">${{selected.price}}</span>
                  <span class="text-slate-500 font-medium text-sm">/{{selected.slug}}</span>
                </div>
              </div>
            </div>
          </div>

          <p class="text-start text-sm mb-2 text-gray-600 ">
            {{ selected.description}}
          </p>
          <div class="absolute inset-x-0 bottom-6 w-full px-6 sm:static sm:px-0">
            <Link :href="route('register.subscription', selected.id)"
                  class="relative flex h-11 w-full items-center justify-center px-6 before:absolute before:inset-0 before:rounded-lg before:bg-gray-800 before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
              <span class="relative text-base font-semibold text-white ">Start plan</span>
            </Link>
          </div>

          <div class="flex items-center ">
            <h4 class="flex-shrink-0 pr-4 bg-white text-xs leading-5 tracking-wider font-semibold uppercase text-gray-700">
              What&#x27;s included
            </h4>
            <div class="flex-1 border-t-2 border-gray-200"></div>

          </div>
          <ul role="list" class="space-y-5 ">
            <li class="flex space-x-3">
              <!-- Icon -->
              <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4 text-gray-500 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check icon</title><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
              <span class="text-base font-normal leading-tight text-gray-500 ">{{selected.max_users}} spectator</span>
            </li>
            <li class="flex space-x-3">
              <!-- Icon -->
              <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4 text-gray-500 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check icon</title><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
              <span class="text-base font-normal leading-tight text-gray-500 ">20 Courses</span>
            </li>
          </ul>
        </div>

        <div class="-mt-16 pb-20 sm:mt-0 sm:w-5/12 sm:pb-0 ">
          <div
            class="relative h-full before:absolute before:left-0 before:top-1 before:my-auto before:h-0.5 before:w-full before:rounded-full before:bg-gray-200 dark:before:bg-gray-700 sm:pt-0 sm:before:inset-y-0 sm:before:h-[85%] sm:before:w-0.5"
          >

            <div class="relative -mt-1 h-full overflow-x-auto pt-7 pb-6 sm:-ml-1 sm:pl-1 overflow-y-hidden">


              <div class="w-full px-4">
                <h2 class="text-lg ml-5 mt-2.5 font-medium text-gray-900">Plans</h2>

                <p  class="mt-1 ml-5 text-sm text-gray-600">
                  If you wish to keep using the application please choose a subscription plan below.

                </p>
                <div class="flex ml-5 my-5">


                  <div class="text-sm mr-2 text-gray-500 font-medium">Monthly</div>
                  <label class="inline-flex relative items-center cursor-pointer">
                    <input type="checkbox" @click="planSelect = !planSelect" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-100 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gray-600"></div>
                  </label>
                  <div class="text-sm ml-2 text-gray-500 font-medium">Annually <span class="text-emerald-500">(-20%)</span></div>

                </div>
                <div class="mx-auto w-full max-w-md">
                  <div v-if="planSelect">
                    <RadioGroup v-model="selected">
                      <div class="space-y-2">
                        <RadioGroupOption as="template"
                                          v-for="plan in plansMonthly" :key="plan.name" :value="plan" v-slot="{ active, checked }">

                          <div :class="[ active  ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-gray-300'
                           : '',  checked ? 'bg-white border-2 border-gray-900 text-gray-700 ' : 'bg-white ']"
                               class="relative flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none">
                            <div class="flex w-full items-center justify-between">
                              <div class="flex items-center">
                                <div class="text-sm">
                                  <RadioGroupLabel as="p" :class="checked ? 'text-gray-700' : 'text-gray-900'" class="font-medium">
                                    <span>{{plan.name}}</span>
                                    <span class="font-medium text-gray-400 text-xs">
                                           /{{plan.slug}}</span>
                                  </RadioGroupLabel>
                                  <RadioGroupDescription
                                    as="span"
                                    :class="checked ? 'text-gray-100' : 'text-gray-500'"
                                    class="inline"
                                  >
                                      <span class="text-xs font-normal leading-tight text-gray-500 ">
                                        {{plan.max_users}} Spectator
                                      </span>

                                  </RadioGroupDescription>
                                </div>
                              </div>
                              <svg v-if="checked" class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <circle
                                  cx="12"
                                  cy="12"
                                  r="12"
                                  fill="black"
                                  fill-opacity="0.7"
                                />
                                <path
                                  d="M7 13l3 3 7-7"
                                  stroke="#fff"
                                  stroke-width="2"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </svg>

                            </div>
                          </div>
                        </RadioGroupOption>
                      </div>
                    </RadioGroup>

                  </div>
                  <div v-else>
                    <RadioGroup v-model="selected">
                      <div class="space-y-2">
                        <RadioGroupOption as="template" v-for="plan in plansYearly" :key="plan.name" :value="plan" v-slot="{ active, checked }">
                          <div :class="[ active  ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-gray-300'
                           : '',  checked ? 'bg-white border-2 border-gray-900 text-gray-700 ' : 'bg-white ']"
                               class="relative flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none">
                            <div class="flex w-full items-center justify-between">
                              <div class="flex items-center">
                                <div class="text-sm">
                                  <RadioGroupLabel as="p" :class="checked ? 'text-gray-700' : 'text-gray-900'" class="font-medium">
                                    <span>{{plan.name}}</span>
                                    <span class="font-medium text-gray-400 text-xs">
                                           /{{plan.slug}}</span>
                                  </RadioGroupLabel>
                                  <RadioGroupDescription
                                    as="span"
                                    :class="checked ? 'text-gray-100' : 'text-gray-500'"
                                    class="inline"
                                  >
                                      <span class="text-xs font-normal leading-tight text-gray-500 ">
                                        {{plan.max_users}} Spectator
                                      </span>

                                  </RadioGroupDescription>
                                </div>
                              </div>
                              <svg v-if="checked" class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <circle
                                  cx="12"
                                  cy="12"
                                  r="12"
                                  fill="black"
                                  fill-opacity="0.7"
                                />
                                <path
                                  d="M7 13l3 3 7-7"
                                  stroke="#fff"
                                  stroke-width="2"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                />
                              </svg>

                            </div>
                          </div>
                        </RadioGroupOption>
                      </div>
                    </RadioGroup>

                  </div>



                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>


<script setup>
import {ref, defineProps} from "vue";
import {RadioGroup, RadioGroupDescription, RadioGroupLabel, RadioGroupOption} from "@headlessui/vue";
import {Link} from '@inertiajs/inertia-vue3';


const props = defineProps({
  plans: Object,
  plansMonthly:Object,
  plansYearly:Object,
})


const planSelect = ref(true)
const selected = ref(props.plans[0])
</script>
