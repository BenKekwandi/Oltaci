<script setup>
import Snackbar from "./components/base/Snackbar.vue"
import { useSnackbarStore } from './stores/snackbar';



</script>

<template>
  <Snackbar />
  <router-view />
</template>

<style scoped></style>
