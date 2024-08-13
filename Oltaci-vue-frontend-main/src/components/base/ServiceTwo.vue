<template>
  <v-container fluid class="px-16">
    <v-card variant="flat" class="pa-5">
      <v-row class="d-flex align-start justify-center">
        <v-col cols="12" md="6" class="">
          <h6 class="font-weight-bold text-h6">{{$t('Expertise')}}</h6>
          <p class="mb-2 mt-5 font-weight-bold text-h2">
           {{$t('Seasonal Personal Touring Services for Every Season')}}
          </p>
        </v-col>

        <v-col cols="12" md="6">
          <div class="px-14 mb-12">
            <p class="mt-12 mr-12 text-h6 font-weight-medium">
              {{$t(`At Oltaci, we understand the importance of adapting our touring services to the changing seasons. Our team of experts is here to provide you with top-notch seasonal touring experiences all year round.`)}}
            </p>
          </div>
          <v-row class="px-14 mt-12">
            <v-col cols="12" md="6">
              <v-icon large class="mb-5">mdi-circle</v-icon><br />
              <span class="font-weight-bold text-h5">{{$t('Spring Care')}}</span>
              <p class="mt-5 text-body-1 font-weight-medium">
                {{$t(`Prepare for springtime adventures with our comprehensive seasonal care services.`)}}
              </p>
            </v-col>

            <v-col cols="12" md="6">
              <v-icon large class="mb-5">mdi-circle</v-icon><br />
              <span class="font-weight-bold text-h5">{{$t('Summer Care')}}</span>
              <p class="my-5 text-body-1 font-weight-medium">
                {{$t('Keep your outdoor experiences vibrant and enjoyable throughout the summer with our tailored summer care solutions.')}}
              </p>
            </v-col>
            <v-card-actions class="mb-16">
              <v-btn rounded="lg" class="border">{{$t('Learn More')}}</v-btn>
              <v-btn
                color="black"
                text="Submit"
                variant="flat"
                rounded="lg"
                class="border"
                width="50%"
                >{{$t('Sign Up')}}</v-btn
              >
            </v-card-actions>
          </v-row>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12" md="12" class="d-flex align-center justify-center">
          <v-img :src="imageUrl" height="100%" width="100%"></v-img>
        </v-col>
      </v-row>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref } from "vue";

import { useI18n } from "vue-i18n";

const { t } = useI18n();

const imageUrl = "boat-trip.jpg";
</script>
