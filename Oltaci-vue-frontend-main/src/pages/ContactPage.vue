<template>
  <div class="page">
    <v-main>
      <HeroCard />

      <section class="my-5 bg-grey-lighten-5">
        <v-container fluid class="pt-16" style="max-width: 1600px">
          <v-row>
            <v-col cols="12" class="text-left">
              <p class="font-weight-bold mb-2">{{ $t("Get in Touch") }}</p>
              <h4 class="font-weight-bold text-primary mb-2 text-h4">
                {{ $t("Contact Oltaci") }}
              </h4>
              <p class="mb-3">
                {{ $t(`Have a question or need a quote? Reach out to us!`) }}
              </p>
            </v-col>
          </v-row>
          <ContactCard />
        </v-container>
      </section>

      <section class="my-5">
        <v-container fluid class="pt-16" style="max-width: 1600px">
          <v-row>
            <v-col cols="12" class="text-center">
              <p class="font-weight-bold mb-2">{{ $t("Professional") }}</p>
              <h4 class="font-weight-bold text-primary mb-2 text-h4">
                {{ $t("Visit Oltaci") }}
              </h4>
              <p class="mb-3">
                {{
                  $t(
                    "We're here to help you. Reach out to us for any inquiries."
                  )
                }}
              </p>
            </v-col>
          </v-row>
          <LocationCard />
        </v-container>
      </section>

      <section class="my-5 bg-grey-lighten-5">
        <v-container class="pa-16">
          <v-row>
            <v-col cols="12" class="text-center">
              <v-rating
                v-model="rating"
                active-color="blue"
                color="orange-lighten-1"
                size="x-large"
              ></v-rating>
              <v-container style="max-width: 80%">
                <p
                  class="d-flex justify-center align-center text-warp font-weight-bold mb-2 text-h5"
                >
                  {{
                    $t(
                      `Working with Oltaci was a game-changer for my boating adventures. They provided me with a fantastic boat that made every trip enjoyable and memorable.`
                    )
                  }}
                </p>
              </v-container>
            </v-col>
          </v-row>
        </v-container>
      </section>
    </v-main>

    <Footer />
  </div>
</template>

<script setup>
import { ref } from "vue";
import Navbar from "./../components/layouts/Navbar.vue";
import Footer from "./../components/layouts/Footer.vue";
import HeroCard from "./../components/base/HeroCard.vue";
import LocationCard from "./../components/base/LocationCard.vue";
import ContactCard from "./../components/base/ContactCard.vue";

const rating = ref(5);
</script>
