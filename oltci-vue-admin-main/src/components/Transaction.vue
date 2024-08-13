<template>
  <v-card color="grey-lighten-5">
    <v-card-title class="d-flex justify-space-between align-center pa-5">
      <div>{{ $t('Transaction') }}</div>
      <v-dialog max-width="500" v-model="dialogAddTransaction">
        <template v-slot:activator="{ props }">
          <v-btn
            prepend-icon="fa-plus"
            color="orange-darken-4"
            variant="outlined"
            v-bind="props"
            >{{ $t('Transaction') }}</v-btn
          >
        </template>

        <v-card :title="formTitle">
          <v-card-text class="mt-4">

            <v-select v-model="transaction.type" :label="$t('Transaction Type')" :items="['INCOME', 'EXPENSE']" variant="outlined"></v-select>


            <v-text-field
              v-model="transaction.amount"
              :label="$t('Amount')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <v-text-field
              v-model="transaction.currency"
              :label="$t('Currency')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <v-select v-model="transaction.payment_type" :label="$t('Payment Type')" :items="['CASH', 'CARD']" variant="outlined"></v-select>

            <v-text-field
              v-model="transaction.purpose"
              :label="$t('Purpose')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>


            <v-text-field
              v-model="transaction.notes"
              :label="$t('Notes')"
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
              <v-btn text="Close" variant="text" @click="closeAddTransaction"></v-btn>
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
      :items="transactions"
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
          @click="editTransaction(item)"
        ></v-btn>
        <v-btn
          size="x-small"
          color="red-darken-4"
          variant="tonal"
          icon="mdi-trash-can"
          @click="deleteTransaction(item.id)"
        ></v-btn>
      </template>
    </v-data-table>
  </v-card>

  <DialogDelete
    v-model="dialogDelete"
    @confirm="deleteTransactionConfirm"
    @close="closeDeleteTransaction"
    entity="transaction"
    :loading="loading"
  />
</template>

<script setup>
import { ref, computed, watch, onMounted } from "vue";
import { useTransactionStore } from "../stores/transaction"; // Assuming you have a transaction store
import { useSnackbarStore } from "../stores/snackbar";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";
import DialogDelete from "../components/base/DeleteDialog.vue";

import { useI18n } from "vue-i18n";

const { t } = useI18n();

const { xs, sm } = useDisplay();

const store = useTransactionStore(); // Use your transaction store here

const { transactions, loading, response } = storeToRefs(store); // Adjust according to your transaction store

const search = ref("");

const headers = [
  {
    align: "start",
    key: "id",
    title: "ID",
  },
  { key: "created_at", title: t('Transaction Date') },
  { key: "type", title: t('Transaction Type') },
  { key: "payment_type", title: t('Payment Type') },
  { key: "amount", title: t('Amount') },
  { key: "currency", title: t('Currency') },
  { key: "purpose", title: t('Purpose') },
  { key: "notes", title: t('Notes') },
  { key: "actions", title: t('Actions'), align: "end", sortable: false },
];

const dialogAddTransaction = ref(false);
const dialogDelete = ref(false);
const editedIndex = ref(-1);

const formTitle = computed(() => {
  return editedIndex.value === -1 ? t('Record New Transaction') : t('Edit Transaction');
});

const transaction = ref({
  id:"",
  amount: "",
  currency: "",
  purpose: "",
  notes: "",
  payment_type: "",
});

const defaultTransaction = {
  id:"",
  amount: "",
  currency: "",
  purpose: "",
  notes: "",
  payment_type: "",
};

const editTransaction = (item) => {
  dialogAddTransaction.value = true;
  editedIndex.value = transactions.value.indexOf(item);
  transaction.value.id = item.id;
  transaction.value.amount = item.amount;
  transaction.value.currency = item.currency;
  transaction.value.purpose = item.purpose;
  transaction.value.notes = item.notes;
  transaction.value.payment_type = item.payment_type;
};

const deleteTransaction = (id) => {
  transaction.value.id = id;
  dialogDelete.value = true;
};

async function initialize() {
  await store.fetchTransactions(); // Adjust according to your transaction store
}

onMounted(async () => {
  initialize();
});

const save = async () => {
  if (editedIndex.value > -1) {
    await store.handleUpdatedTransaction(transaction.value, transaction.value.id); // Adjust according to your transaction store
    if (response.value.status === 200 || response.value.status === 204) {
      initialize();
      closeAddTransaction();
      snackbarShow("Data has been updated successfully", "success");
    } else {
      snackbarShow("Unable to update data. Please try again.", "error");
    }
  } else {
    await store.handleAddedTransaction(transaction.value); // Adjust according to your transaction store
    if (response.value.status === 200 || response.value.status === 201) {
      initialize();
      closeAddTransaction();
      snackbarShow("Data has been added successfully", "success");
    } else {
      snackbarShow("Unable to create data. Please try again.", "error");
    }
  }
  response.value = null;
};

const deleteTransactionConfirm = async () => {
  await store.handleDeletedTransaction(transaction.value.id); // Adjust according to your transaction store
  if (response.value.status === 204) {
    initialize();
    closeDeleteTransaction();
    snackbarShow("Data has been removed successfully", "success");
  } else {
    snackbarShow("Unable to remove data. Please try again.", "error");
  }
};

const closeDeleteTransaction = () => {
  dialogDelete.value = false;
  transaction.value = Object.assign({}, defaultTransaction);
};

const closeAddTransaction = async () => {
  dialogAddTransaction.value = false;
  setTimeout(() => {
    transaction.value = Object.assign({}, defaultTransaction);
    editedIndex.value = -1;
  }, 250);
};

const snackbarShow = (message, type) => {
  useSnackbarStore().showSnackbar(message, type);
};

watch(dialogAddTransaction, (val) => {
  val || closeAddTransaction();
});

</script>
