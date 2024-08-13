<template>
    <v-card color="grey-lighten-5">
      <v-card-title class="d-flex justify-space-between align-center pa-5">
        <div>{{ $t('Subscribers') }}</div>
        <v-dialog max-width="500" v-model="dialogAddSubscriber">
          <template v-slot:activator="{ props }">
            <v-btn
              prepend-icon="fa-plus"
              color="orange-darken-4"
              variant="outlined"
              v-bind="props"
            >{{ $t('Subscriber') }}</v-btn>
          </template>
  
          <v-card :title="formTitle">
            <v-card-text class="mt-4">
  
              <v-text-field
                v-model="subscriber.first_name"
                :label="$t('Name')"
                variant="outlined"
                density="comfortable"
              ></v-text-field>

              <v-text-field
                v-model="subscriber.last_name"
                :label="$t('Surname')"
                variant="outlined"
                density="comfortable"
              ></v-text-field>
  
              <v-text-field
                v-model="subscriber.email"
                :label="$t('Email')"
                variant="outlined"
                density="comfortable"
              ></v-text-field>
  
              <v-text-field
                v-model="subscriber.phone"
                :label="$t('Phone')"
                variant="outlined"
                density="comfortable"
              ></v-text-field>
  
              <v-text-field
                v-model="subscriber.address"
                :label="$t('Address')"
                variant="outlined"
                density="comfortable"
              ></v-text-field>
  
              <!-- <v-text-field
                v-model="subscriber.notes"
                :label="$t('Notes')"
                variant="outlined"
                density="comfortable"
              ></v-text-field> -->
  
              <br />
              <div class="d-flex justify-end">
                <v-btn
                  :text="$t('Save')"
                  variant="text"
                  color="orange-darken-4"
                  @click="save"
                  :loading="loading"
                ></v-btn>
                <v-btn text="Close" variant="text" @click="closeAddSubscriber"></v-btn>
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
        :items="subscribers"
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
            @click="editSubscriber(item)"
          ></v-btn>
          <v-btn
            size="x-small"
            color="red-darken-4"
            variant="tonal"
            icon="mdi-trash-can"
            @click="deleteSubscriber(item.id)"
          ></v-btn>
        </template>
      </v-data-table>
    </v-card>
  
    <DialogDelete
      v-model="dialogDelete"
      @confirm="deleteSubscriberConfirm"
      @close="closeDeleteSubscriber"
      entity="subscriber"
      :loading="loading"
    />
  </template>
  
  <script setup>
import { ref, computed, watch, onMounted } from "vue";
import { useSubscriberStore } from "../stores/subscribers"; // Updated to subscriber store
import { useSnackbarStore } from "../stores/snackbar";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";
import DialogDelete from "../components/base/DeleteDialog.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();

const { xs, sm } = useDisplay();

const store = useSubscriberStore(); // Updated to subscriber store

const { subscribers, loading, response } = storeToRefs(store);

const search = ref("");

const headers = [
  {
    align: "start",
    key: "id",
    title: "ID",
  },
  { key: "first_name", title: t('Name') },
  { key: "last_name", title: t('Surname') },
  { key: "email", title: t('Email') },
  { key: "phone", title: t('Phone') },
  { key: "actions", title: t('Actions'), align: "end", sortable: false },
];

const dialogAddSubscriber = ref(false);
const dialogDelete = ref(false);
const editedIndex = ref(-1);

const formTitle = computed(() => {
  return editedIndex.value === -1 ? t('Record New Subscriber') : t('Edit Subscriber');
});

const subscriber = ref({
  id: "",
  first_name: "",
  last_name: "",
  email: "",
  phone: "",
  address: ""
});

const defaultSubscriber = {
  id: "",
  first_name: "",
  last_name: "",
  email: "",
  phone: "",
  address: ""
};

const editSubscriber = (item) => {
  dialogAddSubscriber.value = true;
  editedIndex.value = subscribers.value.indexOf(item);
  subscriber.value.id = item.id;
  subscriber.value.first_name = item.first_name;
  subscriber.value.last_name = item.last_name;
  subscriber.value.email = item.email;
  subscriber.value.phone = item.phone;
  subscriber.value.address = item.address;
};

const deleteSubscriber = (id) => {
  subscriber.value.id = id;
  dialogDelete.value = true;
};

async function initialize() {
  await store.fetchSubscribers(); // Updated to fetchSubscribers
}

onMounted(async () => {
  await initialize(); // Ensure subscribers are fetched on mount
});

const save = async () => {
  if (editedIndex.value > -1) {
    await store.handleUpdatedSubscriber(subscriber.value, subscriber.value.id); // Updated method
    if (response.value.status === 200 || response.value.status === 204) {
      await initialize();
      closeAddSubscriber();
      snackbarShow("Data has been updated successfully", "success");
    } else {
      snackbarShow("Unable to update data. Please try again.", "error");
    }
  } else {
    await store.handleAddedSubscriber(subscriber.value); // Updated method
    if (response.value.status === 200 || response.value.status === 201) {
      await initialize();
      closeAddSubscriber();
      snackbarShow("Data has been added successfully", "success");
    } else {
      snackbarShow("Unable to create data. Please try again.", "error");
    }
  }
  response.value = null;
};

const deleteSubscriberConfirm = async () => {
  await store.handleDeletedSubscriber(subscriber.value.id); // Updated method
  if (response.value.status === 204) {
    await initialize();
    closeDeleteSubscriber();
    snackbarShow("Data has been removed successfully", "success");
  } else {
    snackbarShow("Unable to remove data. Please try again.", "error");
  }
};

const closeDeleteSubscriber = () => {
  dialogDelete.value = false;
  subscriber.value = Object.assign({}, defaultSubscriber);
};

const closeAddSubscriber = async () => {
  dialogAddSubscriber.value = false;
  setTimeout(() => {
    subscriber.value = Object.assign({}, defaultSubscriber);
    editedIndex.value = -1;
  }, 250);
};

const snackbarShow = (message, type) => {
  useSnackbarStore().showSnackbar(message, type);
};

watch(dialogAddSubscriber, (val) => {
  val || closeAddSubscriber();
});

initialize();
</script>
