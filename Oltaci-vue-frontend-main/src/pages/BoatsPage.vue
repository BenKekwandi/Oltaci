<template>
  <div class="page">
    <v-main>
      <Hero
        :heading="$t('Unforgettable Experience')"
        :description="
          $t(
            'Discover a wide selection of boats and fishing equipment for rent at Oltaci. Anytime anywhere'
          )
        "
        backgroundSource="motorboat.jpg"
        imageSize="600px"
      />

      <v-container fluid class="pt-16" style="max-width: 1600px">
        <section class="py-16">
          <v-row class="text-center">
            <v-col>
              <p class="font-weight-bold text-h6 text-primary">
                {{ $t("Discover") }}
              </p>
              <h2 class="text-h3 py-4">
                <strong>{{ $t("Unmatched Variety of Boats") }}</strong>
              </h2>
            </v-col>
          </v-row>
          <v-row class="d-flex p-16 justify-center">
            <v-col v-for="tour in tours" :key="tour.id" cols="12" sm="6" md="4">
              <BoatCard :tour="tour" />
            </v-col>

            <v-pagination
              class="pt-5"
              v-model="page"
              :length="4"
              rounded="circle"
              color="primary"
            ></v-pagination>
          </v-row>
        </section>
      </v-container>
    </v-main>

    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Navbar from "./../components/layouts/Navbar.vue";
import Footer from "./../components/layouts/Footer.vue";
import BoatCard from "./../components/base/BoatsCard.vue";
import Hero from "./../components/base/Hero.vue";

import { useTourStore } from "../stores/tours";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";

const page = ref(1);
const store = useTourStore();
const { tours, loading, response } = storeToRefs(store);
const { xs, sm } = useDisplay();

import { useI18n } from "vue-i18n";

const { t } = useI18n();

onMounted(async () => {
  await store.fetchTours();
});
</script>
