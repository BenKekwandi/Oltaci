<template>
  <v-dialog v-model="countdownStore.show" persistent max-width="400">
    <v-card>
      <v-card-title class="headline">Redirecting</v-card-title>
      <v-card-text>
        You will be redirected in {{ countdown }} seconds.
      </v-card-text>
      <v-card-actions>
        <v-btn color="primary" text @click="cancelRedirect">Cancel</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useCountdownStore } from "../../stores/countdown";

const countdownStore = useCountdownStore();

const countdown = ref(3);
let countdownInterval = null;

const startCountdown = () => {
  countdown.value = 3;

  countdownInterval = setInterval(() => {
    if (countdown.value > 0) {
      countdown.value--;
    } else {
      clearInterval(countdownInterval);
      redirectToExternalUrl(countdownStore.redirectUrl);
    }
  }, 1000);
};

const cancelRedirect = () => {
  clearInterval(countdownInterval);
  countdownStore.stopCountdown();
};

const redirectToExternalUrl = (url) => {
  window.location.href = url;
};

onMounted(() => {
  if (countdownStore.show) {
    startCountdown();
  }
});
</script>

<style scoped></style>
