<template>
  <v-card color="grey-lighten-5">
    <v-card-title class="d-flex justify-space-between align-center pa-5">
      <div>{{ $t("Reservations") }}</div>
      <v-dialog max-width="500" v-model="dialogAddReservation">
        <!-- <template v-slot:activator="{ props }">
                    <v-btn prepend-icon="fa-plus" color="orange-darken-4" variant="outlined"
                        v-bind="props">{{ $t('Reservation') }}</v-btn>
                </template> -->

        <v-card :title="formTitle">
          <v-card-text class="mt-4">
            <v-autocomplete
              :label="$t('Boat')"
              v-model="boat"
              item-title="name"
              item-value="id"
              :items="boatStore.boats"
              @update:modelValue="getBoatId"
              variant="outlined"
              density="comfortable"
            ></v-autocomplete>

            <v-text-field
              v-model="tour.duration"
              :label="$t('Duration')"
              variant="outlined"
              density="comfortable"
              suffix="HOURS"
            ></v-text-field>

            <v-autocomplete
              v-model="region"
              :label="$t('Region')"
              variant="outlined"
              item-title="location"
              item-value="id"
              density="comfortable"
              @update:modelValue="getRegionId"
              :items="regionStore.regions"
            ></v-autocomplete>

            <v-text-field
              prefix="$"
              v-model="tour.price"
              :label="$t('Price')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <br />
            <div class="d-flex justify-end">
              <v-btn
                :text="$t('Save')"
                variant="text"
                color="orange-darken-4"
                @click="save"
                :loading="loading"
              ></v-btn>
              <v-btn text="Close" variant="text" @click="closeAddTour"></v-btn>
            </div>
          </v-card-text>
        </v-card>
      </v-dialog>

      <v-dialog max-width="500" v-model="dialogPayReservation">
        <!-- <template v-slot:activator="{ props }">
                    <v-btn prepend-icon="fa-plus" color="orange-darken-4" variant="outlined"
                        v-bind="props">{{ $t('Reservation') }}</v-btn>
                </template> -->

        <v-card :title="formTitle">
          <v-card-text class="mt-4">

            <v-text-field
              prefix="$"
              v-model="amount"
              :label="$t('Amount')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <br />
            <div class="d-flex justify-end">
              <v-btn
                :text="$t('Save')"
                variant="text"
                color="orange-darken-4"
                @click="save"
                :loading="loading"
              ></v-btn>
              <v-btn text="Close" variant="text" @click="closePayReservation"></v-btn>
            </div>
          </v-card-text>
        </v-card>
      </v-dialog>

    </v-card-title>
    <v-card-text>
      <v-row>
        <v-col cols="12" md="4" sm="4">
          <v-text-field
            v-model="search"
            :label="$t('Search')"
            prepend-inner-icon="mdi-magnify"
            variant="outlined"
            hide-details
            single-line
            density="compact"
          ></v-text-field>
        </v-col>
      </v-row>
    </v-card-text>

    <v-data-table
      :headers="headers"
      :items="reservations"
      :search="search"
      class="bg-grey-lighten-5"
      :mobile="sm || xs"
      :sort-by="[{ key: 'id', order: 'desc' }]"
    >
      <template v-slot:item.actions="{ item }">
        <v-btn size="x-small" class="me-2" variant="tonal" icon="mdi-cash" @click="payReservation(item)"></v-btn>
        <v-btn size="x-small" class="me-2" variant="tonal" icon="mdi-pencil" @click="editReservation(item)"></v-btn>
        <v-btn size="x-small" color="red-darken-4" variant="tonal" icon="mdi-trash-can"
                    @click="deleteReservation(item.id)"></v-btn>
      </template>

      <template v-slot:item.has_been_paid="{ item }">
        <v-chip v-if="item.has_been_paid" color="light-blue-darken-2">
            {{ $t('Confirmed') }}
        </v-chip>
        <v-chip v-else color="yellow-darken-2">
            {{ $t('Pending') }}
        </v-chip>
      </template>
    </v-data-table>
  </v-card>

</template>

<script setup>
import { ref, computed } from "vue";
import { useReservationStore } from "../stores/reservation";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";

import { useI18n } from "vue-i18n";

const { t } = useI18n();

const store = useReservationStore();
const { reservations } = storeToRefs(store);

const { xs, sm } = useDisplay();

const dialogAddReservation = ref(false);
const dialogPayReservation = ref(false);
const editedIndex = ref(-1);

const search = ref("");
const headers = [
  {
    align: "start",
    key: "id",
    title: "ID",
  },
  { key: "member", title: t('Member'), value: (item) => `${item.user.name} ${item.user.lastname}` },
  { key: "tour.boat.name", title: t('Boat') },
  { key: "departure", title: t('Departure'), value: (item) => `${item.tour.departure.location}, ${item.departure_date}` },
  { key: "return", title: t('Return'), value: (item) => `${item.tour.destination.location}, ${item.return_date}` },
  { key: "total_price", title: t('Total Price') },
  { key: "currency", title: t('Currency') },
  { key: "number_of_people", title: t('Number Of People') },
  { key: 'has_been_paid', title: t('Confirmed') },
  { key: "actions", title: t('Actions'), align: "end", sortable: false },

];

const reservation = ref({
  tour_id: "",
  username: "",
  total_price: "",
  payment: "",
  number_of_people: "",
  has_been_paid: "",
  has_been_verified: "",
});

const defaultReservation = {
  tour_id: "",
  username: "",
  total_price: "",
  payment: "",
  number_of_people: "",
  has_been_paid: "",
  has_been_verified: "",
};

const formTitle = computed(() => {
  return editedIndex.value === -1
    ? "Create New Reservation"
    : "Edit Reservation";
});

const editReservation = (item) => {
  dialogAddReservation.value = true;
  editedIndex.value = reservations.value.indexOf(item);
  reservation.value = Object.assign({}, item);
};

const payReservation = (item) => {
  dialogPayReservation.value = true;
  // editedIndex.value = reservations.value.indexOf(item);
  // reservation.value = Object.assign({}, item);
};

const save = async () => {
  if (editedIndex.value > -1) {
    await store.updateItemHandler(editedItemData.value.id, data);
    if (res.value) {
      Object.assign(collection.value[editedIndex.value], res.value.data);
      close();
      // emit("alert", res.value.message, res.value.status);
    } else {
      // emit("alert", errors.value, "error");
    }
  } else {
    await store.handleAddedUser(user.value);
    initialize();
    // if (res.value) {
    //     collection.value.push(res.value.data);
    //     close();
    //     emit("alert", res.value.message, res.value.status);
    // } else {
    //     emit("alert", errors.value, "error");
    // }
  }
  // res.value = null;
};

async function initialize() {
  await store.fetchReservations();
}

const closeAddUser = async () => {
  dialogAddUser.value = false;
  setTimeout(() => {
    user.value = Object.assign({}, defaultUser);
    editedIndex.value = -1;
  }, 500);
};

const closePayReservation = async () => {
  dialogPayReservation.value = false;
  setTimeout(() => {
    // user.value = Object.assign({}, defaultUser);
    // editedIndex.value = -1;
  }, 500);
};

initialize();
</script>
