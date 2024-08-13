<template>
    <v-card color="grey-lighten-5">
      <v-card-title class="d-flex justify-space-between align-center pa-5">
        <div>{{ $t('Income') }}</div>
        <v-dialog max-width="500" v-model="dialogAddIncome">
          <template v-slot:activator="{ props }">
            <v-btn
              prepend-icon="fa-plus"
              color="orange-darken-4"
              variant="outlined"
              v-bind="props"
              >{{ $t('Income') }}</v-btn
            >
          </template>
  
          <v-card :title="formTitle">
            <v-card-text class="mt-4">

              <v-text-field
                v-model="income.amount"
                :label="$t('Amount')"
                variant="outlined"
                density="comfortable"
              ></v-text-field>

              <v-text-field
                v-model="income.currency"
                :label="$t('Currency')"
                variant="outlined"
                density="comfortable"
              ></v-text-field>

              <v-select v-model="income.payment_type" :label="$t('Payment Type')" :items="['CASH', 'CARD']" variant="outlined"></v-select>

              <v-text-field
                v-model="income.purpose"
                :label="$t('Purpose')"
                variant="outlined"
                density="comfortable"
              ></v-text-field>


              <v-text-field
                v-model="income.notes"
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
                <v-btn text="Close" variant="text" @click="closeAddIncome"></v-btn>
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
        :items="incomes"
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
            @click="editIncome(item)"
          ></v-btn>
          <v-btn
            size="x-small"
            color="red-darken-4"
            variant="tonal"
            icon="mdi-trash-can"
            @click="deleteIncome(item.id)"
          ></v-btn>
        </template>
      </v-data-table>
    </v-card>
  
    <DialogDelete
      v-model="dialogDelete"
      @confirm="deleteIncomeConfirm"
      @close="closeDeleteIncome"
      entity="income"
      :loading="loading"
    />
  </template>
  
  <script setup>
  import { ref, computed, watch, onMounted } from "vue";
  import { useIncomeStore } from "../stores/income";
  import { useSnackbarStore } from "../stores/snackbar";
  import { useDisplay } from "vuetify";
  import { storeToRefs } from "pinia";
  import DialogDelete from "../components/base/DeleteDialog.vue";
  
  import { useI18n } from "vue-i18n";
  
  const { t } = useI18n();
  
  
  const { xs, sm } = useDisplay();
  
  const store = useIncomeStore();

  
  const { incomes, loading, response } = storeToRefs(store);
  
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
  
  const dialogAddIncome = ref(false);
  const dialogDelete = ref(false);
  const editedIndex = ref(-1);
  
  const formTitle = computed(() => {
    return editedIndex.value === -1 ? t('Record New Income') : t('Edit Income');
  });
  
  const income = ref({
    id:"",
    amount: "",
    currency: "",
    purpose: "",
    notes: "",
    payment_type: "",
  });
  
  const defaultIncome = {
    id:"",
    amount: "",
    currency: "",
    purpose: "",
    notes: "",
    payment_type: "",
  };
  
  
  const editIncome = (item) => {
    dialogAddIncome.value = true;
    editedIndex.value =incomes.value.indexOf(item);
   income.value.id = item.id;
   income.value.amount = item.amount;
   income.value.currency = item.currency;
   income.value.purpose = item.purpose;
   income.value.notes = item.notes;
   income.value.payment_type = item.payment_type;
  };
  
  
  const deleteIncome = (id) => {
    income.value.id = id;
    dialogDelete.value = true;
  };
  
  async function initialize() {
    await store.fetchIncomes();
  }
  
  onMounted(async () => {

  });
  
  const save = async () => {
    if (editedIndex.value > -1) {
      await store.handleUpdatedIncome(income.value, income.value.id);
      if (response.value.status === 200 || response.value.status === 204) {
        initialize();
        closeAddIncome();
        snackbarShow("Data has been updated successfully", "success");
      } else {
        snackbarShow("Unable to update data. Please try again.", "error");
      }
    } else {
      await store.handleAddedIncome(income.value);
      if (response.value.status === 200 || response.value.status === 201) {
        initialize();
        closeAddIncome();
        snackbarShow("Data has been added successfully", "success");
      } else {
        snackbarShow("Unable to create data. Please try again.", "error");
      }
    }
    response.value = null;
  };
  
  const deleteIncomeConfirm = async () => {
    await store.handleDeletedIncome(income.value.id);
    if (response.value.status === 204) {
      initialize();
      closeDeleteIncome();
      snackbarShow("Data has been removed successfully", "success");
    } else {
      snackbarShow("Unable to remove data. Please try again.", "error");
    }
  };
  
  const closeDeleteIncome = () => {
    dialogDelete.value = false;
    income.value = Object.assign({}, defaultIncome);
  };
  
  const closeAddIncome = async () => {
    dialogAddIncome.value = false;
    setTimeout(() => {
      income.value = Object.assign({}, defaultIncome);
      editedIndex.value = -1;
    }, 250);
  };
  
  const snackbarShow = (message, type) => {
    useSnackbarStore().showSnackbar(message, type);
  };
  
  watch(dialogAddIncome, (val) => {
    val || closeAddIncome();
  });
  
  initialize();
  </script>
  