<template>
  <v-card color="grey-lighten-5">
    <v-card-title class="d-flex justify-space-between align-center pa-5">
      <div>{{$t("Additional Services")}}</div>
      <v-dialog max-width="500" v-model="dialogAddService">
        <template v-slot:activator="{ props }">
          <v-btn
            prepend-icon="fa-plus"
            color="orange-darken-4"
            variant="outlined"
            v-bind="props"
            >Service</v-btn
          >
        </template>
        <v-card :title="formTitle">
          <v-card-text class="mt-4">
            <v-text-field
              v-model="service.name"
              label="Name"
              variant="outlined"
              density="comfortable"
            ></v-text-field>
            <v-textarea
              v-model="service.description"
              label="Description"
              variant="outlined"
              rows="3"
            ></v-textarea>
            <v-text-field
              v-model="service.price"
              label="Price"
              variant="outlined"
              density="comfortable"
              prefix="$"
            ></v-text-field>
            <br />
            <div class="d-flex justify-end">
              <v-btn
                text="Save"
                variant="text"
                color="orange-darken-4"
                @click="save"
                :loading="loading"
              ></v-btn>
              <v-btn
                text="Close"
                variant="text"
                @click="closeAddService"
              ></v-btn>
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
            label="Search"
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
      :items="services"
      :search="search"
      class="bg-grey-lighten-5"
      :mobile="sm || xs"
      :sort-by="[{ key: 'id', order: 'desc' }]"
      :loading="loading"
    >
      <template v-slot:item.actions="{ item }">
        <v-btn
          size="x-small"
          class="me-2"
          variant="tonal"
          icon="mdi-pencil"
          @click="editService(item)"
        ></v-btn>
        <v-btn
          size="x-small"
          color="red-darken-4"
          variant="tonal"
          icon="mdi-trash-can"
          @click="deleteService(item.id)"
        ></v-btn>
      </template>
    </v-data-table>
  </v-card>

  <DialogDelete
    v-model="dialogDelete"
    @confirm="deleteServiceConfirm"
    @close="closeDeleteService"
    entity="service"
    :loading="loading"
  />
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { useServiceStore } from "../stores/additional-service";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";
import { useSnackbarStore } from "../stores/snackbar";
import DialogDelete from "../components/base/DeleteDialog.vue";

import { useI18n } from "vue-i18n";

const { t } = useI18n();

const store = useServiceStore();
const { services, loading, response } = storeToRefs(store);

const { xs, sm } = useDisplay();

const dialogAddService = ref(false);
const dialogDelete = ref(false);
const editedIndex = ref(-1);

const search = ref("");
const headers = [
  {
    align: "start",
    key: "id",
    title: "ID",
  },
  { key: "name", title: t('Name') },
  { key: "description", title: t('Description'), width: "40%" },
  { key: "price", title: t('Price') },
  { key: "currency", title: t('Currency') },
  { key: "actions", title: t('Actions'), align: "end", sortable: false },
];

const service = ref({
  name: "",
  description: "",
  price: "",
});

const defaultService = {
  name: "",
  description: "",
  price: "",
};

const formTitle = computed(() => {
  return editedIndex.value === -1 ? "Create New Service" : "Edit Service";
});

const editService = (item) => {
  dialogAddService.value = true;
  editedIndex.value = services.value.indexOf(item);
  service.value = Object.assign({}, item);
};

const deleteService = (id) => {
  service.value.id = id;
  dialogDelete.value = true;
};

const save = async () => {
  if (editedIndex.value > -1) {
    await store.handleUpdatedService(service.value, service.value.id);
    if (response.value.status === 200 || response.value.status === 204) {
      initialize();
      closeAddService();
      snackbarShow("Data has been updated successfully", "success");
    } else {
      snackbarShow("Unable to update data. Please try again.", "error");
    }
  } else {
    await store.handleAddedService(service.value);
    if (response.value.status === 200 || response.value.status === 201) {
      initialize();
      closeAddService();
      snackbarShow("Data has been added successfully", "success");
    } else {
      snackbarShow("Unable to create data. Please try again.", "error");
    }
  }
  response.value = null;
};

async function initialize() {
  await store.fetchServices();
}

const deleteServiceConfirm = async () => {
  await store.handleDeletedService(service.value.id);
  if (response.value.status === 204) {
    initialize();
    closeDeleteService();
    snackbarShow("Data has been removed successfully", "success");
  } else {
    snackbarShow("Unable to remove data. Please try again.", "error");
  }
};

const closeAddService = async () => {
  dialogAddService.value = false;
  setTimeout(() => {
    service.value = Object.assign({}, defaultService);
    editedIndex.value = -1;
  }, 250);
};

const closeDeleteService = () => {
  dialogDelete.value = false;
  editedIndex.value = -1;
};

const snackbarShow = (message, type) => {
  useSnackbarStore().showSnackbar(message, type);
};

watch(dialogAddService, (val) => {
  val || closeAddService();
});

initialize();
</script>