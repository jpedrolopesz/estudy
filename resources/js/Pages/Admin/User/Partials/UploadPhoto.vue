<template>

              <div>
                <label class="block text-sm font-medium text-gray-700">Photo</label>

                <div class=" flex items-center">
                  <label for="image"  value="Image"/>
                  <input type="file" class="hidden" ref="photo"
                         @change="updatePhotoPreview"/>

                  <div class="mt-2" v-show="!photoPreview && user.image">
                    <img :src="currentImage()" class="rounded-full h-14 w-14 object-cover"/>
                  </div>

                  <div class="mt-2" v-show="photoPreview">
                  <span class="block rounded-full w-14 h-14" :style="
                  'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                  photoPreview +'\');'">
                  </span>
                  </div>
                  <InputError :message="form.errors.image"></InputError>
                  <button class="ml-2 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                          type="button" @click.prevent="selectNewPhoto">
                    Select a New Photo
                  </button>
                </div>
              </div>

</template>

<script>

import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";

export default {
  components: {
    InputError,
  },
  setup( props){
    const form = useForm({
      image: props.user.image,

    });
    return {form};
  },
  props:{
    user:Object
  },
  data() {
    return {
      photoPreview: null,
    };
  },
  methods: {
    submit() {
      if (this.$refs.photo) {
        this.form.image = this.$refs.photo.files[0];
      }
      this.form.post(route("account.profile.update"));
    },
    resetForm() {
      this.form.clearErrors();
      this.form.reset();
    },
    currentImage() {
      return "/storage/user/" + this.user.image;
    },
    selectNewPhoto() {
      this.$refs.photo.click();
    },
    updatePhotoPreview() {
      const reader = new FileReader();
      reader.onload = (e) => {
        this.photoPreview = e.target.result;
      };
      reader.readAsDataURL(this.$refs.photo.files[0]);
    },
  },
}
</script>
