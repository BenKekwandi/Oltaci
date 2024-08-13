<template>
  <v-container fluid class="px-16">
    <v-card variant="flat" class="pa-5">
      <v-row>
        <v-col cols="12" md="6" class="d-flex align-center justify-center">
          <v-img :src="imageUrl" height="100%" width="100%"></v-img>
        </v-col>

        <v-col cols="12" md="6">
          <div class="px-3 mb-12">
            <h3 class="font-weight-bold text-h3">
              {{$t('Transform Your Boating Experience with Our Personalized Services')}}
            </h3>
            <p class="mt-12 mr-12 text-h6 font-weight-medium">
              {{$t(`At Oltaci, we offer personalized boating and fishing services that cater to your unique needs. Our team of experts will work closely with you to create an unforgettable adventure that reflects your style and enhances your outdoor experience.`)}}
            </p>
          </div>
          <v-row class="px-3">
            <v-col cols="12" md="6">
              <span class="font-weight-bold text-h5">{{$t('Expert Design')}}</span>
              <p class="mt-5 text-body-1 font-weight-medium">
                {{$t('Our experienced team will help you select the perfect boat and equipment, ensuring your trip exceeds your expectations.')}}
              </p>
            </v-col>

            <v-col cols="12" md="6">
              <span class="font-weight-bold text-h5">{{$t('Quality Materials')}}</span>
              <p class="mt-5 text-body-1 font-weight-medium">
                {{$t('We only use the finest boats and fishing gear to ensure a safe, enjoyable, and durable experience.')}}
              </p>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref } from "vue";

const imageUrl ='family.jpg';

</script>
