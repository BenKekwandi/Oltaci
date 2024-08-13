<template>
    <v-container>
      <v-card outlined class="product-card">
        <v-img :src="captain.profile_picture"></v-img>
  
        <v-card-text class="p-5">
          <div class="d-flex justify-space-between align-center mb-4">
            <span class="font-weight-bold text-subtitle-1"
              >{{ captain.first_name }}{{ captain.last_name }}
            </span>
            <div class="d-flex align-center">
              <v-rating
                v-model="captain.average_rating"
                color="primary"
                length="1"
                hover
              ></v-rating>
              <span class="font-weight-bold text-grey">{{ captain.average_rating }}</span>
            </div>
          </div>
  
          <p class="mb-4">
            {{ captain.description }}
          </p>
  
          <div class="d-flex justify-space-between">
            <div class="info-item">
              <strong>Email:</strong> {{ captain.email }}<span class="text-caption text-grey"></span>
            </div>
            <div class="info-item">
              <strong>Experience:</strong> {{ captain.years_of_experience }}<span class="text-caption text-grey">years</span>
            </div>
          </div>
  
          <v-btn color="primary" class="mt-3" block>more</v-btn>
        </v-card-text>
      </v-card>
    </v-container>
  </template>
  
  <script setup>
  import { ref, toRefs, defineProps } from "vue";
  const props = defineProps({
    captain: {
      type: Object,
      required: true,
    },
  });
  const rating = ref(props.captain.average_rating);
  </script>
  
  <style scoped>
  .product-card {
    max-width: 400px;
    min-height: 480px;
    margin: 0 auto;
  }
  
  .product-details {
    padding: 16px;
  }
  
  .info-item {
    font-size: 0.9rem;
  }
  </style>
  