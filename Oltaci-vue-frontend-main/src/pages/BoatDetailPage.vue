<template>
  <div class="page">
    <v-main>
      <v-container fluid class="my-4 px-14">
        <BoatInfo :tour="tour" />
        <v-row dense>
          <v-divider :thickness="3" class="border-opacity-25 my-2"></v-divider>
          <v-col cols="6" class="py-4">
            <TourSummary />
            <OltaciRules />
            <Equipment :tour="tour" />
            <!-- <AdditionalServices :additionalServices="additionalServices" /> -->
            <TourRules />
            <BoatLocation :tour="tour" />
            <Conditions />
            <FAQ />
          </v-col>
          <v-col cols="6" class="d-flex justify-end h-800 py-4">
            <Total :tour="tour" />
          </v-col>
          <v-divider :thickness="3" class="border-opacity-25 my-2"></v-divider>
        </v-row>
      </v-container>
    </v-main>

    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";

import Footer from "./../components/layouts/Footer.vue";
import BoatInfo from "./../components/base/BoatInfo.vue";
import TourSummary from "../components/base/TourSummary.vue";
import TourRules from "../components/base/TourRules.vue";
import Equipment from "./../components/base/EquipmentCard.vue";
import AdditionalServices from "./../components/base/AdditionalServices.vue";
import OltaciRules from "./../components/base/OltaciRules.vue";
import BoatLocation from "./../components/base/BoatLocation.vue";
import Conditions from "./../components/base/ConditionsCard.vue";
import FAQ from "./../components/base/FAQ.vue";
import Total from "./../components/base/TotalCard.vue";
import { storeToRefs } from "pinia";
import { useTourStore } from "../stores/tours";
import { useReservationStore } from "../stores/reservation";
import { useAdditionalServiceStore } from "../stores/additional_services";

const route = useRoute();
const toursStore = useTourStore();
const additionalServicesStore = useAdditionalServiceStore();
const resStore = useReservationStore();

const { tour } = storeToRefs(toursStore);
const { reservations } = storeToRefs(resStore);
const { additionalServices } = storeToRefs(additionalServicesStore);

onMounted(async () => {
  await toursStore.fetchTour(route.params.id);
  await additionalServicesStore.fetchAdditionalServices();
  reservations.value.tour_id = tour.value.id;
});
</script>
