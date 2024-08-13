<template>
  <div class="page">
    <v-main>
      <v-container fluid>

        <v-row no-gutters>

          <!-- <v-col cols="4">
            <v-autocomplete v-model="filterData.location" :items="regionStore.collection" rounded="0 s-xl"
              item-title="location" item-value="location" variant="outlined" color="primary" :label="$t('Location')" clearable
              prepend-inner-icon="mdi-map-marker" @update:modelValue="updateFilters"></v-autocomplete>
          </v-col> -->

          <!-- <v-col cols="8">
            <DatePicker v-model="filterData.date" rounded="0" variant="outlined" color="primary" :label="$t('Date')"
              @update:modelValue="updateFilters" />
          </v-col> -->
          <v-col cols="6">
            <DatePicker v-model="filterData.date_from" rounded="0" variant="outlined" color="primary" label="From"
              @update:modelValue="updateFilters" />
          </v-col>

          <v-col cols="6">
            <DatePicker v-model="filterData.date_to" rounded="0 e-xl" variant="outlined" color="primary" label="To"
              @update:modelValue="updateFilters" />
          </v-col>

          
        </v-row>
        <!-- main -->

        <v-row class="mt-0">
          <v-col cols="12" md="2" class="">
            <FiltersSidebar :tours="tours" @update_filter="updateFilters" />
          </v-col>
          <v-col cols="12" md="10">
            <!-- <v-row>
              <v-slide-group class="" selected-class="bg-success" show-arrows>
                <v-slide-group-item v-for="n in 15" :key="n">
                  <v-sheet :elevation="2" :height="100" :min-width="171" rounded border
                    class="d-flex align-center justify-center flex-wrap text-center pa-2 ma-2">
                    <div>
                      <div>6-21 - 6-22</div>
                      <div class="font-weight-bold">70 boats</div>
                      <div class="font-weight-bold text-primary">$553</div>
                    </div>
                  </v-sheet>
                </v-slide-group-item>
              </v-slide-group>
            </v-row> -->
            <br />
            <br />
            <v-row>
              <v-col>
                <div class="font-weight-bold text-h6 mx-4">
                  <span class="text-primary">{{ itemCount }}</span> {{ t('Available Boats') }}
                </div>
              </v-col>
            </v-row>

            <v-row no-gutters>
              <v-col v-for="tour in tours" :key="tour.id" cols="12" sm="6" md="4">
                <BoatsCard :tour="tour" :loading="loading" />
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </div>
</template>

<script setup>
import BoatsCard from "../components/base/BoatsCard.vue";
import FiltersSidebar from "../components/base/FiltersSidebar.vue";
import { storeToRefs } from "pinia";
import { onMounted, ref, computed } from "vue";
import { useTourStore } from "../stores/tours";
import { useRegionStore } from "../stores/regions";
import DatePicker from "../components/base/DatePicker.vue";

import { useI18n } from "vue-i18n";
 
 const { t } = useI18n();


const tourStore = useTourStore();
const regionStore = useRegionStore()
const { tours, filterData, loading } = storeToRefs(tourStore)


// const filterForm = ref({
//   location: null,
//   date_from: "",
//   date_to: "",
//   type: null,
// })


onMounted(async () => {
  tourStore.handleFilteredTours(filterData.value)
  regionStore.fetchRegions()
})

const updateFilters = (val) => {
  if (val) {
    Object.keys(val).forEach((key) => {
      filterData.value[key] = val[key];
    });
  }
  tourStore.handleFilteredTours(filterData.value)
}


const itemCount = computed(() => tours.value.length);
</script>
