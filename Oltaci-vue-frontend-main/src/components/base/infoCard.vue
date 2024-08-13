<template>
  <v-container fluid>
    <v-row>
      <!-- First Card -->
      <v-col cols="6">
        <v-card outlined class="custom-card">
          <v-row>
            <!-- Left column for text -->
            <v-col cols="6">
              <v-card-title class="text-subtitle-1">{{$t('Affordable')}}</v-card-title>
              <v-card-text>
                <p class="text-h5 pb-4">
                  <strong>{{$t('Competitive Pricing for Every Budget')}} </strong>
                </p>
                <p class="pb-4">{{$t('Experience the best value for your money')}}</p>
                <v-btn color="primary" text>
                  {{$t('Explore')}}
                  <v-icon right> mdi-arrow-right </v-icon>
                </v-btn>
              </v-card-text>
            </v-col>
            <!-- Right column for image -->
            <v-col cols="6">
              <v-img :src="imageUrl" cover height="100%"></v-img>
            </v-col>
          </v-row>
        </v-card>
      </v-col>

      <!-- Second Card -->
      <v-col cols="3">
        <v-card outlined class="custom-card">
          <v-row>
            <!-- Column for text content -->
            <v-col cols="12">
              <v-card-title class="text-subtitle-1">{{$t('Reliable')}}</v-card-title>
              <v-card-text>
                <p class="text-h5 pb-4">
                  <strong>{{$t('Extensive Coverage in Turkey')}} </strong>
                </p>
                <p class="pb-4">
                  {{$t('Discover hidden gems with our wide network of locations')}}
                </p>
                <v-btn color="primary" text>
                  {{$t('Book')}}
                  <v-icon right> mdi-arrow-right </v-icon>
                </v-btn>
              </v-card-text>
            </v-col>
          </v-row>
          <v-row>
            <v-img :src="imageUrl" cover></v-img>
          </v-row>
        </v-card>
      </v-col>

      <!-- Third Card -->
      <v-col cols="3">
        <v-card outlined class="custom-card">
          <v-row>
            <!-- Column for text content -->
            <v-col cols="12">
              <v-card-title class="text-subtitle-1">{{$t('Unforgettable')}}</v-card-title>
              <v-card-text>
                <p class="text-h5 pb-4">
                  <strong>{{$t('Create Memories Forever')}} </strong>
                </p>
                <p class="pb-4">
                  {{$t('Make your dream vacation a reality with Oltaci')}}
                </p>
                <v-btn color="primary" text>
                  {{$t('Start')}}
                  <v-icon right> mdi-arrow-right </v-icon>
                </v-btn>
              </v-card-text>
            </v-col>
          </v-row>
          <v-row>
            <v-img :src="imageUrl" cover></v-img>
          </v-row>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref } from "vue";

// Define reactive data variables
const cardTitle = ref("Card Title");
const cardText = ref(
  "Lorem ipsum dolor sit amet, consectetur adipiscing elit."
);
const imageUrl = ref("boat.jpg");
</script>

<style scoped>
/* Adjust the height of the card to fit the content */
.v-card {
  height: auto;
}

.custom-card {
  height: 520px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 20px;
}
</style>
