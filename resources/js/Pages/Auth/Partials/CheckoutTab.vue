<template>

  <h2  class="text-3xl font-bold leading-tight text-black sm:text-4xl">Payment</h2>

  <form id="payment-form">
    <div id="card-element">
      <!-- Elements will create input elements here -->
    </div>

    <!-- We'll put the error messages in this element -->
    <div id="card-error" role="alert"></div>



    <div class="flex items-center justify-between mt-4 ">
      <slot name="back"/>
      <PrimaryButton id="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="ml-4">
        Pay Now
      </PrimaryButton>
    </div>
  </form>

</template>


<script setup>

import {onMounted, ref} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
  intent: Object,
  stripekey: [Object, Array]
});

console.log(props.stripekey);

let stripe = null;
let elements = null;
let card = null;
const isProcessing = ref(false);

const form = useForm({
  payment_intent: null,
});

onMounted(() => {
  stripe = Stripe("pk_test_51MJyvCEAgQFECaeFNpasPUKYvx51hoIWXHmxQ6rGgMfPL4yMCRgV9qSKEWyySZFV9OoMr4MMUgCdptNNosBCONOC00lJpTdaC5");

  elements = stripe.elements();
  const style = {
    base: {
      color: "#32325d",
      fontFamily: 'Arial, sans-serif',
      fontSmoothing: "antialiased",
      fontSize: "16px",
      "::placeholder": {
        color: "#32325d"
      }
    },
    invalid: {
      fontFamily: 'Arial, sans-serif',
      color: "#fa755a",
      iconColor: "#fa755a"
    }
  };

  card = elements.create("card", { style });
  card.mount("#card-element");

  card.on("change", (event) => {
    const button = document.querySelector("button");
    button.disabled = event.empty;
    document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
  });

  const paymentForm = document.getElementById("payment-form");
  paymentForm.addEventListener("submit", (event) => {
    event.preventDefault();
    payWithCard(stripe, card, props.intent.client_secret);
  });
});

const payWithCard = (stripe, card, clientSecret) => {
  loading(true);
  stripe
    .confirmCardPayment(clientSecret, {
      payment_method: {
        card
      },
    })
    .then((result) => {
      if (result.error) {
        showError(result.error.message);
      } else {}
    });
};

</script>


<style>
#card-element {
  border-radius: 4px 4px 0 0 ;
  padding: 12px;
  border: 1px solid rgba(50, 50, 93, 0.1);
  height: 44px;
  width: 100%;
  background: white;
}

#payment-request-button {
  margin-bottom: 32px;
}
</style>
