<!-- RegionCard.vue -->
<template>
  <v-container>
    <v-row align="center" justify="center" class="" dense>
      <v-col cols="12" md="12">
        <v-card class="mx-auto">
          <v-card-title class="font-weight-bold">{{ region.location }}</v-card-title>
          <v-card-text class="text-subtitle-1">
            This region contains
            <span class="text-primary font-weight-bold">50</span> boats
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref, toRefs, defineProps } from "vue";

const props = defineProps({
  region: {
    type: Object,
    required: true,
  },
});
</script>
