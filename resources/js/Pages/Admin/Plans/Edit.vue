<template>
  <Head  title="Plan Edit" />

  <AdminLayout>



  </AdminLayout>

</template>


<script setup>

import AdminLayout from "../Layouts/AdminLayout.vue";
import { Link, Head ,useForm } from '@inertiajs/inertia-vue3';
import InputError from "@/Components/InputError.vue";
import TrashedMessage from "@/Components/TrashedMessage.vue";

const props = defineProps({
  plan:Object,
});

const form = useForm({
  name: props.plan.name,
  slug: props.plan.slug,
  price: props.plan.price,
  stripe_id: props.plan.stripe_id,
  description: props.plan.description,
  plan_features: props.plan.plan_features.max_users
});

const update = () => {
  form.put(route('plan.update', {
      plan: props.plan.id}),)
};

function restore () {
  form.put(route('plan.restore', props.plan.id))

}


</script>

