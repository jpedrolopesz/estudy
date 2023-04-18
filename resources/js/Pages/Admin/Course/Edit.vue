<template>
  <AdminLayout>

    <div class="w-full ">
      <div class="sm:flex sm:items-center mx-8 sm:justify-between">
        <div class="min-w-0 flex-1">

          <div class="flex items-center justify-start mb-2">
            <input type="text" v-model="course.title" class="bg-gray-50 font-medium rounded-lg border border-slate-200 text-2xl lg:text-3xl opacity-75 truncate"/>
            <button @click="updateCourse" class="shrink-0 text-indigo-500 hover:text-indigo-600 ml-2">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
              </svg>
            </button>
          </div>

        </div>
      </div>
    </div>


    <div class="grid grid-cols-12 gap-x-4 gap-y-8 mt-8">
      <!-- Tasks column -->
      <div class="col-span-full sm:col-span-6 xl:col-span-3">
        <!-- Column header -->
        <header>
          <div class="flex items-center justify-between mb-2">
            <h2 class="grow font-semibold text-slate-800 truncate">Add Module</h2>
            <button class="shrink-0 text-indigo-500 hover:text-indigo-600 ml-2">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
              </svg>
            </button>
          </div>

          <!-- Cards -->
          <div class="grid gap-2">
            <ul>
              <li
                class="bg-white shadow-lg rounded-sm border border-slate-200 mb-2 p-2"
                v-for="(module, index) in course.modules"
                :key="module.id"
              >
                <div class="flex">
                  <h4 class="font-semibold text-gray-800">{{module.id}}-</h4>
                  <input
                    type="text"
                    v-model="module.title"
                    class="ml-2 font-semibold text-gray-800"
                  />
                  <button
                    @click="updateModule(module)"
                    class="shrink-0 text-indigo-500 hover:text-indigo-600 ml-2"
                  >
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                      <path
                        d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z"
                      />
                    </svg>
                  </button>
                </div>
              </li>
            </ul>
          </div>

        </header>

      </div>

      <div class="col-span-full sm:col-span-6 xl:col-span-3">
        <!-- Column header -->
        <header>
          <div class="flex items-center justify-between mb-2">
            <h2 class="grow font-semibold text-slate-800 truncate">Add Lesson</h2>
            <button class="shrink-0 text-indigo-500 hover:text-indigo-600 ml-2">
              <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16">
                <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
              </svg>
            </button>
          </div>

          <!-- Cards -->
          <div class="grid gap-2">
            <div class="bg-white shadow-lg rounded-sm border border-slate-200 p-4">
              <div >
                <h2 class="font-semibold text-slate-800 mb-1">Aula 1</h2>
              </div>
            </div>
          </div>

        </header>


      </div>


    </div>

  </AdminLayout>
</template>


<script>
import AdminLayout from "../Layouts/AdminLayout.vue";

export default {
  components: {AdminLayout},
  props: {
    course:Object
  },
  data() {
    return {
     // title: this.course.title,
      title: this.course.modules.title,
    }
  },
  setup(props){
    console.log(props.course.modules[0].title)
  },
  methods: {
    updateCourse() {
      this.$inertia.put(`/courses/${this.course.id}`, {title: this.course.title})

    },
    updateModule(module) {
      this.$inertia.put(`/courses/${this.course.id}`, { title: module.title });
    }

  }

}
</script>
