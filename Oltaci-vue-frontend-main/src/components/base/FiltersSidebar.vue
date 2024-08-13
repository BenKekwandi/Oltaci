<template>
  <!-- <h3>Boat Type</h3>
    <div v-for="(item, index) in boatType" :key="index">
      <v-checkbox :label="item.title" :value="item.value" v-model="checkedValues" @change="toggleChildren(item)"
        color="primary" hide-details></v-checkbox>
      <div v-for="(child, childIndex) in item.children" :key="childIndex" class="ml-4">
        <v-checkbox v-if="isAnyChildChecked(item)" :label="child.title" :value="child.value" v-model="checkedValues"
          color="primary" hide-details></v-checkbox>
      </div>
    </div> -->

  <div class="pa-2">
    <v-row>
      <v-col>
        <h4 class="pb-2">{{ t('Tour Type')}}</h4>
        <v-select
          v-model="filterForm.type"
          placeholder="Select"
          :items="tourTypes"
          variant="underlined"
          density="comfortable"
          color="primary"
          @update:modelValue="sendFilterData"
        ></v-select>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12">
        <h4 class="pb-2">{{ t('Price Range') }}</h4>
        <v-range-slider
          v-model="price_range"
          min="0"
          max="1000"
          step="50"
          class="align-center"
          hide-details
          strict
          color="primary"
          thumb-label
          @end="sendFilterData"
          :thumb-size="14"
          clearable
        ></v-range-slider>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <h4 class="pb-2">{{ t('Captains') }}</h4>
        <v-select
          v-model="filterForm.captain_id"
          placeholder="Select"
          :items="captainStore.captains"
          :item-title="item => `${item.full_name} (${item.average_rating})`"
          item-value="id"
          variant="underlined"
          density="comfortable"
          color="primary"
          @update:modelValue="sendFilterData"
          clearable
        >
    
      </v-select>
      </v-col>
    </v-row>
  </div>

  <!-- <v-row>
      <v-col cols="5" class="d-flex justify-center align-center">
        <v-text-field v-model="range[0]" density="compact" type="text" label="Min" variant="outlined" prefix="$"
          hide-details></v-text-field>
      </v-col>
      <v-col cols="1" class="d-flex justify-center align-center">
        <span class="text-h5 text-grey">-</span>
      </v-col>
      <v-col cols="5" class="d-flex justify-center">
        <v-text-field v-model="range[1]" density="compact" type="text" label="Max" variant="outlined" prefix="$"
          hide-details></v-text-field>
      </v-col>
    </v-row> -->

  <!-- <div class="d-flex justify-space-between align-end">
      <v-col class="pl-0 ml-0" cols="7">
        <h3>Boat capacity</h3>
      </v-col>
      <v-col class="pl-0 ml-0" cols="5">
        <v-text-field density="compact" type="text" v-model="capacity" variant="underlined" hide-details>
          <template v-slot:append>
            <v-btn size="x-small" density="comfortable" icon="mdi-plus" color="white" @click="increaseCapacity">
            </v-btn>
          </template>
<template v-slot:prepend>
            <v-btn size="x-small" density="comfortable" icon="mdi-minus" color="grey" @click="decreaseCapacity">
            </v-btn>
          </template>
</v-text-field>
</v-col>
</div> -->

  <!-- <h3 class="my-3">Boat Equipments</h3>
    <div v-for="(item, index) in boatEquipments" :key="index" :class="{
      'pl-4': index !== 0 && index !== boatEquipments.length - 1,
    }">
      <v-checkbox :label="item.title" :value="item.value" color="primary" hide-details>
      </v-checkbox>
    </div> -->
  <!-- <v-divider class="my-3"></v-divider>
    <h3>Boat Length</h3>
    <v-slider v-model="length" thumb-label color="primary" append-icon="mdi-plus" prepend-icon="mdi-minus"
      @click:append="lengthIn" @click:prepend="lengthOut"></v-slider>

    <v-divider class="my-3"></v-divider>
    <h3>Boat Engine Power</h3>
    <v-slider v-model="engine" thumb-label color="primary" append-icon="mdi-plus" prepend-icon="mdi-minus"
      @click:append="engineIn" @click:prepend="engineOut"></v-slider>
    <v-divider class="my-3"></v-divider>
    <h3>Manufacture Year</h3>
    <v-range-slider v-model="value" min="0" max="1000" step="1" class="align-center" hide-details strict color="primary"
      thumb-label></v-range-slider>
    <h3 class="my-3">Manufacture Company</h3>
    <div v-for="(item, index) in manufactureCompany" :key="index" :class="{
      'pl-4': index !== 0 && index !== manufactureCompany.length - 1,
    }">
      <v-checkbox :label="item.title" :value="item.value" color="primary" hide-details>
      </v-checkbox>
    </div> -->
</template>

<script setup>
import { defineProps, onMounted, ref } from "vue";
import { useCaptainStore } from "../../stores/captains";

import { useI18n } from "vue-i18n";
 
 const { t } = useI18n();

const captainStore = useCaptainStore();

const props = defineProps({
  tours: {
    type: Object,
    required: true,
  },
});

const checkedValues = ref([]);
const price_range = ref([0, 1000]);
const capacity = ref(0);
const value = ref([0, 1000]);
const length = ref(0);
const engine = ref(0);
const tourTypes = ref(["Individual", "Group", "Vip"]);

const emit = defineEmits(["update_filter"]);

const filterForm = ref({
  price_from: "",
  price_to: "",
  captain_id: null,
});

const manufactureCompany = [
  { title: "Beneteau", value: "beneteau" },
  { title: "Brunswick", value: "brunswick" },
  { title: "Bénéteau", value: "bénéteau" },
  { title: "Azimut-Benetti", value: "azimut-benetti" },
  { title: "Ferretti", value: "ferretti" },
];

const boatEquipments = [
  { title: "Beneteau", value: "beneteau" },
  { title: "Brunswick", value: "brunswick" },
  { title: "Bénéteau", value: "bénéteau" },
  { title: "Azimut-Benetti", value: "azimut-benetti" },
  { title: "Ferretti", value: "ferretti" },
];

const boatType = [
  {
    title: "Motor",
    value: "motor",
    children: [
      { title: "RIB", value: "rib" },
      { title: "Jet ski", value: "jet_ski" },
      { title: "Houseboats", value: "houseboats" },
      { title: "Boat without license", value: "boat_without_license" },
      { title: "Motor yacht", value: "motor_yacht" },
    ],
  },
  {
    title: "Sail",
    value: "sail",
    children: [
      { title: "Sailboat", value: "sailboat" },
      { title: "Catamaran", value: "catamaran" },
      { title: "Gulet", value: "gulet" },
      { title: "Sailing yacht", value: "sailing_yacht" },
    ],
  },
];

const toggleChildren = (parent) => {
  if (checkedValues.value.includes(parent.value)) {
    parent.children.forEach((child) => {
      if (!checkedValues.value.includes(child.value)) {
        checkedValues.value.push(child.value);
      }
    });
  } else {
    parent.children.forEach((child) => {
      const index = checkedValues.value.indexOf(child.value);
      if (index > -1) {
        checkedValues.value.splice(index, 1);
      }
    });
  }
};

const isAnyChildChecked = (parent) => {
  return parent.children.some((child) =>
    checkedValues.value.includes(child.value)
  );
};

const increaseCapacity = () => {
  capacity.value++;
};

const decreaseCapacity = () => {
  if (capacity.value > 0) {
    capacity.value--;
  }
};

const lengthOut = () => {
  length.value = Math.max(length.value - 10, 0);
};

const lengthIn = () => {
  length.value = Math.min(length.value + 10, 100);
};

const engineOut = () => {
  engine.value = Math.max(engine.value - 10, 0);
};

const engineIn = () => {
  engine.value = Math.min(engine.value + 10, 100);
};

onMounted(async () => {
  await captainStore.fetchCaptains();
});

const sendFilterData = () => {
  filterForm.value.price_from = price_range.value[0];
  filterForm.value.price_to = price_range.value[1];
  emit("update_filter", filterForm.value);
};
</script>

<style></style>
