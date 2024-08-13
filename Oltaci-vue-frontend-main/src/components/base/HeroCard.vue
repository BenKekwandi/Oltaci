<template>
  <div class="card-background">
  <v-container >
    <div class="px-4 md:block">
      <div class="pb-8 mt-auto">
        <div class="text-center">
          <h4 class="mb-1 mt-16 text-h6 font-serif max-w-3xl mx-auto">Expertise</h4>
          <h1 class="text-h3 font-weight-bold  mb-8 font-serif max-w-3xl mx-auto">
            {{ $t("Get in Touch") }}
          </h1>

          <div class="md:max-w-2xl text-h6 mx-auto">
            <p class="text-gray-800">
              {{
                $t(`We're here to answer any questions or provide our services`)
              }}
            </p>
          </div>

          <div class="mb-6 mt-12">
            <a
              href="#"
              class="py-2 px-4 text-decoration-none md:py-4 md:px-6 mr-2 border select-none hover:bg-black-400 bg-black rounded shadow-lg text-white"
              >{{ $t("Contact") }} <span>&rarr;</span></a
            >

            <a
              href="#"
              class="py-2 px-4 text-decoration-none md:py-4 md:px-6 border select-none hover:bg-gray-100 bg-white rounded shadow-lg text-indigo"
            >
              {{ $t("Learn More") }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </v-container>
  </div>
</template>

<style scoped>
.card-background {
  background-image: url("boat-min.jpg"); /* Replace with the path to your image */
  background-size: cover; /* Ensures the image covers the entire background */
  background-position: center; /* Centers the image */
  padding: 4rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional: Add a shadow */
  color: white; /* Ensures text is*/
}
</style>
