<template>
  <v-card color="grey-lighten-5">
    <v-card-title class="d-flex justify-space-between align-center pa-5">
      <div>{{ $t('Boat Fueling') }}</div>
      <v-dialog max-width="500" v-model="dialogAddBoatFueling">
        <template v-slot:activator="{ props }">
          <v-btn
            prepend-icon="fa-plus"
            color="orange-darken-4"
            variant="outlined"
            v-bind="props"
            >{{ $t('Boat Fueling') }}</v-btn
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
              v-model="cost"
              :label="$t('Cost')"
              variant="outlined"
              density="comfortable"
              suffix="LITERS"
            ></v-text-field>

            <v-text-field
              v-model="quantity"
              :label="$t('Quantity')"
              variant="outlined"
              density="comfortable"
              suffix="TL"
            ></v-text-field>

            

            <v-text-field
              prefix="$"
              v-model="fueling_datetime"
              :label="$t('Fueling Date')"
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
              <v-btn text="Close" variant="text" @click="closeAddBoatFueling"></v-btn>
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
      :items="boatFuelings"
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
          @click="editBoatFueling(item)"
        ></v-btn>
        <v-btn
          size="x-small"
          color="red-darken-4"
          variant="tonal"
          icon="mdi-trash-can"
          @click="deleteBoatFueling(item.id)"
        ></v-btn>
      </template>
    </v-data-table>
  </v-card>

  <DialogDelete
    v-model="dialogDelete"
    @confirm="deleteBoatFuelingConfirm"
    @close="closeDeleteBoatFueling"
    entity="boatFueling"
    :loading="loading"
  />
</template>

<script setup>
  import { ref, computed, watch, onMounted } from "vue";
  import { useBoatFuelingStore } from "../stores/boat-fueling";
  import { useBoatStore } from "../stores/boats";
  import { useSnackbarStore } from "../stores/snackbar";
  import { useDisplay } from "vuetify";
  import { storeToRefs } from "pinia";
  import DialogDelete from "../components/base/DeleteDialog.vue";
  
  import { useI18n } from "vue-i18n";
  
  const { t } = useI18n();
  
  const { xs, sm } = useDisplay();
  
  const store = useBoatFuelingStore();
  const boatStore = useBoatStore();
  
  const { boatFuelings, loading, response } = storeToRefs(store);
  
  const search = ref("");
  
  const headers = [
    {
      align: "start",
      key: "id",
      title: "ID",
    },
    { key: "boat.name", title: t('Boat') },
    { key: "cost", title: t('Cost') },
    { key: "currency", title: t('Currency') },
    { key: "quantity", title: t('Quantity (liters)') },
    { key: "fueling_datetime", title: t('Fueling Date') },
    { key: "actions", title: t('Actions'), align: "end", sortable: false },
  ];
  
  const dialogAddBoatFueling = ref(false);
  const dialogDelete = ref(false);
  const editedIndex = ref(-1);
  
  const formTitle = computed(() => {
    return editedIndex.value === -1 ? t('Add Fueling Record') : t('Edit Fueling Record');
  });
  
  const boatFueling = ref({
    boat_id: "",
    cost: "",
    quantity: "",
    fueling_datetime: "",
  });
  
  const defaultBoatFueling = {
    boat_id: "",
    cost: "",
    quantity: "",
    fueling_datetime: "",
  };
  
  const boat = ref("");
  
  const editBoatFueling = (item) => {
    dialogAddBoatFueling.value = true;
    editedIndex.value = boatFuelings.value.indexOf(item);
    boatFueling.value.id = item.id;
    boatFueling.value.boat_id = item.boat.id;
    boatFueling.value.cost = item.cost;
    boatFueling.value.quantity = item.quantity;
    boatFueling.value.fueling_datetime = item.fueling_datetime;
    boat.value = Object.assign({}, item.boat);
  };
  
  const getBoatId = (val) => {
    boatFueling.value.boat_id = val;
  };
;
  
  const deleteBoatFueling = (id) => {
    boatFueling.value.id = id;
    dialogDelete.value = true;
  };
  
  async function initialize() {
    await store.fetchBoatFuelings();
  }
  
  onMounted(async () => {
    await boatStore.fetchBoats();
  });
  
  const save = async () => {
    if (editedIndex.value > -1) {
      await store.handleUpdatedBoatFueling(boatFueling.value, boatFueling.value.id);
      if (response.value.status === 200 || response.value.status === 204) {
        initialize();
        closeAddBoatFueling();
        snackbarShow("Data has been updated successfully", "success");
      } else {
        snackbarShow("Unable to update data. Please try again.", "error");
      }
    } else {
      await store.handleAddedBoatFueling(boatFueling.value);
      if (response.value.status === 200 || response.value.status === 201) {
        initialize();
        closeAddBoatFueling();
        snackbarShow("Data has been added successfully", "success");
      } else {
        snackbarShow("Unable to create data. Please try again.", "error");
      }
    }
    response.value = null;
  };
  
  const deleteBoatFuelingConfirm = async () => {
    await store.handleDeletedBoatFueling(boatFueling.value.id);
    if (response.value.status === 204) {
      initialize();
      closeDeleteBoatFueling();
      snackbarShow("Data has been removed successfully", "success");
    } else {
      snackbarShow("Unable to remove data. Please try again.", "error");
    }
  };
  
  const closeDeleteBoatFueling = () => {
    dialogDelete.value = false;
    boatFueling.value = Object.assign({}, defaultBoatFueling);
  };
  
  const closeAddBoatFueling = async () => {
    dialogAddBoatFueling.value = false;
    setTimeout(() => {
      boatFueling.value = Object.assign({}, defaultBoatFueling);
      boat.value = "";
      dock.value = "";
      editedIndex.value = -1;
    }, 250);
  };
  
  const snackbarShow = (message, type) => {
    useSnackbarStore().showSnackbar(message, type);
  };
  
  watch(dialogAddBoatFueling, (val) => {
    val || closeAddBoatFueling();
  });
  
  initialize();
</script>

