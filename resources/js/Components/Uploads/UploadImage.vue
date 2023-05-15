<template>
  <input :id="id" type="file">
</template>





<script setup>
import { onMounted } from "vue";
import { create, registerPlugin } from "filepond";
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
const props = defineProps({
  id: {
    type: String,
    default: 'filepod_' + Math.floor(Math.random() * 100) + 1
  },
  labelIdle: {
    default: 'Clique ou arraste seus arquivos aqui...',
    type: String
  }
})
const emit = defineEmits(['update:modelValue'])
registerPlugin(
  FilePondPluginFileValidateType,
  FilePondPluginFileValidateSize,
  FilePondPluginImagePreview,
  FilePondPluginImageExifOrientation
)
onMounted(() => {
  const fileInput = document.querySelector('#' + props.id);
  const pond = create(fileInput, {

    storeAsFile: true,
    dropOnPage: true,
    allowMultiple: true,
    maxFiles: 1,
    credits: null,
    labelIdle: props.labelIdle,
    labelFileTypeNotAllowed: 'Tipo do arquivo não permitido'
  });
  pond.on('updatefiles', (files) => {
    emit(
      'update:modelValue',
      files.map(function (filepond) {
        return filepond.file
      })
    )
  });
})
</script>



<style >
[data-filepond-item-state*='error'] .filepond--item-panel,
[data-filepond-item-state*='invalid'] .filepond--item-panel {
  background-color: red;
}

[data-filepond-item-state='processing-complete'] .filepond--item-panel {
  background-color: green;
}

.filepond--root {
  max-height: 10em;
}
.filepond--panel-root {
  background-color: #f8fafc;
  border: 1px solid #cbd5e1;

}

</style>
