<template>
  <AuthenticatedUserLayout>

    <div class="flex bg-gray-50 flex-col overflow-hidden">

      <div class="order-1  m-1.5 md:order-2 flex flex-col">
        <div class="w-full flex items-center px-3 md:px-6">
          <div class="flex items-center justify-between w-full">
            <div class="flex items-center min-w-0">
              <div class="text-gray-400 leading-none overflow-hidden truncate text-ellipsis">
                <nav class="flex " aria-label="Breadcrumb">
                  <ul class="inline-flex flex-wrap text-sm font-medium">
                    <li class="after:content-['/'] last:after:hidden after:text-slate-400 after:px-2">
                      <a href="">
                        {{course.title}}
                      </a>
                    </li>
                    <li class="after:content-['/'] last:after:hidden after:text-slate-400 after:px-2">
                      <a href="">
                        {{course.modules[0].title}}
                      </a>
                    </li>
                    <li class="after:content-['/'] last:after:hidden after:text-slate-400 after:px-2">
                      <a href="">
                        {{course.modules[0].lessons[0].title}}

                      </a>
                    </li>
                  </ul>
                </nav>
              </div>



            </div>
            <button class="flex  p-2 md:mr-8 rounded-md ml-6 font-medium text-slate-500 leading-none  bg-gray-200 hover:bg-gray-300">
              <i class='bx bx-left-arrow-alt nav__link'></i>
              <span class="truncate ">Back To</span>
            </button>
          </div>
        </div>
      </div>

          <VideoPlayer :course="course"/>

    </div>

  </AuthenticatedUserLayout>
</template>


<script>

import AuthenticatedUserLayout from "@/Pages/User/Layouts/Dashboard/AuthenticatedUserLayout.vue";
import VideoPlayer from "../Course/Partials/VideoPlayer.vue"


export default {
  components: {
    VideoPlayer, AuthenticatedUserLayout,
  },
  props: {
    course: Object,
  },
}
</script>
