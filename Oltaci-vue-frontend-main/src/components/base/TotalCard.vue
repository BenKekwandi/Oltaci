<template>
  <v-card elevation="2" width="1000">
    <v-card-item>
      <v-card-title class="text-black">
        {{ tour.boat.description }} | {{ tour.boat.name }} | {{ tour.region.location }}
      </v-card-title>
      <v-divider :thickness="0.5" class="border-opacity-100 text-grey"></v-divider>
    </v-card-item>

    <v-card-text>
      <label class="font-weight-bold text-body-1" for="date">{{ $t('Date') }}:</label>
      <br />
      <v-menu :close-on-content-click="false" v-model="menu">
        <template v-slot:activator="{ props }">
          <v-btn class="mt-2 font-weight-bold border" variant="outlined" block v-bind="props">
            <span class="text-primary">
              {{ formattedDateFrom }} 
            </span>
          </v-btn>
        </template>
        <v-card>
          <v-card-text>
            <v-container fluid>
              <v-row justify="center">
                <v-date-picker color="primary" hide-header rounded="0" 
                  v-model="dateFrom"
                  @update:modelValue="formatFromDate"></v-date-picker>
                <!-- <v-date-picker color="primary" hide-header hide-details rounded="0" 
                  v-model="dateTo" :min="minDate"
                  @update:modelValue="formatToDate"></v-date-picker> -->
              </v-row>
              <v-divider></v-divider>
              <v-row justify="space-between" align="end" class="mt-4 mx-1">
                <div class="d-flex justify-space-between w-50">
                  <div>
                    <div>{{ $t('Total') }}</div>
                    <div class="font-weight-bold text-h6">{{ total }}$</div>
                  </div>
                  <!-- <div>
                    <div>{{ $t('Check In') }}</div>
                    <div class="font-weight-bold text-h6">9:00 AM</div>
                  </div>
                  <div>
                    <div>{{ $t('Check Out' )}}</div>
                    <div class="font-weight-bold text-h6">6:00 PM</div>
                  </div> -->
                </div>
                <div>
                  <v-btn class="mr-4" color="primary" variant="text" flat @click="cancelDates">{{$t('cancel')}}</v-btn>
                  <v-btn color="primary" flat @click="menu = false" :disabled="!ifDateSelected">{{$t('ok') }}</v-btn>
                </div>
              </v-row>
            </v-container>
          </v-card-text>
        </v-card>
      </v-menu>

      <div class="d-flex justify-space-between align-end mt-2">
        <v-col class="pl-0 ml-0" cols="7">
          <h3 class="font-weight-bold text-body-1">{{$t('Number Of People')}}</h3>
        </v-col>
        <v-col class="pl-0 ml-0" cols="5">
          <v-text-field density="compact" type="text" v-model="capacity" variant="underlined" hide-details>
            <template v-slot:append>
              <v-btn size="x-small" density="comfortable" icon="mdi-plus" color="white" @click="increaseCapacity"></v-btn>
            </template>
            <template v-slot:prepend>
              <v-btn size="x-small" density="comfortable" icon="mdi-minus" color="grey" @click="decreaseCapacity"></v-btn>
            </template>
          </v-text-field>
        </v-col>
      </div>
    </v-card-text>

    <v-card-text>
      <v-row class="d-flex align-center justify-space-between">
        <v-col cols="6">
          <span class="font-weight-bold text-body-1">{{$t('Rental')}} :</span>
        </v-col>
        <v-col cols="6" class="text-right">
          <span class="font-weight-bold text-body-1 text-grey">${{ price }}</span>
        </v-col>
      </v-row>
      <v-row class="d-flex align-center justify-space-between mt-2">
        <v-col cols="6">
          <span class="font-weight-bold text-body-1">{{ $t('Final Cleaning')}}:</span>
        </v-col>
        <v-col cols="6" class="text-right">
          <span class="font-weight-bold text-body-1 text-grey">{{$t('Offered')}}</span>
        </v-col>
      </v-row>

      <v-container>
        <v-row
          v-for="(service, index) in additionalServices"
          :key="index"
          class="d-flex align-center justify-space-between mt-2"
        >
          <v-col>
            <v-checkbox v-model="service.checked" @change="updateTotal"></v-checkbox>
          </v-col>
          <v-col>{{ service.name }}</v-col>
          <!-- <v-col>{{ service.description }}</v-col> -->
          <v-col>{{ service.price }}</v-col>
        </v-row>
      </v-container>

      <v-row class="d-flex align-center justify-space-between mt-2">
        <v-col cols="6">
          <span class="font-weight-bold text-body-1">{{$t('Total')}}:</span>
        </v-col>
        <v-col cols="6" class="text-right">
          <span class="font-weight-bold text-body-1 text-grey">${{ total }}</span>
        </v-col>
      </v-row>
    </v-card-text>

    <div class="d-flex justify-center">
      <v-btn class="my-2 text-primary border" variant="outlined" @click="makeRequest">
       {{$t('Make a request')}}
      </v-btn>
    </div>
  </v-card>
</template>

<script setup>
import { ref, defineProps, computed } from "vue";
import { useAuthStore } from "../../stores/auth";
import { useReservationStore } from "../../stores/reservation";
import { useAdditionalServiceStore } from "../../stores/additional_services";
import { useRouter } from "vue-router";
import { storeToRefs } from "pinia";
import { format, add, differenceInHours } from "date-fns";

const authStore = useAuthStore();
const resStore = useReservationStore();
const router = useRouter();
const capacity = ref(0);
const serviceStore = useAdditionalServiceStore();

const dialog = ref(false);

const { dialogLogin } = storeToRefs(authStore);

const { additionalServices, fetchAdditionalServices } = storeToRefs(serviceStore);

const { reservationData } = storeToRefs(resStore);

const props = defineProps({
  tour: {
    type: Object,
    required: true,
  },
});

const menu = ref(false);

const captain = ref(false);
const dateFrom = ref(new Date());
const dateTo = ref(add(new Date(), { days: 1 }));
const minDate = ref(null);
const ifDateSelected = ref(false);

const price = computed(() => {
  return parseFloat(props.tour.price).toFixed(2);
});

const formattedDateFrom = computed(() => format(dateFrom.value, "yyyy-MM-dd"));
const formattedDateTo = computed(() => format(dateTo.value, "yyyy-MM-dd"));

const total = computed(() => {
  const hours = differenceInHours(dateTo.value, dateFrom.value);
  const pricePerHour = props.tour.price / props.tour.duration;
  const baseTotal = hours * pricePerHour;
  const additionalServicesTotal = additionalServices.value.reduce((sum, service) => {
    return service.checked ? sum + parseFloat(service.price) : sum;
  }, 0);
  return (baseTotal + additionalServicesTotal).toFixed(2);
});

const makeRequest = () => {
  if (authStore.isLoggedIn) {
    reservationData.value.tour_id = props.tour.id;
    reservationData.value.user_id = authStore.user.id;
    reservationData.value.number_of_people = capacity.value;
    reservationData.value.with_captain = captain.value;
    reservationData.value.departure_date = formattedDateFrom.value;
    reservationData.value.image = props.tour.boat.picture;
    reservationData.value.total = total.value;
    reservationData.value.currency = 'TRY';
    reservationData.value.departure_place = props.tour.region.location;
    reservationData.value.return_date = formattedDateTo.value;
    router.push({ name: "payment" });
  } else {
    dialogLogin.value = true;
  }
};

const increaseCapacity = () => {
  capacity.value++;
};

const decreaseCapacity = () => {
  if (capacity.value > 0) {
    capacity.value--;
  }
};

const formatFromDate = (val) => {
  dateFrom.value = new Date(val);
  minDate.value = dateFrom.value;
  dateTo.value = add(dateFrom.value, { days: 1 });
  ifDateSelected.value = true;
};

const formatToDate = (val) => {
  dateTo.value = new Date(val);
  ifDateSelected.value = true;
};

const cancelDates = () => {
  menu.value = false;
  dateFrom.value = new Date();
  dateTo.value = add(new Date(), { days: 1 });
  ifDateSelected.value = false;
};

const updateTotal = () => {
  total.value; // This will trigger the computed property to update.
};
</script>
