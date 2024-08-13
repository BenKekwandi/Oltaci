<template>
    <v-card color="grey-lighten-5">
      <v-card-title class="d-flex justify-space-between align-center pa-5">
        <div>{{ $t('Tours') }}</div>
        <v-dialog max-width="500" v-model="dialogAddTour">
          <template v-slot:activator="{ props }">
            <v-btn
              prepend-icon="fa-plus"
              color="orange-darken-4"
              variant="outlined"
              v-bind="props"
              >{{ $t('Tour') }}</v-btn
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
        :items="tours"
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
            @click="editTour(item)"
          ></v-btn>
          <v-btn
            size="x-small"
            color="red-darken-4"
            variant="tonal"
            icon="mdi-trash-can"
            @click="deleteTour(item.id)"
          ></v-btn>
        </template>
      </v-data-table>
    </v-card>
  
    <DialogDelete
      v-model="dialogDelete"
      @confirm="deleteTourConfirm"
      @close="closeDeleteTour"
      entity="tour"
      :loading="loading"
    />
  </template>
  
  <script setup>
  import { ref, computed, watch, onMounted } from "vue";
  import { useTourStore } from "../stores/tours";
  import { useBoatStore } from "../stores/boats";
  import { useRegionStore } from "../stores/regions";
  import { useCaptainStore } from "../stores/captains";
  import { useSnackbarStore } from "../stores/snackbar";
  import { useDisplay } from "vuetify";
  import { storeToRefs } from "pinia";
  import DialogDelete from "../components/base/DeleteDialog.vue";
  
  import { useI18n } from "vue-i18n";
  
  const { t } = useI18n();
  
  
  const { xs, sm } = useDisplay();
  
  const store = useTourStore();
  const boatStore = useBoatStore();
  const regionStore = useRegionStore();
  const captainStore = useCaptainStore();
  
  const { tours, loading, response } = storeToRefs(store);
  
  const search = ref("");
  
  const headers = [
    {
      align: "start",
      key: "id",
      title: "ID",
    },
    { key: "boat.name", title: t('Boat') },
    { key: "region.location", title: t('Region') },
    { key: "duration", title: t('Duration') },
    { key: "price", title: t('Price') },
    { key: "actions", title: t('Actions'), align: "end", sortable: false },
  ];
  
  const dialogAddTour = ref(false);
  const dialogDelete = ref(false);
  const editedIndex = ref(-1);
  
  const formTitle = computed(() => {
    return editedIndex.value === -1 ? t('Create_new_tour') : t('Edit_tour');
  });
  
  const tour = ref({
    boat_id: "",
    duration: "",
    price: "",
    region_id: "",
    captain_id: "",
  });
  
  const defaultTour = {
    boat_id: "",
    duration: "",
    price: "",
    region_id: "",
    captain_id: "",
  };
  
  const boat = ref("");
  const region = ref("");
  const captain = ref("");
  
  const editTour = (item) => {
    dialogAddTour.value = true;
    editedIndex.value = tours.value.indexOf(item);
    tour.value.id = item.id;
    tour.value.boat_id = item.boat.id;
    tour.value.duration = item.duration;
    tour.value.price = item.price;
    tour.value.region_id = item.region.id;
    tour.value.captain_id = item.captain.id
    boat.value = Object.assign({}, item.boat);
    region.value = Object.assign({}, item.region);
    captain.value = Object.assign({}, item.captain);
  };
  
  const getBoatId = (val) => {
    tour.value.boat_id = val;
  };
  
  const getRegionId = (val) => {
    tour.value.region_id = val;
  };
  
  const getCaptainId = (val) => {
    tour.value.captain_id = val;
  };
  
  const deleteTour = (id) => {
    tour.value.id = id;
    dialogDelete.value = true;
  };
  
  async function initialize() {
    await store.fetchTours();
  }
  
  onMounted(async () => {
    await boatStore.fetchBoats();
    await regionStore.fetchRegions();
    await captainStore.fetchCaptains()
  });
  
  const save = async () => {
    if (editedIndex.value > -1) {
      await store.handleUpdatedTour(tour.value, tour.value.id);
      if (response.value.status === 200 || response.value.status === 204) {
        initialize();
        closeAddTour();
        snackbarShow("Data has been updated successfully", "success");
      } else {
        snackbarShow("Unable to update data. Please try again.", "error");
      }
    } else {
      await store.handleAddedTour(tour.value);
      if (response.value.status === 200 || response.value.status === 201) {
        initialize();
        closeAddTour();
        snackbarShow("Data has been added successfully", "success");
      } else {
        snackbarShow("Unable to create data. Please try again.", "error");
      }
    }
    response.value = null;
  };
  
  const deleteTourConfirm = async () => {
    await store.handleDeletedTour(tour.value.id);
    if (response.value.status === 204) {
      initialize();
      closeDeleteTour();
      snackbarShow("Data has been removed successfully", "success");
    } else {
      snackbarShow("Unable to remove data. Please try again.", "error");
    }
  };
  
  const closeDeleteTour = () => {
    dialogDelete.value = false;
    tour.value = Object.assign({}, defaultTour);
  };
  
  const closeAddTour = async () => {
    dialogAddTour.value = false;
    setTimeout(() => {
      tour.value = Object.assign({}, defaultTour);
      boat.value = "";
      region.value = "";
      editedIndex.value = -1;
    }, 250);
  };
  
  const snackbarShow = (message, type) => {
    useSnackbarStore().showSnackbar(message, type);
  };
  
  watch(dialogAddTour, (val) => {
    val || closeAddTour();
  });
  
  initialize();
  </script>
  