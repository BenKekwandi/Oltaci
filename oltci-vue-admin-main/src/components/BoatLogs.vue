<template>
  <v-card color="grey-lighten-5">
    <v-card-title class="d-flex justify-space-between align-center pa-5">
      <div>{{ $t('Boat Logs') }}</div>
      <v-dialog max-width="500" v-model="dialogAddBoatLog">
        <template v-slot:activator="{ props }">
          <v-btn
            prepend-icon="fa-plus"
            color="orange-darken-4"
            variant="outlined"
            v-bind="props"
            >{{ $t('Boat Logs') }}</v-btn
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

            <v-autocomplete
              :label="$t('Trips')"
              v-model="trip"
              item-title="name"
              item-value="id"
              :items="boatStore.boats"
              @update:modelValue="getBoatId"
              variant="outlined"
              density="comfortable"
            ></v-autocomplete>

            <v-text-field
              v-model="boatLog.duration"
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
              v-model="boatLog.price"
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
              <v-btn text="Close" variant="text" @click="closeAddBoatLog"></v-btn>
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
      :items="boatLogs"
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
          @click="editBoatLog(item)"
        ></v-btn>
        <v-btn
          size="x-small"
          color="red-darken-4"
          variant="tonal"
          icon="mdi-trash-can"
          @click="deleteBoatLog(item.id)"
        ></v-btn>
      </template>
    </v-data-table>
  </v-card>

  <DialogDelete
    v-model="dialogDelete"
    @confirm="deleteBoatLogConfirm"
    @close="closeDeleteBoatLog"
    entity="boat log"
    :loading="loading"
  />
</template>
<script setup>
  import { ref, computed, watch, onMounted } from "vue";
  import { useBoatLogStore } from "../stores/boat-log";
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
  
  const store = useBoatLogStore();
  const boatStore = useBoatStore();
  const regionStore = useRegionStore();
  const captainStore = useCaptainStore();
  
  const { boatLogs, loading, response } = storeToRefs(store);
  
  const search = ref("");
  
  const headers = [
    {
      align: "start",
      key: "id",
      title: "ID",
    },
    { key: "boat.name", title: t('Boat') },
    { key: "trip", title: t('Trip') },
    { key: "details", title: t('Details') },
    { key: "log_datetime", title: t('Date') },
    { key: "actions", title: t('Actions'), align: "end", sortable: false, width:"10%"},
  ];
  
  const dialogAddBoatLog = ref(false);
  const dialogDelete = ref(false);
  const editedIndex = ref(-1);
  
  const formTitle = computed(() => {
    return editedIndex.value === -1 ? t('Create_new_boat_log') : t('Edit_boat_log');
  });
  
  const boatLog = ref({
    boat_id: "",
    details: "",
    log_datetime: "",
  });
  
  const defaultBoatLog = {
    boat_id: "",
    details: "",
    log_datetime: "",
  };
  
  const boat = ref("");
  const region = ref("");
  const captain = ref("");
  
  const editBoatLog = (item) => {
    dialogAddBoatLog.value = true;
    editedIndex.value = boatLogs.value.indexOf(item);
    boatLog.value.id = item.id;
    boatLog.value.boat_id = item.boat.id;
    boatLog.value.details = item.details;
    boatLog.value.log_datetime = item.log_datetime;
    boat.value = Object.assign({}, item.boat);
  };
  
  const getBoatId = (val) => {
    boatLog.value.boat_id = val;
  };
  
  const getRegionId = (val) => {
    boatLog.value.region_id = val;
  };
  
  const getCaptainId = (val) => {
    boatLog.value.captain_id = val;
  };
  
  const deleteBoatLog = (id) => {
    boatLog.value.id = id;
    dialogDelete.value = true;
  };
  
  async function initialize() {
    await store.fetchBoatLogs();
  }
  
  onMounted(async () => {
    await boatStore.fetchBoats();
    await regionStore.fetchRegions();
    await captainStore.fetchCaptains()
  });
  
  const save = async () => {
    if (editedIndex.value > -1) {
      await store.handleUpdatedBoatLog(boatLog.value, boatLog.value.id);
      if (response.value.status === 200 || response.value.status === 204) {
        initialize();
        closeAddBoatLog();
        snackbarShow("Data has been updated successfully", "success");
      } else {
        snackbarShow("Unable to update data. Please try again.", "error");
      }
    } else {
      await store.handleAddedBoatLog(boatLog.value);
      if (response.value.status === 200 || response.value.status === 201) {
        initialize();
        closeAddBoatLog();
        snackbarShow("Data has been added successfully", "success");
      } else {
        snackbarShow("Unable to create data. Please try again.", "error");
      }
    }
    response.value = null;
  };
  
  const deleteBoatLogConfirm = async () => {
    await store.handleDeletedBoatLog(boatLog.value.id);
    if (response.value.status === 204) {
      initialize();
      closeDeleteBoatLog();
      snackbarShow("Data has been removed successfully", "success");
    } else {
      snackbarShow("Unable to remove data. Please try again.", "error");
    }
  };
  
  const closeDeleteBoatLog = () => {
    dialogDelete.value = false;
    boatLog.value = Object.assign({}, defaultBoatLog);
  };
  
  const closeAddBoatLog = async () => {
    dialogAddBoatLog.value = false;
    setTimeout(() => {
      boatLog.value = Object.assign({}, defaultBoatLog);
      boat.value = "";
      region.value = "";
      editedIndex.value = -1;
    }, 250);
  };
  
  const snackbarShow = (message, type) => {
    useSnackbarStore().showSnackbar(message, type);
  };
  
  watch(dialogAddBoatLog, (val) => {
    val || closeAddBoatLog();
  });
  
  initialize();
</script>
