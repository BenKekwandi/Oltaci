<template>
  <v-sheet class="text-body-2 mx-auto">
    <span class="font-weight-bold text-h5">Additional Services</span>
    <v-row dense class="ml-1">
      <v-col
        v-for="(service, index) in displayedServices"
        :key="index"
        cols="12"
        md="6"
      >
        <v-checkbox
          v-model="selectedServices"
          :value="service.id"
          :label="service.name"
          hide-details
          class="mt-2 text-body-1"
        ></v-checkbox>
      </v-col>
    </v-row>
    <v-row class="mt-4">
      <v-col cols="12">
        <v-btn @click="openDialog()" color="primary"
          >Show All Services</v-btn
        >
      </v-col>
    </v-row>

    <v-divider :thickness="3" class="border-opacity-25 my-6"></v-divider>

    <v-dialog v-model="dialogVisible" max-width="600">
      <v-card>
        <v-card-title class="d-flex justify-end"
          ><v-btn
            variant="text"
            size="small"
            icon="mdi-window-close"
            @click="closeDialog()"
          ></v-btn
        ></v-card-title>
        <v-divider></v-divider>
        <v-card-text class="my-0 py-0">
          <div class="text-h6 my-6">All Additional Services</div>
          <v-divider></v-divider>
          <v-row class="mb-8" dense>
            <v-col
              cols="12"
              md="6"
              v-for="(service, index) in additionalServices"
              :key="index"
            >
              <v-checkbox
                v-model="selectedServices"
                :value="service.id"
                :label="service.name"
                hide-details
                class="mt-2 text-body-1"
              ></v-checkbox>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-sheet>
</template>
<script setup>
import { defineProps, computed, ref } from "vue";

const props = defineProps({
  additionalServices: {
    type: Object,
    required: true,
  },
});

const totalLength = ref(props.additionalServices.length);

const displayedServices = computed(() => {
  return props.additionalServices.slice(0, 6);
});

const dialogVisible = ref(false);
const selectedServices = ref([]);

function openDialog() {
  dialogVisible.value = true;
}

function closeDialog() {
  dialogVisible.value = false;
}
</script>
