<template>
  <v-sheet class="text-body-2 mx-auto">

    <span class="font-weight-bold text-h5">{{ $t('Equipment available on boat') }}</span>
    <v-row class="mt-5 ml-1">
      <v-col v-for="(equipment, index) in displayedEquipments" :key="index" cols="12" md="6">
        <p class="mt-2 text-body-1">{{ equipment.equipment.name }}</p>
      </v-col>
    </v-row>
    <v-row class="mt-4">
      <v-col cols="12">
        <v-btn @click="openDialog()" color="primary">{{ $t('Show All Equipments') }} {{ totalLength }}</v-btn>
      </v-col>
    </v-row>

    <v-divider :thickness="3" class="border-opacity-25 my-6"></v-divider>

    <v-dialog v-model="dialogVisible" max-width="600">
      <v-card>
        <v-card-title class="d-flex justify-end"><v-btn variant="text" size="small" icon="mdi-window-close" @click="closeDialog()"></v-btn></v-card-title>
        <v-divider></v-divider>
        
        <v-card-text class="my-0 py-0">
          <div class="text-h6 my-6">{{ $t('All Equipments') }}</div>
          <v-divider></v-divider>
          <v-row class="mb-8" dense>
            <v-col cols="12" md="6" v-for="(equipment, index) in tour.boat.equipments" :key="index">
              <v-list-item class="mt-2 mx-0 px-0">
                <v-list-item-title>{{
                  equipment.equipment.name
                }}</v-list-item-title>
              </v-list-item>
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
  tour: {
    type: Object,
    required: true,
  },
});

const totalLength = ref(props.tour.boat.equipments.length);

const displayedEquipments = computed(() => {
  return props.tour.boat.equipments.slice(0, 4);
});

const dialogVisible = ref(false);

function openDialog() {
  dialogVisible.value = true;
}

function closeDialog() {
  dialogVisible.value = false;
}
</script>
