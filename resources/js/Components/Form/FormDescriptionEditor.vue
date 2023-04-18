<template>
  <div class="relative">
    <label class="block text-xs font-semibold leading-6 text-gray-800">
      {{ label }} <span v-if="required" class="text-danger-600">*</span>
    </label>
    <editor-content :editor="editor" />

    <div
      v-if="editor"
      class="editor-toolbar transition-opacity duration-300"
      :class="isFocused ? 'opacity-100' : 'opacity-30'"
    >
      <button
        type="button"
        class="editor-btn"
        @click="editor.chain().focus().toggleBold().run()"
        :disabled="!editor.can().chain().focus().toggleBold().run()"
        :class="{ 'editor-btn-active': editor.isActive('bold') }"
      >
        B
      </button>


      <button
        type="button"
        @click="editor.chain().focus().toggleItalic().run()"
        :disabled="!editor.can().chain().focus().toggleItalic().run()"
        class="editor-btn italic"
        :class="{ 'editor-btn-active': editor.isActive('italic') }"
      >
        I
      </button>

      <button
        type="button"
        @click="editor.chain().focus().toggleUnderline().run()"
        :disabled="!editor.can().chain().focus().toggleUnderline().run()"
        class="editor-btn underline"
        :class="{ 'editor-btn-active': editor.isActive('underline') }"
      >
        U
      </button>

      <button
        type="button"
        class="editor-btn"
        @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
        :class="{ 'editor-btn-active': editor.isActive('heading', { level: 1 }) }"
      >
        H1
      </button>
      <button
        type="button"
        class="editor-btn"
        @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
        :class="{ 'editor-btn-active': editor.isActive('heading', { level: 2 }) }"
      >
        H2
      </button>

      <button
        type="button"
        class="editor-btn"
        @click="editor.chain().focus().toggleBulletList().run()"
        :class="{ 'editor-btn-active': editor.isActive('bulletList') }"
      >
        <ListBulletIcon class="h-4" />
      </button>
    </div>
  </div>
  <BaseFormInputError v-if="error">{{ error }}</BaseFormInputError>
</template>

<script setup>
import { Editor, EditorContent } from "@tiptap/vue-3";
import Placeholder from "@tiptap/extension-placeholder";
import StarterKit from "@tiptap/starter-kit";
import { ListBulletIcon } from "@heroicons/vue/24/outline";
import Underline from "@tiptap/extension-underline";

const props = defineProps({
  modelValue: String,
  placeholder: String,
  label: String,
  error: String,
  required: Boolean,
  focus: Boolean
});

const emit = defineEmits(["update:modelValue", "blur"]);
const editor = ref(null);
const isFocused = ref(false);

watch(
  () => props.modelValue,
  (value) => {
    const isSame = editor.value.getHTML() === value;
    if (isSame) {
      return;
    }

    editor.value.commands.setContent(value, false);
  }
);

onBeforeMount(() => {
  editor.value = new Editor({
    content: props.modelValue,
    extensions: [
      StarterKit,
      Underline,
      Placeholder.configure({
        placeholder: props.placeholder
      })
    ],
    onFocus: () => (isFocused.value = true),
    onBlur: () => {
      isFocused.value = false;
      // emit("blur");
    },
    onUpdate: () => {
      emit("update:modelValue", editor.value.getHTML());
    }
  });
});

onMounted(() => {
  if (props.focus) {
    editor.value.chain().focus();
  }
});

onBeforeUnmount(() => {
  editor.value.destroy();
});
</script>

<style></style>
