@extends('guest')



<section>

  <div class="grid grid-cols-1 lg:grid-cols-2">

    <div class="flex items-center justify-center px-4 py-10 bg-white sm:px-6 lg:px-8 sm:py-16 lg:py-24">

      <div class="xl:w-full my-6  xl:max-w-sm 2xl:max-w-md xl:mx-auto">
        <div class="flex items-center justify-between h-16 -mb-px">

          <a class="block rounded-full p-1 bg-slate-100 text-slate-500 hover:text-slate-600"
             href="/plans">
            <span class="sr-only">Back</span>

            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>

          </a>
        </div>


        @if(!auth()->user()->subscribed('default'))

          <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl">Checkout</h2>


          <form action="{{ route('subscription.process', $plan->id )}}" method="post" id="card-form">
                @csrf

                <!-- Card form -->
                <div class="space-y-4">

                  <input type="hidden" name="billing_plan_id" value="{{ $plan->id}}" />
                  <input type="hidden" name="payment-method" id="payment-method"  value="" />
                  <!-- Name on Card -->
                  <div>
                    <label class="block text-sm text-slate-500 font-medium mb-3" for="card-name">Name on Card<span class="text-rose-500">*</span></label>
                    <input type="text" id="card-holder-name" name="card-holder-name" class="appearance-none block w-full px-3 py-2 border border-gray-100 shadow-md rounded-md placeholder-gray-500 focus:outline-none focus:ring-gray focus:border-gray-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" placeholder="Name on card" />
                  </div>

                  <!-- Card Number -->
                  <label class="block text-sm text-slate-500 font-medium" for="card-name">Card Number<span class="text-rose-500">*</span></label>
                  <div class="appearance-none block w-full px-3 py-2 border border-gray-100 shadow-md rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-gray-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" id="card-element"></div>

                  <input type="hidden" name="plan" value="{{request('plan')}}"/>

                </div>
                <!-- Form footer -->
                <div class="mt-6">
                  <div class="mb-4">
                    <button id="card-button" data-secret="{{$intent->client_secret}}" type="submit"
                            class="text-white bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200  font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">Pay ${{number_format($plan->price / 100,2)}}</button>
                  </div>
                  <div class="flex items-center mt-5">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span class="ml-2 text-sm text-gray-500"> This is a secure checkout, your payment details don't touch our servers.</span>
                  </div>
                </div>


              </form>



            @endif

        @if(auth()->user()->subscribed('default'))

          <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl">Update plan</h2>
          <form action="{{ route('subscription.subscription.update' )}}" method="post" id="card-form">
                  @csrf



                  <!-- Form footer -->
                  <div class="mt-6">
                    <div class="mb-4">
                      <button name="plan" id="plan" value="{{$plan->stripe_id}}" type="submit"
                              class="text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-200  font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">
                        Update ${{number_format($plan->price / 100,2)}}
                      </button>
                    </div>
                    <div class="flex items-center mt-5">
                      <svg class="flex-shrink-0 w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                      </svg>
                      <span class="ml-2 text-sm text-gray-500"> This is a secure checkout, your payment details don't touch our servers.</span>
                    </div>
                  </div>


                </form>
            @endif

      </div>

    </div>

    <section class="py-10 bg-gray-900 sm:py-16 shadow-l-lg lg:py-24">

      <div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:items-stretch md:grid-cols-2 gap-x-12 lg:gap-x-20 gap-y-10">
          <div class="flex flex-col justify-between lg:py-5">
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

              <blockquote class="mt-6">
                <p class="text-md leading-relaxed text-white">You made it so simple. The system is much faster and easier to work with than my old system.</p>
              </blockquote>

              <div class="flex items-center mt-8">
                <img class="flex-shrink-0 object-cover w-10 h-10 rounded-full" src="https://cdn.rareblocks.xyz/collection/celebration/images/pricing/2/avatar.jpg" alt="" />
                <div class="ml-4">
                  <p class="text-base font-semibold text-white">Brooklyn Simmons</p>
                  <p class="mt-px text-sm text-gray-400">Digital Marketer</p>
                </div>
              </div>
            </div>
          </div>

          <div >
            <div class="overflow-hidden bg-white rounded-md">
              <div class="px-4 my-12">
                <h3 class="text-xs font-semibold tracking-widest text-black uppercase">{{$plan->name}}</h3>
                  <div>
                    <span class="align-top mt-4 text-3xl font-bold sm:text-3xl text-black">$</span>
                    <span class="align-top mt-4 text-3xl font-bold sm:text-3xl text-black">{{number_format($plan->price / 100,2)}}
                    <span class="text-3xl font-bold sm:text-2xl text-black">/ {{$plan->slug}}</span>
                    </span>
                  </div>
                <div class="text-xs mt-2 font-normal leading-tight text-gray-500">
                  Automatically renews after 1 {{$plan->slug}}
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
    </section>





<script src="https://js.stripe.com/v3/"></script>
<script>

  const stripe = Stripe('{{ config('cashier.key') }}')

  const elements = stripe.elements()
  const cardElement = elements.create('card')

  cardElement.mount('#card-element')

  const form = document.getElementById('card-form')
  const cardButton = document.getElementById('card-button')
  const cardHolderName = document.getElementById('card-holder-name')

  form.addEventListener('submit', async (e) => {
    e.preventDefault()

    cardButton.disabled = true

    const {setupIntent, error} = await stripe.confirmCardSetup(
      cardButton.dataset.secret, {
        payment_method: {
          card: cardElement,
          billing_details: {
            name: cardHolderName.value
          }
        }
      }
    )
    if (error) {
      cardButton.disabled = false
    }else{
      let token = document.createElement('input')
      token.setAttribute('type', 'hidden')
      token.setAttribute('name', 'token')
      token.setAttribute('value', setupIntent.payment_method)

      form.appendChild(token)
      form.submit()
    }
  })
</script>

<style>
  .StripeElement {
    background-color: white;
    padding: 10px 12px;
    border-radius: 4px;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
  }

  .StripeElement--invalid {
    border-color: #fa755a;
  }
  .StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
  }
</style>

