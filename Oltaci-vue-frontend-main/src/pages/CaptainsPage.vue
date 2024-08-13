<template>
  <div class="page">
    <v-main>
      <!-- <div fluid class="hero-section">
          <video autoplay muted loop class="video-background">
            <source src="" type="video/mp4" />
            Your browser does not support the video tag.
          </video>
          <div class="overlay">
            <v-container fluid>
              <v-row>
                <v-col cols="6" class="text-start">
                  <h1 class="hero-title">Unforgettable Experience</h1>
                  <p class="hero-subtitle">
                    Discover a wide selection of boats and fishing equipment for
                    rent at Oltaci. Anytime anywhere
                  </p>
                </v-col>
                <v-spacer></v-spacer>
              </v-row>
            </v-container>
          </div>
        </div> -->

      <!-- Section for Card1 -->

      <section class="py-16">
        <v-row class="text-center">
          <v-col>
            <p class="font-weight-bold text-h6 text-primary">Choose</p>
            <h2 class="text-h3 py-4">
              <strong>Your Perfect Captain: Experienced, Skillful, and Competent</strong>
            </h2>
          </v-col>
        </v-row>
        <v-row class="d-flex p-16 justify-center">
          <v-col v-for="captain in captains" :key="captain.id" cols="12" sm="6" md="4">
            <CaptainCard :captain="captain" />
          </v-col>

          <v-pagination class="pt-5" v-model="page" :length="4" rounded="circle" color="primary"></v-pagination>

        </v-row>

      </section>
    </v-main>

    <Footer />
  </div>



</template>

<script setup>
import { ref, onMounted } from "vue";
import Navbar from "./../components/layouts/Navbar.vue";
import Footer from "./../components/layouts/Footer.vue";
import CaptainCard from "./../components/base/CaptainCard.vue";

import { useCaptainStore } from "../stores/captains";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";

const store = useCaptainStore();
const { captains, loading, response } = storeToRefs(store);
const { xs, sm } = useDisplay();

onMounted(async () => {
  await store.fetchCaptains();
});

</script>

<style scoped>
.hero-section {
  position: relative;
  width: 100%;
  height: 100vh;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
}

.video-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  z-index: 1;
}

.hero-title {
  font-size: 4rem;
  margin: 0;
}

.hero-subtitle {
  font-size: 1rem;
  margin-top: 1rem;
}
</style>
