<template>
  <Head  title="Plans" />

  <AuthenticatedUserLayout>

    <template #header>
      <h2 class="font-medium text-2xl lg:text-3xl opacity-75">Account Settings</h2>
    </template>

    <AccountUserLayout>

      <div class="mt-5 md:col-span-2 md:mt-0">
        <header>
          <h2 class="text-lg ml-5 mt-2.5 font-medium text-gray-900">Plans</h2>

          <p class="mt-1 ml-5 text-sm text-gray-600">
            If you wish to keep using the application, please choose a subscription plan below.
          </p>
        </header>

        <div class="flex ml-5 mt-5">

          <div class="text-sm mr-2 text-gray-500 font-medium">Monthly</div>
          <label class="inline-flex relative items-center cursor-pointer">
            <input type="checkbox" @click="planSelect = !planSelect" class="sr-only peer">
            <div class="w-11 h-6 bg-gray-100 peer-focus:outline-none   rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gray-600"></div>
          </label>
          <div class="text-sm ml-2 text-gray-500 font-medium">Annually <span class="text-emerald-500">(-20%)</span></div>

        </div>



        <div v-if="planSelect">
          <div class="my-5 mx-4 grid grid-cols-12 gap-6">
            <div v-for=" plan in plansMonthly" class="col-span-full xl:col-span-4 bg-white ">
              <div class="shadow-md rounded-lg border border-gray-150">

                <div class="px-5 pt-5 pb-6 ">
                  <header class="flex items-center mb-2">

                   <!-- @if (tenant()->subscribedToPrice($plan->stripe_id, 'default')) -->

                    <h3 class="text-lg text-slate-800 font-semibold">{{plan.name}}</h3>
                  </header>
                  <div class="text-sm mb-2">Ideal for individuals that need a custom solution with custom tools.</div>
                  <!-- Price -->
                  <div class="text-slate-800 font-bold mb-4">
                    <span class="text-3xl">
                     ${{plan.price}}</span>
                    <span class="text-slate-500 font-medium text-sm">
                    /{{plan.slug}}</span>
                  </div>

                  <Link :href="route('subscription.subscription', plan.id)"  class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200  font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">
                    Choose plan
                  </Link>

                  <!-- CTA
                  <div class="">
                    @if (tenant()->subscribedToPrice($plan->stripe_id, 'default'))
                    @if (!tenant()->subscription( 'default')->cancelled())
                    <form action="{{route('tenant.subscription.cancel')}}"  method="post">
                      @csrf

                      <button class="btn border-slate-200 bg-red-500 text-white w-full flex items-center" >
                        Cancel Plan</button>
                    </form>
                    @endif
                    @if (tenant()->subscription('default')->cancelled())
                    <a  href="{{route('tenant.subscription.subscription',$plan->id)}}" type="button" class="btn bg-gray-300 hover:bg-indigo-600 text-white w-full ">
                      Reactivate
                    </a>
                    @endif
                    @else
                    @if (!tenant()->subscription('default'))
                    <a  href="{{route('tenant.subscription.subscription',$plan->id)}}" type="button" class="btn bg-indigo-500 hover:bg-indigo-600 text-white w-full">
                      Subscription
                    </a>
                    @endif
                    @if(tenant()->subscription('default'))

                    <form  method="post">

                      <button name="plan" id="plan" value="{{plan.stripe_id}}"
                              class="btn bg-indigo-500 hover:bg-indigo-600 text-white w-full">
                        Update Plan
                      </button>


                    </form>
                    @endif
                    @endif
                  </div>
                  -->
                </div>
                <div class="flex items-center px-5 ">
                  <h4 class="flex-shrink-0 pr-4 bg-white text-xs leading-5 tracking-wider font-semibold uppercase text-gray-700">
                    What&#x27;s included
                  </h4>
                  <div class="flex-1 border-t-2 border-gray-200">
                  </div>
                </div>
                <div class="px-5 pt-4 pb-5">
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
                    </ul>

                  <ul v-for="detail in plan.detail">

                    <li class="flex items-center py-1">
                      <svg class="w-3 h-3 shrink-0 fill-current text-emerald-500 mr-2" viewBox="0 0 12 12">
                        <path d="M10.28 1.28L3.989 7.575 1.695 5.28A1 1 0 00.28 6.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 1.28z" />
                      </svg>
                      <div class="text-sm">{{detail.name}}</div>
                    </li>
                  </ul>
                </div>
              </div>

            </div>
          </div>
        </div>






        <h1 v-else>Oh no 😢</h1>

      </div>









      <div v-if="permissions">
        <h1>Hello</h1>
      </div>





    </AccountUserLayout>
  </AuthenticatedUserLayout>

</template>

<script>
import AuthenticatedUserLayout from "../../Layouts/Dashboard/AuthenticatedUserLayout.vue";
import AccountUserLayout from "../../Layouts/Account/AccountUserLayout.vue";
import {Link, Head, useForm} from "@inertiajs/inertia-vue3";
import { ref } from 'vue'


export default {
  components: {
    AuthenticatedUserLayout,
    AccountUserLayout,
    Link, Head,
  },
  data() {
    return {
      planSelect: true
    }
  },
  setup(props){

    const enabled = ref(false)

    const form = useForm({
      name: props.plansMonthly.name,

    });
    return {form};
  },
  props:{
    plansMonthly:Object,
    permissions:Object
  },
  }
</script>
