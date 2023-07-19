<template>


  <div v-if="!auth.is_subscribed">

    <h2 class="text-3xl mb-2 font-bold leading-tight text-black sm:text-4xl">Payment</h2>

    <form  id="payment-form">
      <div id="card-element" class="border p-4 rounded-md shadow-sm">
      </div>

      <span class="text-sm font-normal">{{errorMessage}}</span>


      <div class="flex items-center justify-between mt-4">
        <slot name="back" />
        <PrimaryButton
          id="card-button"
          type="submit"
          class="ml-4"
        >
          {{ buttonText }}
        </PrimaryButton>

      </div>
    </form>


  </div>
  <div v-else>
    <h2 class="text-3xl mb-2 font-bold leading-tight text-black sm:text-4xl">Update</h2>

    <div class="mt-6">
      <div class="mb-4">

        <div v-if="plan.stripe_id === auth.subscription.stripe_price" >

          <button disabled class="text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-200  font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">
            Already registered in this plan
          </button>


        </div>
        <div v-else>
          <Link  :href="route('paySubscription.update',
           {billing_plan_id: plan.id, plan: plan.stripe_id})" as="button" type="button" method="post"
                  class="text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-200  font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">
            Update
          </Link>
        </div>

      </div>
      <div class="flex items-center mt-5">
        <svg class="flex-shrink-0 w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
        <span class="ml-2 text-sm text-gray-500"> This is a secure checkout, your payment details don't touch our servers.</span>
      </div>
    </div>
  </div>






  <ModalSuccess :show="showModal">
    <div  class="text-center py-3">
      <div class="inline-flex rounded-full bg-green-100 mb-6">
        <CheckCircleIcon class="w-16 h-16 text-green-400"/>
      </div>
      <h1 class="text-3xl text-gray-800 font-semibold mb-2">Congratulations on Your Subscription - Welcome to Our Exclusive Universe!</h1>
      <p class="text-lg text-gray-600 font-smi my-8">Automatic redirect in: <span id="countdownElement"></span> seconds</p>
    </div>
  </ModalSuccess>

</template>

<script>
import { ref, onMounted } from 'vue';
import { loadStripe } from '@stripe/stripe-js';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Inertia} from "@inertiajs/inertia";
import { CheckCircleIcon } from '@heroicons/vue/24/outline'
import ModalSuccess from "@/Components/ModalSuccess.vue";
import {usePage, Link} from "@inertiajs/inertia-vue3";



export default {
  components: {ModalSuccess, PrimaryButton, CheckCircleIcon, Link },
  props: {
    plan: Object,
    stripekey: String,
  },

  setup(props) {
    const {auth} = usePage().props.value;
    const stripe = props.stripekey;
    const errorMessage = ref('');
    const showModal = ref(false);
    const buttonText = ref('Pay Now');


    onMounted(() => {
      // Load Stripe.js
      loadStripe(stripe).then((stripe) => {
        const elements = stripe.elements();
        const style = {
          base: {
            color: '#32325d',
          },
        };

        const card = elements.create('card', {style});
        card.mount('#card-element');

        card.on('change', ({error}) => {
          errorMessage.value = error ? error.message : '';
        });



        const cardButton = document.getElementById('payment-form');
        cardButton.addEventListener('submit', async (event) => {

          event.preventDefault();

          try {
            const { paymentMethod, error } = await stripe.createPaymentMethod(
              'card', card
            );


            if (error) {
              console.log(error.message);
            } else {
              document.getElementById("card-button").disabled = true;

              buttonText.value = 'Loading...';

              const response = await Inertia.post('paySubscription', {
                billing_plan_id: props.plan.id,
                paymentMethod: paymentMethod

              },{
                onSuccess: () => {

                  localStorage.removeItem('tabActive');
                  localStorage.removeItem('selectedOption');

                  showModal.value = true;

                  let countdown = 10;
                  const countdownInterval = setInterval(() => {
                    countdown--;
                    if (countdown <= 0) {
                      clearInterval(countdownInterval);
                      window.location.href = '/courses';
                    }
                    document.getElementById('countdownElement').textContent = countdown;
                  }, 1000);
                }
              })
            }
          } catch (error) {
            console.error('Error in request:', error);
          }
        });
      });
    })




    return {showModal, buttonText, errorMessage, auth }

  }

}


</script>
