<template>
  <Popper arrow>
    <slot />
    <template #content="{ close }">
      <div class="min-w-[20rem] p-4 ">
        <div class="py-2">
          {{ isEditing ? `Edit ${element.display}` : "Create new item" }}
        </div>
        <form @submit.prevent="isEditing ? update(close) : create(close)" class="space-y-2 font-normal">
          <BaseFormInput
            required
            label="Name"
            id="section-name"
            :autofocus="true"
            v-model="form.name"
            :error="form.errors?.name"
            class="text-sm"
          />


          <div class="flex items-center gap-x-2 text-sm" v-if="type === 'TASK_TYPE'">
            <BaseFormSwitch v-model="form.available_in_subtask" />
            Is available for subtasks?
          </div>

          <div class="flex items-center justify-end gap-x-2 pt-4">
            <button @click="cancel(close)"
                    type="button"
                    class="px-2 py-1 bg-danger-100 border border-danger-200 rounded-md text-xs">
              Cancel
            </button>
            <BaseFormButton
              class="text-xs px-2 py-1"
              :disabled="!form.isDirty"
              :block="false"
              :loading="form.processing">
              Save
            </BaseFormButton>
          </div>
        </form>
      </div>
    </template>
  </Popper>
</template>

<script setup>
import { colorPicker } from "@/Helpers/helpers";


const props = defineProps({
  element: Object,
  type: String,
  by: { type: String, default: "user" }
});

const form = useForm({
  name: props.element?.display,
  description: props.element?.description,
  type: props.element?.type || props.type,
  color: props.element?.color,
  is_active: props.element?.is_active || true,
  available_in_subtask: props.element?.available_in_subtask || false
});

function cancel(close) {
  close();
  form.reset();
  form.clearErrors();
}

const isEditing = computed(() => !!props.element);

function create(close) {
  form.post(route("codes.store", [
    route().params.project
  ]), {
    preserveScroll: true,
    preserveState: true,
    onError: (e) => console.log(e),
    onSuccess: (_) => {
      form.reset();
      close();
    }
  });
}

function update(close) {
  form.put(route("codes.update", [
    route().params.project,
    props.element?.id
  ]), {
    preserveScroll: true,
    preserveState: true,
    onError: (e) => console.log(e),
    onSuccess: (_) => {
      close();
    }
  });
}


</script>

<style scoped>

</style>
