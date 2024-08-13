<template>
  <v-card color="grey-lighten-5">
    <v-card-title class="d-flex justify-space-between align-center pa-5">
      <div>{{ $t('Invoice') }}</div>
      <v-dialog max-width="500" v-model="dialogAddInvoice">
        <template v-slot:activator="{ props }">
          <v-btn
            prepend-icon="fa-plus"
            color="orange-darken-4"
            variant="outlined"
            v-bind="props"
            >{{ $t('Invoice') }}</v-btn
          >
        </template>

        <v-card :title="formTitle">
          <v-card-text class="mt-4">

            <v-text-field
              v-model="invoice.invoice_number"
              :label="$t('Invoice Number')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <v-text-field
              v-model="invoice.invoice_date"
              :label="$t('Invoice Date')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>


            <v-text-field
              v-model="invoice.amount"
              :label="$t('Amount')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <v-text-field
              v-model="invoice.currency"
              :label="$t('Currency')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <v-select v-model="invoice.payment_type" :label="$t('Payment Type')" :items="['CASH', 'CARD']" variant="outlined"></v-select>

            <div> 
              <input type="file" @change="handleFileUpload" accept="image/jpg" ref="fileInput" class="d-none">
            </div>
            
            <br />
            <div class="d-flex justify-end">
              <v-btn
                :text="$t('Save')"
                variant="text"
                color="orange-darken-4"
                @click="save"
                :loading="loading"
              ></v-btn>
              <v-btn text="Close" variant="text" @click="closeAddInvoice"></v-btn>
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
      :items="invoices"
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
          @click="editInvoice(item)"
        ></v-btn>
        <v-btn
          size="x-small"
          color="red-darken-4"
          variant="tonal"
          icon="mdi-trash-can"
          @click="deleteInvoice(item.id)"
        ></v-btn>
      </template>
      <template v-slot:item.invoice_file="{ item }">
        <a :href="item.invoice_file">{{ item.id }}</a>
      </template>
    </v-data-table>
  </v-card>

  <DialogDelete
    v-model="dialogDelete"
    @confirm="deleteInvoiceConfirm"
    @close="closeDeleteInvoice"
    entity="invoice"
    :loading="loading"
  />
</template>
<script setup>
import { ref, computed, watch, onMounted } from "vue";
import { useInvoiceStore } from "../stores/invoice";
import { useSnackbarStore } from "../stores/snackbar";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";
import DialogDelete from "../components/base/DeleteDialog.vue";

import { useI18n } from "vue-i18n";

const { t } = useI18n();


const { xs, sm } = useDisplay();

const store = useInvoiceStore();


const { invoices, loading, response } = storeToRefs(store);

const search = ref("");

const headers = [
  {
    align: "start",
    key: "id",
    title: "ID",
  },
  { key: "payment_type", title: t('Payment Type') },
  { key: "amount", title: t('Amount') },
  { key: "currency", title: t('Currency') },
  { key: "invoice_file", title: t('Invoice File') },
  { key: "actions", title: t('Actions'), align: "end", sortable: false },
];

const dialogAddInvoice = ref(false);
const dialogDelete = ref(false);
const editedIndex = ref(-1);

const formTitle = computed(() => {
  return editedIndex.value === -1 ? t('Record New Invoice') : t('Edit Invoice');
});

const invoice = ref({
  id:"",
  amount: "",
  currency: "",
  purpose: "",
  notes: "",
  payment_type: "",
});

const defaultInvoice = {
  id:"",
  amount: "",
  currency: "",
  purpose: "",
  notes: "",
  payment_type: "",
};


const editInvoice = (item) => {
  dialogAddInvoice.value = true;
  editedIndex.value = invoices.value.indexOf(item);
  invoice.value.id = item.id;
  invoice.value.amount = item.amount;
  invoice.value.currency = item.currency;
  invoice.value.purpose = item.purpose;
  invoice.value.notes = item.notes;
  invoice.value.payment_type = item.payment_type;
};





const deleteInvoice = (id) => {
  invoice.value.id = id;
  dialogDelete.value = true;
};

async function initialize() {
  await store.fetchInvoices();
}

onMounted(async () => {
  initialize();
});

const save = async () => {
  if (editedIndex.value > -1) {
    await store.handleUpdatedInvoice(invoice.value, invoice.value.id);
    if (response.value.status === 200 || response.value.status === 204) {
      initialize();
      closeAddInvoice();
      snackbarShow("Data has been updated successfully", "success");
    } else {
      snackbarShow("Unable to update data. Please try again.", "error");
    }
  } else {
    await store.handleAddedInvoice(invoice.value);
    if (response.value.status === 200 || response.value.status === 201) {
      initialize();
      closeAddInvoice();
      snackbarShow("Data has been added successfully", "success");
    } else {
      snackbarShow("Unable to create data. Please try again.", "error");
    }
  }
  response.value = null;
};

const deleteInvoiceConfirm = async () => {
  await store.handleDeletedInvoice(invoice.value.id);
  if (response.value.status === 204) {
    initialize();
    closeDeleteInvoice();
    snackbarShow("Data has been removed successfully", "success");
  } else {
    snackbarShow("Unable to remove data. Please try again.", "error");
  }
};

const closeDeleteInvoice = () => {
  dialogDelete.value = false;
  invoice.value = Object.assign({}, defaultInvoice);
};

const closeAddInvoice = async () => {
  dialogAddInvoice.value = false;
  setTimeout(() => {
    invoice.value = Object.assign({}, defaultInvoice);
    editedIndex.value = -1;
  }, 250);
};

const snackbarShow = (message, type) => {
  useSnackbarStore().showSnackbar(message, type);
};

watch(dialogAddInvoice, (val) => {
  val || closeAddInvoice();
});


const isImage = (src) => /\.(jpg|jpeg|png|gif|bmp)$/i.test(src);
const isPdf = (src) => /\.pdf$/i.test(src);
const isDoc = (src) => /\.(doc|docx)$/i.test(src);
const isTxt = (src) => /\.txt$/i.test(src);

const previewTxt = async (src) => {
  try {
    const response = await fetch(src);
    const text = await response.text();
    const blob = new Blob([text], { type: 'text/plain' });
    textPreviewUrl.value = URL.createObjectURL(blob);
  } catch (error) {
    console.error('Error fetching text file:', error);
  }
};

// Update `textPreviewUrl` when needed
watch(() => invoices.value.map(inv => inv.invoice_file), (files) => {
  const txtFile = files.find(file => isTxt(file));
  if (txtFile) {
    previewTxt(txtFile);
  }
}, { immediate: true });



</script>

