<template>
  <form  id="payment-form">
    <div id="card-element">
      <!-- Elements will create input elements here -->
    </div>

    <!-- We'll put the error messages in this element -->
    <div id="card-error" role="alert"></div>


    <div class="flex items-center justify-between mt-4">
      <slot name="back" />
      <PrimaryButton
        id="card-button"
        type="submit"
        class="ml-4"
      >
        Pay Now
      </PrimaryButton>

    </div>
  </form>
</template>

<script>
import { ref, onMounted } from 'vue';
import { loadStripe } from '@stripe/stripe-js';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Inertia} from "@inertiajs/inertia";

export default {
  components: { PrimaryButton },
  props: {
    intent: Object,
    plan: Object,
    stripekey: String
  },
  setup(props) {
    const stripe = props.stripekey;
    const errorMessage = ref('');

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
              const response = await Inertia.post('paySubscription', {
                billing_plan_id: props.plan.id,
                paymentMethod: paymentMethod
              });

              if (response && response.data) {
                const { data } = response;

                if (data.error) {
                  console.log(data.error.message);
                } else {
                  if (data.paymentIntent.status === 'succeeded') {

                  }
                }
              }
            }
          } catch (error) {
            console.error('Erro na solicitação:', error);
          }
        });

      });
    })
    }
}


</script>
