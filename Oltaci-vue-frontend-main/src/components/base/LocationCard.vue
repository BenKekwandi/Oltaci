<template>
  <v-card variant="flat" class="pa-5">
    <v-row>
     
      <v-col cols="12" md="12" class="d-flex align-center justify-center">
        <GoogleMap
          :api-key="YOUR_GOOGLE_MAPS_API_KEY"
          style="width: 100%; height: 500px"
          :center="center"
          :zoom="15"
        >
          <Marker :options="{ position: center }" />
        </GoogleMap>
      </v-col>
    </v-row>
  </v-card>
</template>

<script setup>
import { ref } from "vue";
import { GoogleMap, Marker } from "vue3-google-map";

const YOUR_GOOGLE_MAPS_API_KEY = "AIzaSyCUN1P7bej47HzkWJd5Q9WtCw5nDnj7XkQ";
const center = ref({ lat: 40.689247, lng: -111.044502 });
const imageUrl = ref("https://via.placeholder.com/600");
</script>
