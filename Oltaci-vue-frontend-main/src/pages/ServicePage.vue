<template>
  <div class="page">
    <v-main>
      <div class="hero-with-filter">
        <Hero
          :title="$t('Expertise')"
          :heading="$t('Unmatched Variety of Boats')"
          :description="
            $t(
              'At Oltaci, we offer a wide range of boat rentals and fishing equipment tailored to meet the unique needs of our clients. With our expertise and attention to detail, we ensure that every adventure receives the personalized care it deserves.'
            )
          "
          :buttons="{
            signUp: {
              text: $t('Sign Up'),
              color: 'black',
            },
            learnMore: {
              text: $t('Learn More'),
              color: 'white',
              outlined: true,
            },
          }"
          split
          backgroundSource="wallpaperflare.com_wallpaper.jpg"
          imageSize="800px"
        />
        <div class="filter-wrapper">
          <Filter :regionStore="regionStore" />
        </div>
      </div>
      <section class="d-flex align-center pa-16">
        <Service />
      </section>

      <section class="d-flex align-center pa-16">
        <ServiceOne />
      </section>

      <section class="d-flex align-center pa-16">
        <ServiceTwo />
      </section>

      <section>
        <Hero
          :heading="$t('Ride the wave with us')"
          :description="
            $t(
              `Explore the beauty of Turkey's waters with our wide selection of boats and rental equipment.`
            )
          "
          :buttons="{
            signUp: {
              text: $t('Book'),
              color: 'black',
            },
            learnMore: {
              text: $t('Learn More'),
              color: 'white',
              outlined: true,
            },
          }"
          backgroundSource="boat-min.jpg"
        />
      </section>
    </v-main>

    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

import Navbar from "./../components/layouts/Navbar.vue";
import Footer from "./../components/layouts/Footer.vue";
import Filter from "./../components/base/FilterCard.vue";
import Service from "../components/base/ServiceCard.vue";
import ServiceOne from "../components/base/ServiceOne.vue";
import ServiceTwo from "../components/base/ServiceTwo.vue";
import Hero from "../components/base/Hero.vue";

import { useTourStore } from "../stores/tours";
import { useRegionStore } from "../stores/regions";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";

const tourStore = useTourStore();
const regionStore = useRegionStore();
const { tours } = storeToRefs(tourStore);
const { regions } = storeToRefs(regionStore);
const { xs, sm } = useDisplay();

onMounted(async () => {
  await tourStore.fetchTours();
  await regionStore.fetchRegions();
});
</script>
<style scoped>
.hero-with-filter {
  position: relative;
}

.filter-wrapper {
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 1;
  width: 100%; /* Adjust as needed */
}

@media (max-width: 600px) {
  .filter-wrapper {
    top: 74%; /* Adjust for mobile view */
  }
}
</style>
