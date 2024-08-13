<template>
  <v-container fluid class="px-16">
    <v-card variant="flat" class="pa-5">
      <v-row>
        <v-col cols="12" md="6">
          <div class="border-s-lg border-opacity-100 border-primary pl-4 mb-12">
            <h4 class="font-weight-bold text-h4">{{$t('Our Services Offered')}}</h4>
            <p class="mt-4 text-h6 font-weight-medium">
              {{$t('At Oltaci, we provide a comprehensive range of services to cater to all your boating and fishing needs. From boat rentals and equipment selection to trip planning and seasonal maintenance, we have you covered.')}}
            </p>
          </div>
          <div class="pl-4 mb-12">
            <h4 class="font-weight-bold text-h4">{{$t('Boat Rentals')}}</h4>
            <p class="mt-4 text-h6 font-weight-medium">
              {{$t('Our expert team specializes in boat rentals, ensuring that you have the perfect vessel for your adventure. We offer a variety of boats, from small fishing boats to larger recreational vessels, all maintained to the highest standards.')}}
            </p>
          </div>
          <div class="pl-4 mb-12">
            <h4 class="font-weight-bold text-h4">{{$t('Fishing Equipment')}}</h4>
            <p class="mt-4 text-h6 font-weight-medium">
              {{$t('Enhance your fishing experience with our top-quality fishing equipment rentals. Our knowledgeable staff will help you select the best gear for your trip, ensuring you have everything you need for a successful outing on the water.')}}
            </p>
          </div>
        </v-col>
        <v-col cols="12" md="6" class="d-flex align-center justify-center">
          <v-img :src="imageUrl" height="100%" width="100%"></v-img>
        </v-col>
      </v-row>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref } from "vue";

const imageUrl ='service.jpg';
</script>
