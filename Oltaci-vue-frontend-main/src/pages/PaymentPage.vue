<template>
  <div class="page">
    <v-main>
      <section class="d-flex align-center pa-16">
        <v-row class="text-center">
          <v-col>
            <p class="font-weight-bold text-h6 text-primary">Payment</p>
            <h2 class="text-h3 py-4">
              <strong>One step left to finish booking</strong>
            </h2>
            <Payment :reservationData="resStore.reservationData" />
          </v-col>
        </v-row>
      </section>
    </v-main>
    <Footer />
    <CountdownModal />
  </div>
</template>

<script setup>
import Footer from "./../components/layouts/Footer.vue";
import Payment from "../components/base/Payment.vue";
import CountdownModal from "../components/base/CountdownModal.vue";
import { useReservationStore } from "../stores/reservation";

const resStore = useReservationStore();
</script>
