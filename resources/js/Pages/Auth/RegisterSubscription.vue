<template>
  <Head title="Register" />

  <div class="grid grid-cols-1 h-screen lg:grid-cols-2">

    <div class="flex items-center justify-center px-4  bg-white sm:px-6 lg:px-8 sm:py-6 ">

      <div class="w-full ">
        <div class="flex items-center justify-between h-16 -mb-px">

          <a class="block rounded-full p-1 bg-gray-100 text-gray-500 hover:text-gray-600"
             href="/">
            <span class="sr-only">Back</span>

            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>

          </a>
        </div>


        <div  class="px-4 pt-12 pb-8">
          <div class="max-w-md mx-auto w-full">
            <TabGroup :selectedIndex="selectedTab" @change="changeTab">
              <TabList class="relative">
                <div class="absolute flex left-0 top-1/2 -mt-px w-full h-0.5 bg-gray-200">
                  <ul class="relative flex -mt-2.5 justify-between w-full">
                    <Tab v-for="(tab, index) in tabs" :key="index" as="li" v-slot="{ selected }">
                      <button
                        :class="[ selected ? 'bg-gray-600 text-gray-100' : 'text-gray-500 hover:bg-gray/[0.12] hover:text-gray-600']"
                        :disabled="selectedTab < index"
                        class="flex items-center justify-center bg-gray-100 border border-gray-300 w-6 h-6 rounded-full text-xs font-semibold text-gray-100">
                        {{ tab }}
                      </button>
                    </Tab>
                  </ul>
                </div>
              </TabList>
              <TabPanels class="py-10">

                <!-- TAB 1 -->
                <TabPanel>
                    <form>
                      <div v-if="auth.user">
                        <h1 class="text-2xl text-center text-gray-800 font-semibold mb-6">Choose Your Path: Continue with Your Account or Create a New One.</h1>


                        <label class="flex-1 mb-4 relative block cursor-pointer">
                          <input @click="selectedOption = 'payment'" type="radio"
                                 name="radio-buttons" class="peer sr-only"  />
                          <div class="h-full text-center bg-white  rounded border border-gray-200 hover:border-gray-300 shadow-sm duration-150 ease-in-out">

                            <div class="flex items-center p-2">
                              <img class="flex-shrink-0 object-cover w-10 h-10 rounded-full" :src="'/storage/' + auth.user.photo" />
                              <div class="ml-4">
                                <p class="text-start font-semibold text-gray-600">{{auth.user.first_name}}</p>
                                <p class="mt-px text-sm text-gray-400">{{ auth.user.email }}</p>
                              </div>
                            </div>
                          </div>
                          <div class="absolute inset-0 border-2 border-transparent peer-checked:border-gray-400 rounded pointer-events-none" aria-hidden="true"></div>
                        </label>
                      </div>

                      <div v-else>
                        <div class="text-2xl text-center text-gray-800 font-semibold mb-6">
                          Take Control of Your Destiny: Sign In or Register.</div>

                        <div class="sm:flex space-y-3 sm:space-y-0 sm:space-x-4 mb-8">
                          <label class="flex-1 relative block cursor-pointer">
                            <input @click="selectedOption = 'login'" type="radio"
                                   name="radio-buttons" class="peer sr-only"  />
                            <div class="h-full text-center bg-white px-4 py-6 rounded border border-gray-200 hover:border-gray-300 shadow-sm duration-150 ease-in-out">

                              <div class="font-semibold text-2xl text-gray-800 mb-1">Login</div>
                              <div class="text-sm">Quick and easy access</div>
                            </div>
                            <div class="absolute inset-0 border-2 border-transparent peer-checked:border-gray-400 rounded pointer-events-none" aria-hidden="true"></div>
                          </label>
                          <label class="flex-1 relative block cursor-pointer">
                            <input @click="selectedOption = 'register'"
                                   type="radio" name="radio-buttons" class="peer sr-only" />
                            <div class="h-full text-center bg-white px-4 py-6 rounded border border-gray-200 hover:border-gray-300 shadow-sm duration-150 ease-in-out">

                              <div class="font-semibold text-2xl text-gray-800 mb-1">Register</div>
                              <div class="text-sm">Sign up now</div>
                            </div>
                            <div class="absolute inset-0 border-2 border-transparent peer-checked:border-gray-400 rounded pointer-events-none" aria-hidden="true"></div>
                          </label>
                        </div>



                      </div>

                      <div class="flex items-center justify-between">

                        <button @click="logout" v-if="auth.user" class="underline" >
                          Log Out
                        </button>
                        <div></div>

                        <PrimaryButton @click="completeStep(1)" :disabled="!selectedOption" class="ml-4">
                          Next Step <ChevronRightIcon class="w-4 h-4"/>
                        </PrimaryButton>
                      </div>
                    </form>

                </TabPanel>

                <!-- TAB 2 -->
                 <TabPanel>
                   <div v-if="!auth.user">
                     <LoginCheckoutTab
                       v-if="selectedOption === 'login'"
                       @option-selected="handleOptionSelected"
                       v-bind:selected-option="selectedOption"
                     >
                       <template #login>
                         <button @click="backTab" class="underline">Back</button>

                         <PrimaryButton  @click="completeStep(2)" v-if="auth.user" type="button"  :disabled="!selectedOption"  class="ml-4">
                           Next Step <ChevronRightIcon class="w-4 h-4"/>
                         </PrimaryButton>
                       </template>
                     </LoginCheckoutTab>
                   </div>

                   <div v-if="!auth.user">
                     <RegisterCheckoutTab
                       v-if="selectedOption === 'register'"
                       @option-selected="handleOptionSelected"
                       v-bind:selected-option="selectedOption"
                     >
                       <template #register>
                         <button @click="backTab" class="underline">Back</button>
                         <PrimaryButton @click="completeStep(2)" v-if="auth.user" :disabled="!selectedOption"  class="ml-4">
                           Next Step <ChevronRightIcon class="w-4 h-4"/>
                         </PrimaryButton>
                       </template>
                     </RegisterCheckoutTab>
                   </div>


                   <div v-if="auth.user">
                     <div  class="text-center py-3">

                       <div class="inline-flex rounded-full bg-gray-100 mb-6">
                         <CheckCircleIcon class="w-16 h-16 text-gray-600"  />
                       </div>
                       <h1 class="text-3xl text-gray-800 font-semibold mb-2">You're one step away from securing your purchase!</h1>
                       <p class="text-lg text-gray-600 font-normal mb-8">Congratulations on authenticating! Proceed to payment and get your product now.</p>
                     </div>


                     <div class="flex items-center justify-between mt-4">

                       <button @click="backTab" class="underline">Back</button>
                       <PrimaryButton @click="completeStep(2)"  :disabled="!selectedOption"  class="ml-4">
                         Next Step <ChevronRightIcon class="w-4 h-4"/>
                       </PrimaryButton>

                     </div>
                   </div>



                </TabPanel>

                <!-- TAB 3 -->
                 <TabPanel>
                  <CheckoutTab
                    v-if="auth.user"
                    :stripekey="stripekey"
                    :plan="plan"
                  >
                    <template #back>
                      <button @click="backTab" class="underline">Back</button>

                    </template>
                  </CheckoutTab>

                 </TabPanel>



              </TabPanels>
            </TabGroup>

          </div>
        </div>


      </div>

    </div>



    <section class="py-10 bg-gray-900 sm:py-16 shadow-l-lg lg:py-24">

      <div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:items-stretch md:grid-cols-2 gap-x-12 lg:gap-x-20 gap-y-10">
          <div v-if="!auth.is_subscribed" class="flex flex-col justify-between lg:py-5">
            <h2 class="text-2xl font-bold leading-tight text-white sm:text-4xl lg:leading-tight lg:text-3xl">Join the pros and be part of something fantastic</h2>

            <div class="mt-4">
              <div class="flex items-center">
                <svg class="w-6 h-6 text-orange-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                  />
                </svg>
                <svg class="w-6 h-6 text-orange-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                  />
                </svg>
                <svg class="w-6 h-6 text-orange-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                  />
                </svg>
                <svg class="w-6 h-6 text-orange-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                  />
                </svg>
                <svg class="w-6 h-6 text-orange-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                  />
                </svg>
              </div>

              <div class="mt-6">
                <p class="text-md leading-relaxed text-white">You made it so simple. Studying with you became much faster and easier than the old teaching system.</p>
              </div>

              <div class="flex items-center mt-8">
                <img class="flex-shrink-0 object-cover w-10 h-10 rounded-full" src="/storage/user/default.png" />
                <div class="ml-4">
                  <p class="text-base font-semibold text-white">João Zamopeteer</p>
                  <p class="mt-px text-sm text-gray-400">Digital Marketer</p>
                </div>
              </div>
            </div>
          </div>


          <div v-else>

            <div v-if="plan.stripe_id === auth.subscription.stripe_price" >
              <h2 class="text-2xl font-bold leading-tight text-white sm:text-4xl lg:leading-tight lg:text-3xl">This is your current plan. To update your plan, you must choose another plan.</h2>


              <ModalPlans>
                <template #plans>
                  <button  class="mt-4 text-gray-800 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200  font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">
                    Choose another plan
                  </button>
                </template>

                <Plans
                  :plans="plans"
                  :plansMonthly="plansMonthly"
                  :plansYearly="plansYearly"
                />
              </ModalPlans>

            </div>

            <h2 v-if="plan.stripe_id != auth.subscription.stripe_price" class="text-2xl font-bold leading-tight text-white sm:text-4xl lg:leading-tight lg:text-3xl">
              Your current plan will be replaced after updating to the desired new plan.
            </h2>

          </div>
          <div >
            <div class="overflow-hidden bg-white rounded-md">
              <div class="px-4 my-12">
                <h3 class="text-xs font-semibold tracking-widest text-black uppercase">{{plan.name}}</h3>
                <div class="flex items-center text-gray-800 font-bold mb-4">
                  <div class="text-lg">
                    {{plan.price_currency}} <span class="text-3xl ml-0.5">{{plan.price}}</span></div>
                  <span class="text-gray-500 mt-2 font-medium text-sm">
                    /{{plan.slug}}</span>
                </div>
                <div class="text-xs mt-2 font-normal leading-tight text-gray-500">
                  Automatically renews after the cycle.
                </div>


                <div class="flex mt-8 items-center">
                  <h4 class="flex-shrink-0 pr-4 bg-white text-xs leading-5 tracking-wider font-semibold uppercase text-gray-700">
                    What&#x27;s included
                  </h4>
                  <div class="flex-1 border-t-2 border-gray-200">
                  </div>
                </div>
                <div class="mt-6">
                  <!-- List -->
                  <ul role="list" class="space-y-5 ">
                    <li class="flex space-x-3">
                      <!-- Icon -->
                      <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4 text-emerald-500 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check icon</title><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                      <span class="text-base font-normal leading-tight text-gray-500 ">2 team members</span>
                    </li>
                    <li class="flex space-x-3">
                      <!-- Icon -->
                      <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4 text-emerald-500 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check icon</title><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                      <span class="text-base font-normal leading-tight text-gray-500 ">20GB Cloud storage</span>
                    </li>
                    <li class="flex space-x-3">
                      <!-- Icon -->
                      <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4 text-emerald-500 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check icon</title><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                      <span class="text-base font-normal leading-tight text-gray-500 ">20GB Cloud storage</span>
                    </li>
                    <li class="flex space-x-3">
                      <!-- Icon -->
                      <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4 text-emerald-500 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check icon</title><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                      <span class="text-base font-normal leading-tight text-gray-500 ">20GB Cloud storage</span>
                    </li>
                  </ul>


                  <div class="flex items-center mt-8">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span class="ml-2 text-sm text-gray-500"> This is a secure checkout, your payment details don't touch our servers.</span>
                  </div>
                </div>

              </div>


            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

</template>

<script setup>
import {onBeforeMount, onBeforeUnmount, ref} from "vue";
import {Head, useForm, usePage} from '@inertiajs/inertia-vue3';
import {CheckCircleIcon, ChevronRightIcon } from '@heroicons/vue/24/solid';
import {TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
import CheckoutTab from "@/Pages/Auth/Partials/CheckoutTab.vue";
import LoginCheckoutTab from "./Partials/LoginCheckoutTab.vue";
import RegisterCheckoutTab from "./Partials/RegisterCheckoutTab.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Inertia} from "@inertiajs/inertia";
import Plans from "@/Pages/Home/Partials/Plans.vue";
import ModalSuccess from "@/Components/ModalSuccess.vue";
import Modal from "@/Components/Modal.vue";
import ModalPlans from "@/Components/ModalPlans.vue";


const props = defineProps({
  plan: Object,
  stripekey: String,
  plans:Object,
  plansMonthly:Object,
  plansYearly:Object
});


const form = useForm({});
const tabs = ref([1, 2, 3]);

const selectedTab = ref(localStorage.getItem('tabActive') || null);

const selectedOption = ref(localStorage.getItem('selectedOption') || null);
const { auth } = usePage().props.value;

function completeStep(index) {
  if (selectedOption.value === 'login' || selectedOption.value === 'register') {
    if (auth.user) {
      selectTab(2);
    } else {
      selectTab(1);
      localStorage.removeItem('tabActive');
      localStorage.removeItem('selectedOption');
    }
  } else if (selectedOption.value === 'payment') {
    selectTab(2);
  }
}

function selectTab(tabIndex) {
  if (!auth.user && tabIndex === 2) {
    tabIndex = 1;
    localStorage.removeItem('tabActive');
    localStorage.removeItem('selectedOption');
  } else if (tabIndex === 3) {
    return;
  }

  localStorage.setItem('tabActive', tabIndex);
  localStorage.setItem('selectedOption', selectedOption.value);
  selectedTab.value = tabIndex;
}

onBeforeMount(() => {
  const tabActive = localStorage.getItem('tabActive');
  const selectedOption = localStorage.getItem('selectedOption');

  if (tabActive === null || tabActive === undefined || selectedOption === null || selectedOption === undefined) {
    selectTab(0);
    localStorage.setItem('tabActive', 0);
  }

  if (!auth.user && tabActive === '2') {
    selectTab(0);
    Inertia.reload();
  }
});

onBeforeUnmount(() => {
  localStorage.removeItem('tabActive');
  localStorage.removeItem('selectedOption');
});




const changeTab = (index) => { selectedTab.value = index};
const backTab = () => { selectedTab.value -= 1 };

function handleOptionSelected(option) { selectedOption.value = option }

const logout = () => { form.post(route('logout.noRedirect'),{
    preserveScroll: true,
  });
}

</script>



