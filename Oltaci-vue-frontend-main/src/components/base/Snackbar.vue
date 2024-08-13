<template>
  <v-snackbar
    min-width="100"
    v-model="snackbar.show"
    :color="snackbarColor"
    :timeout="3000"
    location="right"
  >
    <div class="d-flex align-center">
      <v-icon v-show="snackbar.color === 'error'" class="mr-2"
        >mdi-alert-circle-outline</v-icon
      >
      <v-icon v-show="snackbar.color === 'success'" class="mr-2"
        >mdi-check-circle-outline</v-icon
      >
      <span class="text-subtitle-1">{{ snackbar.text }}</span>
    </div>
  </v-snackbar>
</template>

<script setup>
import { storeToRefs } from "pinia";
import { computed } from "vue";
import { useSnackbarStore } from "../../stores/snackbar";

const snackbar = useSnackbarStore();

const { color } = storeToRefs(snackbar);

const snackbarColor = computed(() => {
  if (color.value == "success") return "green-darken-3";
  else return "red-darken-3";
});
</script>
