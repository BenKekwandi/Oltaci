<template>
  <v-card class="py-2 mx-auto my-6">
    <v-card-text>
      <v-row class="d-flex justify-center align-center">
        <!-- Place to Departure -->
        <v-col>
          <v-row>
            <!-- <v-col cols="12" md="3">
              <div class="ml-2 font-weight-bold text-sm">
                {{ t('Place to Departure')}}:
              </div>
              <v-autocomplete v-model="data.location" :items="regionStore.collection" item-title="location"
                item-value="location" placeholder="Type Here" flat variant="solo" density="compact"
                hide-details></v-autocomplete>
            </v-col> -->

            <!-- Date of Departure -->

            <v-col cols="12" md="3">
              <div class="ml-2 font-weight-bold text-sm">
                Date of Departure:
              </div>
              <DatePicker variant="solo" density="compact" :flat="true" placeholder="Select" v-model="data.date_from" />
            </v-col>

            <!-- Date of Return -->

            <v-col cols="12" md="3">
              <div class="ml-2 font-weight-bold text-sm">Date of Return:</div>
              <DatePicker variant="solo" density="compact" :flat="true" placeholder="Select" v-model="data.date_to" />
            </v-col>


            <!-- <v-col cols="12" md="3">
              <div class="ml-2 font-weight-bold text-sm">{{ t('Date') }} </div>
              <DatePicker variant="solo" density="compact" :flat="true" placeholder="Select" v-model="data.date" />
            </v-col> -->

            <!-- Tour Type -->
            <v-col cols="12" md="3">
              <div class="ml-2 font-weight-bold text-sm">{{ t('Tour Type') }} :</div>
              <v-select v-model="data.type" placeholder="Select" :items="tourTypes" variant="solo" density="compact"
                flat hide-details></v-select>
            </v-col>

            <!-- <v-col cols="12" md="3">
              <div class="ml-2 font-weight-bold text-sm">{{ t('Tour Type') }} :</div>
              <v-select v-model="data.type" placeholder="Select" :items="tourTypes" variant="solo" density="compact"
                flat hide-details></v-select>
            </v-col> -->
          </v-row>
        </v-col>
        <!-- Buttons -->
        <v-col cols="12" md="3" class="d-flex justify-center align-center">
          <v-btn @click="submit" color="#009ccc">{{ t('Search') }}</v-btn>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script setup>
import { ref, defineProps, watch } from "vue";
import DatePicker from "./DatePicker.vue";
import { useTourStore } from "../../stores/tours";
import { useRouter } from "vue-router";
import { storeToRefs } from "pinia";
import { useI18n } from "vue-i18n";
 
 const { t } = useI18n();

const props = defineProps({
  regionStore: Object,
});

const store = useTourStore();
const router = useRouter();

const { filterData } = storeToRefs(store);

const data = ref({
  location: null,
  date_from: "",
  date_to: "",
  date:"",
  type: null,
});

const tourTypes = ref(["Individual", "Group", "Vip"]);

const submit = () => {
  router.push({ name: "filters" });
  filterData.value = data.value;
};
</script>

<style scoped>
.v-card {
  max-width: 1200px;
  margin: auto;
}
</style>
