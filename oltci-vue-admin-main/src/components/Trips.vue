<template>
  <v-card color="grey-lighten-5">
    <v-card-title class="d-flex justify-space-between align-center pa-5">
      <div>{{ $t('Trips') }}</div>
      <v-dialog max-width="500" v-model="dialogAddTrip">
        <template v-slot:activator="{ props }">
          <v-btn
            prepend-icon="fa-plus"
            color="orange-darken-4"
            variant="outlined"
            v-bind="props"
            >{{ $t('Trip') }}</v-btn
          >
        </template>

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
              v-model="trip.start"
              :label="$t('Start')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <v-text-field
              v-model="trip.end"
              :label="$t('End')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <v-text-field
              v-model="trip.departure"
              :label="$t('Departure')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>


            <v-text-field
              v-model="trip.destination"
              :label="$t('Destination')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <v-autocomplete
              v-model="captain"
              :label="$t('Captain')"
              variant="outlined"
              item-title="first_name"
              item-value="id"
              density="comfortable"
              @update:modelValue="getCaptainId"
              :items="captainStore.captains"
            ></v-autocomplete>


            <br />
            <div class="d-flex justify-end">
              <v-btn
                :text="$t('Save')"
                variant="text"
                color="orange-darken-4"
                @click="save"
                :loading="loading"
              ></v-btn>
              <v-btn text="Close" variant="text" @click="closeAddTrip"></v-btn>
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
      :items="trips"
      :search="search"
      class="bg-grey-lighten-5"
      :mobile="sm || xs"
      :loading="loading"
      :sort-by="[{ key: 'status', order: 'desc' }]"
      :sort-desc="[true]"
    >
      <template v-slot:item.actions="{ item }">
        <v-btn
          size="x-small"
          class="me-2"
          variant="tonal"
          icon="mdi-pencil"
          @click="editTrip(item)"
        ></v-btn>
        <v-btn
          size="x-small"
          color="red-darken-4"
          variant="tonal"
          icon="mdi-trash-can"
          @click="deleteTrip(item.id)"
        ></v-btn>
      </template>
      <template v-slot:item.status="{ item }">
        <v-chip v-if="item.status === 'SCHEDULED'" color="yellow-darken-2">
          {{ $t('SCHEDULED') }}
        </v-chip>
        <v-chip v-else-if="item.status === 'COMPLETED'" color="blue-darken-2">
          {{ $t('COMPLETED') }}
        </v-chip>
        <v-chip v-else-if="item.status === 'ONGOING'" color="green-darken-2">
          {{ $t('ONGOING') }}
        </v-chip>
      </template>
    </v-data-table>
  </v-card>

  <DialogDelete
    v-model="dialogDelete"
    @confirm="deleteTripConfirm"
    @close="closeDeleteTrip"
    entity="trip"
    :loading="loading"
  />
</template>




<script setup>
import { ref, computed, watch, onMounted } from "vue";
import { useTripStore } from "../stores/trips";
import { useBoatStore } from "../stores/boats";
import { useCaptainStore } from "../stores/captains";
import { useSnackbarStore } from "../stores/snackbar";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";
import DialogDelete from "../components/base/DeleteDialog.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
const { xs, sm } = useDisplay();

const store = useTripStore();
const boatStore = useBoatStore();
const captainStore = useCaptainStore();
const snackbarStore = useSnackbarStore();

const { trips, loading, response } = storeToRefs(store);

const search = ref("");

const headers = [
  {
    align: "start",
    key: "id",
    title: "ID",
  },
  { key: "boat.name", title: t('Boat') },
  { key: "captain", title: t('Captain'), value: (item) => `${item.captain.first_name} ${item.captain.last_name}` },
  { key: "departure", title: t('Departure'), value: (item) => `${item.departure}, ${item.start}` },
  { key: "return", title: t('Return'), value: (item) => `${item.destination}, ${item.end}` },
  { key: "status", title: t('Status') },
  { key: "actions", title: t('Actions'), align: "end", sortable: false },
];

const dialogAddTrip = ref(false);
const dialogDelete = ref(false);
const editedIndex = ref(-1);

const formTitle = computed(() => {
  return editedIndex.value === -1 ? t('Create_new_trip') : t('Edit_trip');
});

const trip = ref({
  boat_id: "",
  end: "",
  start: "",
  departure: "",
  destination: "",
  captain_id: "",
  status: ""
});

const defaultTrip = {
  boat_id: "",
  end: "",
  start: "",
  departure: "",
  destination: "",
  captain_id: "",
  status: ""
};

const boat = ref("");
const captain = ref("");

const editTrip = (item) => {
  dialogAddTrip.value = true;
  editedIndex.value = trips.value.indexOf(item);
  trip.value.id = item.id;
  trip.value.boat_id = item.boat.id;
  trip.value.start = item.start;
  trip.value.end = item.end;
  trip.value.departure = item.departure;
  trip.value.destination = item.destination;
  trip.value.captain_id = item.captain.id;
  trip.value.status = item.status;
  boat.value = Object.assign({}, item.boat);
  captain.value = Object.assign({}, item.captain);
};

const getBoatId = (val) => {
  trip.value.boat_id = val;
};

const getCaptainId = (val) => {
  trip.value.captain_id = val;
};

const deleteTrip = (id) => {
  trip.value.id = id;
  dialogDelete.value = true;
};

const initialize = async () => {
  loading.value = true;
  await store.fetchTrips();
  console.log('trips', trips.value);
  loading.value = false;
};

onMounted(async () => {
  await boatStore.fetchBoats();
  await captainStore.fetchCaptains();
  await initialize();
});

const save = async () => {
  if (editedIndex.value > -1) {
    await store.handleUpdatedTrip(trip.value, trip.value.id);
    if (response.value.status === 200 || response.value.status === 204) {
      initialize();
      closeAddTrip();
      snackbarStore.showSnackbar("Data has been updated successfully", "success");
    } else {
      snackbarStore.showSnackbar("Unable to update data. Please try again.", "error");
    }
  } else {
    await store.handleAddedTrip(trip.value);
    if (response.value.status === 200 || response.value.status === 201) {
      initialize();
      closeAddTrip();
      snackbarStore.showSnackbar("Data has been added successfully", "success");
    } else {
      snackbarStore.showSnackbar("Unable to create data. Please try again.", "error");
    }
  }
  response.value = null;
};

const deleteTripConfirm = async () => {
  await store.handleDeletedTrip(trip.value.id);
  if (response.value.status === 204) {
    initialize();
    closeDeleteTrip();
    snackbarStore.showSnackbar("Data has been removed successfully", "success");
  } else {
    snackbarStore.showSnackbar("Unable to remove data. Please try again.", "error");
  }
};

const closeDeleteTrip = () => {
  dialogDelete.value = false;
  trip.value = Object.assign({}, defaultTrip);
};

const closeAddTrip = async () => {
  dialogAddTrip.value = false;
  setTimeout(() => {
    trip.value = Object.assign({}, defaultTrip);
    boat.value = "";
    editedIndex.value = -1;
  }, 250);
};

watch(dialogAddTrip, (val) => {
  val || closeAddTrip();
});
</script>
