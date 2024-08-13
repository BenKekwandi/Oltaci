<template>
  <v-card color="grey-lighten-5">
    <v-card-title class="d-flex justify-space-between align-center pa-5">
      <div>{{ $t("Equipments") }}</div>
      <v-dialog max-width="500" v-model="dialogAddEquipment">
        <template v-slot:activator="{ props }">
          <v-btn
            prepend-icon="fa-plus"
            color="orange-darken-4"
            variant="outlined"
            v-bind="props"
            >{{ $t("Equipment") }}</v-btn
          >
        </template>

        <v-card :title="formTitle">
          <v-card-text class="mt-4">

            <v-text-field
              v-model="equipment.name"
              :label="$t('Name')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <v-text-field
              v-model="equipment.description"
              :label="$t('Description')"
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
              <v-btn text="Close" variant="text" @click="closeAddEquipment"></v-btn>
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
      :items="equipments"
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
          @click="editEquipment(item)"
        ></v-btn>
        <v-btn
          size="x-small"
          color="red-darken-4"
          variant="tonal"
          icon="mdi-trash-can"
          @click="deleteEquipment(item.id)"
        ></v-btn>
      </template>
    </v-data-table>
  </v-card>

  <DialogDelete
    v-model="dialogDelete"
    @confirm="deleteEquipmentConfirm"
    @close="closeDeleteEquipment"
    entity="equipment"
    :loading="loading"
  />
</template>

<script setup>
import { ref, computed, watch, onMounted } from "vue";
import { useEquipmentStore } from "../stores/equipments";
import { useSnackbarStore } from "../stores/snackbar";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";
import DialogDelete from "../components/base/DeleteDialog.vue";

import { useI18n } from "vue-i18n";

const { t } = useI18n();

const { xs, sm } = useDisplay();

const store = useEquipmentStore();


const { equipments, loading, response } = storeToRefs(store);

const search = ref("");

const headers = [
  {
    align: "start",
    key: "id",
    title: "ID",
  },
  { key: "name", title: t("Name") },
  { key: "description", title: t("Description") },
  { key: "actions", title: t("Actions"), align: "end", sortable: false },
];

const dialogAddEquipment = ref(false);
const dialogDelete = ref(false);
const editedIndex = ref(-1);

const formTitle = computed(() => {
  return editedIndex.value === -1 ? t("Create New Equipment") : t("Edit Equipment");
});

const equipment = ref({
  id: "",
  name: "",
  description: "",

});

const defaultEquipment = {
  id: "",
  name: "",
  description: ""
};


const editEquipment = (item) => {
  dialogAddEquipment.value = true;
  editedIndex.value = equipments.value.indexOf(item);
  equipment.value.id = item.id;
  equipment.value.name = item.name;
  equipment.value.description = item.description;

};



const deleteEquipment = (id) => {
  equipment.value.id = id;
  dialogDelete.value = true;
};

async function initialize() {
  await store.fetchEquipments();
}

onMounted(async () => {
  await store.fetchEquipments();
});

const save = async () => {
  if (editedIndex.value > -1) {
    await store.handleUpdatedEquipment(equipment.value, equipment.value.id);
    if (response.value.status === 200 || response.value.status === 204) {
      initialize();
      closeAddEquipment();
      snackbarShow("Data has been updated successfully", "success");
    } else {
      snackbarShow("Unable to update data. Please try again.", "error");
    }
  } else {
    await store.handleAddedEquipment(equipment.value);
    if (response.value.status === 200 || response.value.status === 201) {
      initialize();
      closeAddEquipment();
      snackbarShow("Data has been added successfully", "success");
    } else {
      snackbarShow("Unable to create data. Please try again.", "error");
    }
  }
  response.value = null;
};

const deleteEquipmentConfirm = async () => {
  await store.handleDeletedEquipment(equipment.value.id);
  if (response.value.status === 204) {
    initialize();
    closeDeleteEquipment();
    snackbarShow("Data has been removed successfully", "success");
  } else {
    snackbarShow("Unable to remove data. Please try again.", "error");
  }
};

const closeDeleteEquipment = () => {
  dialogDelete.value = false;
  equipment.value = Object.assign({}, defaulEquipment);
};

const closeAddEquipment = async () => {
  dialogAddEquipment.value = false;
  setTimeout(() => {
    equipment.value = Object.assign({}, defaultEquipment);
    editedIndex.value = -1;
  }, 250);
};

const snackbarShow = (message, type) => {
  useSnackbarStore().showSnackbar(message, type);
};

watch(dialogAddEquipment, (val) => {
  val || closeAddEquipment();
});

initialize();
</script>
