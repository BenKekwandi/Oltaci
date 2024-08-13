<template>
  <v-container fluid class="pt-16" style="max-width: 1600px">
    <v-row>
      <v-col cols="8">
        <v-card variant="elevated" class="pa-4">
          <v-card-text class="font-weight-regular text-h5">
            <h2 class="text-left">{{ $t('Payment Detail') }}</h2>
            <div class="d-flex pt-4">
              <v-row>
                <v-col cols="12" class="text-left">
                  <h3 class="my-5 font-weight-bold text-h6">
                    {{$t('Please Review Your Information')}}
                  </h3>
                  <p class="text-red-darken-4 text-body-1">{{ 
                  $t(`
                    To ensure the accuracy of your submission, we kindly ask you
                    to review the information you've provided. Accurate data
                    helps us serve you better and prevents any potential issues
                    or delays.
                  `)
                  }}
                  
                  </p>
                  <v-form>
                    <h3 class="my-5">{{$t('Personal Information')}}</h3>
                    <v-row>
                      <v-col cols="12" md="6">
                        <v-text-field
                          v-model="reservationData.identity_number"
                          density="comfortable"
                          menu-icon=""
                          variant="solo"
                          :label="$t('Identity Number')"
                          rounded
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12" md="6">
                        <v-text-field
                          v-model="reservationData.phone"
                          :counter="10"
                          :label="$t('Phone Number')"
                          hide-details
                          density="comfortable"
                          variant="solo"
                          rounded
                          required
                        ></v-text-field>
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col cols="12" md="12">
                        <v-text-field
                          v-model="reservationData.email"
                          density="comfortable"
                          menu-icon=""
                          variant="solo"
                          :label="t('Email Address')"
                          rounded
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12" md="12">
                        <v-textarea
                          v-model="reservationData.address"
                          :counter="10"
                          :label="t('Address')"
                          hide-details
                          density="comfortable"
                          variant="solo"
                          rounded
                          required
                        ></v-textarea>
                      </v-col>
                    </v-row>
                  </v-form>
                </v-col>
              </v-row>
            </div>
            <v-card-actions>
              <v-btn
                class="mt-5"
                color="black"
                :text="t('Submit')"
                variant="flat"
                rounded="lg"
                width="16%"
                :loading="loading"
                @click="save"
                >Submit</v-btn
              >
            </v-card-actions>
          </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="4">
        <v-card rounded>
          <v-img :src="imageUrl" :height="300"></v-img>
          <v-card-text>
            <v-row class="d-flex align-center justify-space-between mt-4">
              <v-col cols="6" class="text-left">
                <span class="font-weight-bold text-h6">{{$t('Departure Place')}} :</span>
              </v-col>
              <v-col cols="6" class="text-right">
                <span class="font-weight-bold text-h6 text-grey">{{
                  reservationData.departure_place
                }}</span>
              </v-col>
            </v-row>
            <v-row class="d-flex align-center justify-space-between mt-2">
              <v-col cols="6" class="text-left">
                <span class="font-weight-bold text-h6"
                  >{{$t('Departure Date/time')}} :</span
                >
              </v-col>

              <v-col cols="6" class="text-right">
                <span class="font-weight-bold text-h6 text-grey">{{
                  reservationData.departure_date
                }}</span>
              </v-col>
              <v-divider></v-divider>
            </v-row>
            <v-row class="d-flex align-center justify-space-between mt-2">
              <v-col cols="6" class="text-left">
                <span class="font-weight-bold text-h6">{{$t('Total')}} :</span>
              </v-col>
              <v-col cols="6" class="text-right">
                <span class="font-weight-bold text-h6 text-grey"
                  >${{ reservationData.total }}</span
                >
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref } from "vue";
import { defineProps } from "vue";
import { useReservationStore } from "../../stores/reservation";
import { usePaymentStore } from "../../stores/payment";
import { storeToRefs } from "pinia";
import { useSnackbarStore } from "../../stores/snackbar";
import { useCountdownStore } from "../../stores/countdown";

import { useI18n } from "vue-i18n";

const { t } = useI18n();

const reservationStore = useReservationStore();
const paymentStore = usePaymentStore();
const countdownStore = useCountdownStore();
const { reservationData, loading, response } = storeToRefs(reservationStore);
const { payments, paymentResponse } = storeToRefs(paymentStore);

const props = defineProps({
  reservationData: {
    type: Object,
    required: true,
  },
});

const payment = ref({
  reservation_id: "",
  email: reservationData.value.email,
  phone: reservationData.value.phone,
  address: reservationData.value.address,
  identity_number: reservationData.value.identity_number,
});

const imageUrl = ref(props.reservationData.image);

const save = async () => {
  await reservationStore.handleAddReservation(reservationData.value);
  if (
    response.value &&
    (response.value.status === 200 || response.value.status === 201)
  ) {
    const reservationId = response.value.data.data.id;
    payment.value = {
      ...payment.value,
      reservation_id: reservationId,
    };
    await paymentStore.handleAddedPayment(payment.value);

    if (
      paymentResponse.value &&
      (paymentResponse.value.status === 200 ||
        paymentResponse.value.status === 201)
    ) {
      const redirectUrl = paymentResponse.value.data.payment_url;
      window.location.href = redirectUrl;
      // countdownStore.startCountdown(redirectUrl);
      snackbarShow("Reservation has been added successfully", "success");
    } else {
      snackbarShow("Unable to process payment. Please try again.", "error");
    }
  } else {
    snackbarShow("Unable to create reservation. Please try again.", "error");
  }
};

const snackbarShow = (message, type) => {
  useSnackbarStore().showSnackbar(message, type);
};
</script>

<style scoped lang="scss"></style>
