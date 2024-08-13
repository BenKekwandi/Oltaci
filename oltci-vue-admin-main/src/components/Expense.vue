<template>
  <v-card color="grey-lighten-5">
    <v-card-title class="d-flex justify-space-between align-center pa-5">
      <div>{{ $t('Expense') }}</div>
      <v-dialog max-width="500" v-model="dialogAddExpense">
        <template v-slot:activator="{ props }">
          <v-btn
            prepend-icon="fa-plus"
            color="orange-darken-4"
            variant="outlined"
            v-bind="props"
            >{{ $t('Expense') }}</v-btn
          >
        </template>

        <v-card :title="formTitle">
          <v-card-text class="mt-4">

            <v-text-field
              v-model="expense.amount"
              :label="$t('Amount')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <v-text-field
              v-model="expense.currency"
              :label="$t('Currency')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>

            <v-select v-model="expense.payment_type" :label="$t('Payment Type')" :items="['CASH', 'CARD']" variant="outlined"></v-select>

            <v-text-field
              v-model="expense.purpose"
              :label="$t('Purpose')"
              variant="outlined"
              density="comfortable"
            ></v-text-field>


            <v-text-field
              v-model="expense.notes"
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
              <v-btn text="Close" variant="text" @click="closeAddExpense"></v-btn>
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
      :items="expenses"
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
          @click="editExpense(item)"
        ></v-btn>
        <v-btn
          size="x-small"
          color="red-darken-4"
          variant="tonal"
          icon="mdi-trash-can"
          @click="deleteExpense(item.id)"
        ></v-btn>
      </template>
    </v-data-table>
  </v-card>

  <DialogDelete
    v-model="dialogDelete"
    @confirm="deleteExpenseConfirm"
    @close="closeDeleteExpense"
    entity="expense"
    :loading="loading"
  />
</template>

<script setup>
import { ref, computed, watch, onMounted } from "vue";
import { useExpenseStore } from "../stores/expense"; // Assuming you have an expense store
import { useSnackbarStore } from "../stores/snackbar";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";
import DialogDelete from "../components/base/DeleteDialog.vue";

import { useI18n } from "vue-i18n";

const { t } = useI18n();

const { xs, sm } = useDisplay();

const store = useExpenseStore(); // Use your expense store here

const { expenses, loading, response } = storeToRefs(store); // Adjust according to your expense store

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
  { key: "purpose", title: t('Purpose') },
  { key: "notes", title: t('Notes') },
  { key: "actions", title: t('Actions'), align: "end", sortable: false },
];

const dialogAddExpense = ref(false);
const dialogDelete = ref(false);
const editedIndex = ref(-1);

const formTitle = computed(() => {
  return editedIndex.value === -1 ? t('Record New Expense') : t('Edit Expense');
});

const expense = ref({
  id:"",
  amount: "",
  currency: "",
  purpose: "",
  notes: "",
  payment_type: "",
});

const defaultExpense = {
  id:"",
  amount: "",
  currency: "",
  purpose: "",
  notes: "",
  payment_type: "",
};

const editExpense = (item) => {
  dialogAddExpense.value = true;
  editedIndex.value = expenses.value.indexOf(item);
  expense.value.id = item.id;
  expense.value.amount = item.amount;
  expense.value.currency = item.currency;
  expense.value.purpose = item.purpose;
  expense.value.notes = item.notes;
  expense.value.payment_type = item.payment_type;
};

const deleteExpense = (id) => {
  expense.value.id = id;
  dialogDelete.value = true;
};

async function initialize() {
  await store.fetchExpenses(); // Adjust according to your expense store
}

onMounted(async () => {
  initialize();
});

const save = async () => {
  if (editedIndex.value > -1) {
    await store.handleUpdatedExpense(expense.value, expense.value.id); // Adjust according to your expense store
    if (response.value.status === 200 || response.value.status === 204) {
      initialize();
      closeAddExpense();
      snackbarShow("Data has been updated successfully", "success");
    } else {
      snackbarShow("Unable to update data. Please try again.", "error");
    }
  } else {
    await store.handleAddedExpense(expense.value); // Adjust according to your expense store
    if (response.value.status === 200 || response.value.status === 201) {
      initialize();
      closeAddExpense();
      snackbarShow("Data has been added successfully", "success");
    } else {
      snackbarShow("Unable to create data. Please try again.", "error");
    }
  }
  response.value = null;
};

const deleteExpenseConfirm = async () => {
  await store.handleDeletedExpense(expense.value.id); // Adjust according to your expense store
  if (response.value.status === 204) {
    initialize();
    closeDeleteExpense();
    snackbarShow("Data has been removed successfully", "success");
  } else {
    snackbarShow("Unable to remove data. Please try again.", "error");
  }
};

const closeDeleteExpense = () => {
  dialogDelete.value = false;
  expense.value = Object.assign({}, defaultExpense);
};

const closeAddExpense = async () => {
  dialogAddExpense.value = false;
  setTimeout(() => {
    expense.value = Object.assign({}, defaultExpense);
    editedIndex.value = -1;
  }, 250);
};

const snackbarShow = (message, type) => {
  useSnackbarStore().showSnackbar(message, type);
};

watch(dialogAddExpense, (val) => {
  val || closeAddExpense();
});

</script>
