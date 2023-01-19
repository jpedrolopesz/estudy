<template>
  <div>
    <div v-if="!subscribed">
      <template v-if="onGenericTrial">
        <div :class="{'rounded-md': true, 'bg-orange-50': true, 'p-1': true}">
          <div class="flex">
            <div>
              <!-- icon or image here -->
            </div>
            <div class="ml-3">
              <p class="text-sm font-medium text-orange-800">
                You're on the free plan until
                <span v-text="user.trial_ends_at"></span>,
                <strong>but you haven't subscribed to any plan yet</strong>.
                Please do so now to contine using the application even after your trial ends.
              </p>
            </div>
          </div>
        </div>
      </template>
      <template v-else>
        <div :class="{'rounded-md': true, 'bg-orange-50': true, 'p-1': true}">
          <div class="flex">
            <div>
              <!-- icon or image here -->
            </div>
            <div class="ml-3">
              <p class="text-sm font-medium text-orange-800">
                You're on <strong>not subscribed</strong>. If you wish to keep using the application, please choose a subscription plan below.
              </p>
            </div>
          </div>
        </div>
      </template>
    </div>
    <div v-else-if="onGracePeriod">
      <div :class="{'rounded-md': true, 'bg-orange-50': true, 'p-1': true}">
        <div class="flex">
          <div>
            <!-- icon or image here -->
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-orange-800">
              You're on a <strong>grace period</strong> until <span ></span>.
              If you wish to continue using the application after that date, please <strong>resubscribe</strong>.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <div :class="{'rounded-md': true, 'bg-green-50': true, 'p-2': true}">
        <div class="flex ml-6 justify-between">
          <div class=" flex">
            <p class="text-sm font-medium text-green-800">
              You're subscribed to the <strong>Nome do plano</strong> plan.

            </p>
          </div>
        </div>
      </div>
    </div>
  </div>


</template>



<script>

export default {

  props: {

    invoices: {
      type: Object || Array,
      require: true
    },
    subscription: {
      type: Object || Array,
      require: true

    },
    onGenericTrial: Boolean,
    onGracePeriod: Boolean,
    subscribed: Boolean,
    user: Object,

    setup(props) {
      console.log(props.subscription)
      //console.log(props.invoices)
      console.log(props.onGenericTrial)
      console.log(props.onGracePeriod)
      console.log(props.user)
    }
  }
}
</script>
