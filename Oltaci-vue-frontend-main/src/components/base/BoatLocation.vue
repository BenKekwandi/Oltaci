<template>
  <v-sheet class="text-body-2 mx-auto">
    <span class="font-weight-bold text-h5">{{ t('Additional Services') }}</span>
    <v-row class="mt-5 ml-1">
      <GoogleMap
        :api-key="YOUR_GOOGLE_MAPS_API_KEY"
        style="width: 100%; height: 500px"
        :center="center"
        :zoom="15"
      >
        <Marker :options="{ position: center }" />
      </GoogleMap>
    </v-row>
    <v-divider :thickness="3" class="border-opacity-25 my-6"></v-divider>
  </v-sheet>
</template>

<script setup>
import { ref } from "vue";
import { GoogleMap, Marker } from "vue3-google-map";

import { useI18n } from "vue-i18n";

const { t } = useI18n();

const YOUR_GOOGLE_MAPS_API_KEY = "AIzaSyCUN1P7bej47HzkWJd5Q9WtCw5nDnj7XkQ";
const center = ref({ lat: 40.689247, lng: -111.044502 });
</script>

<style>
/* Add your styles here if needed */
</style>
