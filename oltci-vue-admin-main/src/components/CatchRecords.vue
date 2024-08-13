<template>
  <v-card color="grey-lighten-5">
    <v-card-title class="d-flex justify-space-between align-center pa-5">
      <div>{{ $t('Catch Records') }}</div>
      <v-dialog max-width="500" v-model="dialogAddCatchRecord">
        <template v-slot:activator="{ props }">
          <v-btn
            prepend-icon="fa-plus"
            color="orange-darken-4"
            variant="outlined"
            v-bind="props"
            >{{ $t('Catch Record') }}</v-btn
          >
        </template>

        <v-card :title="formTitle">
          <v-card-text class="mt-4">
            <v-autocomplete
              :label="$t('Trip')"
              v-model="trip"
              :item-title="item => `#${item.id}-${item.boat.name}  *${item.user.name}${item.user.lastname} *${item.departure}-${item.destination}`"
              item-value="id"
              :items="tripStore.trips"
              @update:modelValue="getTripId"
              variant="outlined"
              density="comfortable"
            >
          </v-autocomplete>

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
              v-model="species"
              :label="$t('Species')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <v-text-field
              v-model="weight"
              :label="$t('Weight')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <v-text-field
              v-model="quantity"
              :label="$t('Quantity')"
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
              <v-btn text="Close" variant="text" @click="closeAddCatchRecord"></v-btn>
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
      :items="catchRecords"
      :search="search"
      class="bg-grey-lighten-5"
      :mobile="sm || xs"
      :loading="loading"
      :sort-by="[{ key: 'id', order: 'desc' }]"
    >
      <template v-slot:item.actions="{ item }">
        <v-btn
          size="x-small"
          class="me-2"
          variant="tonal"
          icon="mdi-pencil"
          @click="editCatchRecord(item)"
        ></v-btn>
        <v-btn
          size="x-small"
          color="red-darken-4"
          variant="tonal"
          icon="mdi-trash-can"
          @click="deleteCatchRecord(item.id)"
        ></v-btn>
      </template>
    </v-data-table>
  </v-card>

  <DialogDelete
    v-model="dialogDelete"
    @confirm="deleteCatchRecordConfirm"
    @close="closeDeleteCatchRecord"
    entity="catchRecord"
    :loading="loading"
  />
</template>

<script setup>
import { ref, computed, watch, onMounted } from "vue";
import { useCatchRecordStore } from "../stores/catch-records";
import { useBoatStore } from "../stores/boats";
import { useTripStore } from "../stores/trips";
import { useRegionStore } from "../stores/regions";
import { useCaptainStore } from "../stores/captains";
import { useSnackbarStore } from "../stores/snackbar";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";
import DialogDelete from "../components/base/DeleteDialog.vue";

import { useI18n } from "vue-i18n";

const { t } = useI18n();


const { xs, sm } = useDisplay();
const store = useCatchRecordStore();
const tripStore = useTripStore();
const boatStore = useBoatStore();
const regionStore = useRegionStore();
const captainStore = useCaptainStore();

const { catchRecords, loading, response } = storeToRefs(store);
const { trips } = storeToRefs(tripStore);

const search = ref("");

const headers = [
  {
    align: "start",
    key: "id",
    title: "ID",
  },
  { key: "boat.name", title: t('Boat') },
  { key: "trip", title: t('Trip') },
  { key: "species", title: t('Species') },
  { key: "weight", title: t('Weight') },
  { key: "quantity", title: t('Quantity') },
  { key: "actions", title: t('Actions'), align: "end", sortable: false },
];

const dialogAddCatchRecord = ref(false);
const dialogDelete = ref(false);
const editedIndex = ref(-1);

const formTitle = computed(() => {
  return editedIndex.value === -1 ? t('Add new Catch Record') : t('Edit Catch record');
});

const catchRecord = ref({
  boat_id: "",
  trip_id: "",
  species: "",
  weight: "",
  quantity: ""
});

const defaultCatchRecord = {
  boat_id: "",
  trip_id: "",
  species: "",
  weight: "",
  quantity: ""
};

const boat = ref("");

const editCatchRecord = (item) => {
  dialogAddCatchRecord.value = true;
  editedIndex.value = catchRecords.value.indexOf(item);
  catchRecord.value.id = item.id;
  catchRecord.value.boat_id = item.boat.id;
  catchRecord.value.trip_id = item.trip_id;
  catchRecord.value.species = item.species;
  boat.value = Object.assign({}, item.boat);

};

const getBoatId = (val) => {
  catchRecord.value.boat_id = val;
};


const getTripId = (val) => {
  catchRecord.value.trip_id = val;
};

const getRegionId = (val) => {
  catchRecord.value.region_id = val;
};

const getCaptainId = (val) => {
  catchRecord.value.captain_id = val;
};

const deleteCatchRecord = (id) => {
  catchRecord.value.id = id;
  dialogDelete.value = true;
};

async function initialize() {
  await store.fetchCatchRecords();
}

onMounted(async () => {
  await boatStore.fetchBoats();
  await regionStore.fetchRegions();
  await captainStore.fetchCaptains();
  await tripStore.fetchTrips();
});

const save = async () => {
  if (editedIndex.value > -1) {
    await store.handleUpdatedCatchRecord(catchRecord.value, catchRecord.value.id);
    if (response.value.status === 200 || response.value.status === 204) {
      initialize();
      closeAddCatchRecord();
      snackbarShow("Data has been updated successfully", "success");
    } else {
      snackbarShow("Unable to update data. Please try again.", "error");
    }
  } else {
    await store.handleAddedCatchRecord(catchRecord.value);
    if (response.value.status === 200 || response.value.status === 201) {
      initialize();
      closeAddCatchRecord();
      snackbarShow("Data has been added successfully", "success");
    } else {
      snackbarShow("Unable to create data. Please try again.", "error");
    }
  }
  response.value = null;
};

const deleteCatchRecordConfirm = async () => {
  await store.handleDeletedCatchRecord(catchRecord.value.id);
  if (response.value.status === 204) {
    initialize();
    closeDeleteCatchRecord();
    snackbarShow("Data has been removed successfully", "success");
  } else {
    snackbarShow("Unable to remove data. Please try again.", "error");
  }
};

const closeDeleteCatchRecord = () => {
  dialogDelete.value = false;
  catchRecord.value = Object.assign({}, defaultCatchRecord);
};

const closeAddCatchRecord = async () => {
  dialogAddCatchRecord.value = false;
  setTimeout(() => {
    catchRecord.value = Object.assign({}, defaultCatchRecord);
    boat.value = "";
    region.value = "";
    editedIndex.value = -1;
  }, 250);
};

const snackbarShow = (message, type) => {
  useSnackbarStore().showSnackbar(message, type);
};

watch(dialogAddCatchRecord, (val) => {
  val || closeAddCatchRecord();
});

initialize();
</script>




