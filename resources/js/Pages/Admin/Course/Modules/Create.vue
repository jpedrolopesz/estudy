<template>
  <AdminLayout>



    <div>
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">

          <div class="w-full ">
            <div class="sm:flex sm:items-center mx-4 sm:justify-between">
              <div class="min-w-0 flex-1">

                <div class="mb-2">
                  <h1 class="font-medium text-2xl lg:text-3xl opacity-75">{{course.title}}</h1>
                </div>
                <p class="mt-1 text-sm text-gray-600">{{course.description}}</p>
              </div>

            </div>
          </div>

        </div>


        <div class="mt-1 md:col-span-2 md:mt-0">

          <div class=" shadow-lg sm:overflow-hidden rounded-t-md sm:rounded-b-md">
            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">



              <div class="grid gap-2 overflow-y-auto h-96 ">



              </div>



            </div>

            <div class="flex justify-between bg-gray-50 px-4 py-3 text-right sm:px-6">

              <div>
                <Link :href="route('pages.plans.show')" type="button" class="btn bg-gray-600 text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                  </svg>

                  Previous
                </Link>
              </div>

              <div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>


<script>

</script>
