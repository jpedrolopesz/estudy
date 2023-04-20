<template>
  <div class="flex mt-3 gap-x-3 items-center">
    <div>
      <AvatarUploader
        @crop-success="handleFileInputChange"
        @crop-upload-success="handleFileInputChange"
        v-model="showCropper"
        :width="300"
        :height="300"
        langType="en"
        img-format="png"
      />
      <img class="inline-block h-10 w-10 rounded-full ring-1 ring-offset-2 ring-primary-600"
           :src="$page.props.auth.user.avatar"
           alt="" />
    </div>
    <div>
      <button @click="showCropper = true" class="text-primary-700 hover:underline">Upload your photo</button>
      <p class="text-sm text-gray-500">A profile photo helps your teammates recognize you easily</p>
    </div>
  </div>
</template>

<script setup>
import AvatarUploader from "vue-image-crop-upload";

const showCropper = ref(false);
const form = useForm({
  avatar: null
});

async function handleFileInputChange(e) {
  form.avatar = DataURIToBlob(e);
  await form.post(route("profile.avatar"), {
    onSuccess: () => {
      showCropper.value = false;
    },
    onError: (error) => console.log(error)
  });
}

function DataURIToBlob(dataURI) {
  const splitDataURI = dataURI.split(",");
  const byteString =
    splitDataURI[0].indexOf("base64") >= 0
      ? atob(splitDataURI[1])
      : decodeURI(splitDataURI[1]);
  const mimeString = splitDataURI[0].split(":")[1].split(";")[0];

  const ia = new Uint8Array(byteString.length);
  for (let i = 0; i < byteString.length; i++) ia[i] = byteString.charCodeAt(i);

  return new Blob([ia], { type: mimeString });
}
</script>

<style></style>
