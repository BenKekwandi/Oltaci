<template>
  <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
    <div>
        <!-- <v-row class="ml-5 mb-5">
          <h1>Daily</h1>
        </v-row> -->
        <v-row>
          <v-col cols="12" md="3">
            <v-card class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
              <v-card-text class="pa-6">
                <v-row align="center">
                  <v-col cols="3">
                    <div class="rounded-full bg-meta-2 blue:bg-meta-4 fill-secondary">
                      <v-icon class="fill-primary blue--text" style="color:#D21404">mdi-sail-boat</v-icon>
                    </div>
                  </v-col>
  
                  <v-col cols="9">
                    <div class="text-center text-3xl font-bold text-black dark--text">
                      <text style="font-size:18px;font-weight:bold;">
                        {{ generalReport.boats }} Boats
                        <v-icon class="fill-primary dark--text" style="color:#D21404">mdi-sail-boat</v-icon>
                      </text>
                    </div>
                  </v-col>
  
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="12" md="3">
            <v-card class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
              <v-card-text class="pa-6">
                <v-row align="center">
                  <v-col cols="3">
                    <div class="rounded-full bg-meta-2 dark:bg-meta-4 fill-secondary">
                      <v-icon class="fill-primary dark--text" style="color:#D21404">mdi-account</v-icon>
                    </div>
                  </v-col>
  
                  <v-col cols="9">
                    <div class="text-center text-3xl font-bold text-black dark--text">
                      <text style="font-size:18px;font-weight:bold;">
                        {{ generalReport.members }} Members
                        <v-icon style="color:#D21404">mdi-account-group</v-icon>
                      </text>
                    </div>
                  </v-col>
  
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="12" md="3">
            <v-card class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
              <v-card-text class="pa-6">
                <v-row align="center">
                  <v-col cols="3">
                    <div class="rounded-full bg-meta-2 dark:bg-meta-4 fill-secondary">
                      <v-icon class="fill-primary blue--text" style="color:#D21404">mdi-map-marker-path</v-icon>
                    </div>
                  </v-col>
  
                  <v-col cols="9">
                    <div class="text-center text-3xl font-bold text-black dark--text">
                      <text style="font-size:20px;font-weight:bold">
                        {{ generalReport.ongoing_trips }} On-going Trips
                        <v-icon style="color:#D21404">mdi-map-marker-path</v-icon>
                      </text>
                    </div>
                 
                  </v-col>
  
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="12" md="3">
            <v-card class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
              <v-card-text class="pa-6">
                <v-row align="center">
                  <v-col cols="3">
                    <div class="rounded-full bg-meta-2 dark:bg-meta-4 fill-secondary">
                      <v-icon class="fill-primary dark--text" style="color:#D21404">mdi-calendar-clock</v-icon>
                    </div>
                  </v-col>
  
                  <v-col cols="9">
                    <div class="text-center text-3xl font-bold text-black dark--text">
                      <text style="font-size:20px;font-weight:bold">
                        {{ generalReport.daily_reservations }} Daily Reservations
                        <v-icon style="color:#D21404">mdi-calendar-check</v-icon>
                      </text>
                    </div>
                  </v-col>
  
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </div>
      <div class="mt-15 pt-15">
        <div>
          <h4>On-going Tours</h4>
        </div>
        <v-data-table
        :headers="headers"
        :items="ongoingTrips"
        :search="search"
        class="bg-grey-lighten-5"
        :mobile="sm || xs"
        :loading="loading"
        :sort-by="[{ key: 'id', order: 'desc' }]"
        >
        <template v-slot:item.status="{ item }">
          <v-chip v-if="item.status === 'SCHEDULED'" color="yellow-darken-2">
            {{ $t('SCHEDULED') }}
          </v-chip>
          <v-chip v-else-if="item.status === 'COMPLETED'" color="blue-darken-2">
            {{ $t('COMPLETED') }}
          </v-chip>
          <v-chip v-else-if="item.status === 'ONGOING'" color="green-darken-2">
            {{ $t('ONGOING') }}
          </v-chip>
        </template>
        </v-data-table>
      </div>
  </div>
  
</template>
  
<script setup>
  import DataStatsOne from './DataStatsOne.vue'
  import { useTripStore } from "../stores/trips";
  import { useReportStore } from "../stores/report";
  import { ref, computed, watch, onMounted } from "vue";
  import { storeToRefs } from "pinia";

  import { useI18n } from "vue-i18n";

  const { t } = useI18n();

  const store = useTripStore();

  const reportStore = useReportStore();

  const { ongoingTrips, fetchOngoingTrips, loading, response } = storeToRefs(store);

  const { generalReport, fetchGeneralReport} = storeToRefs(reportStore)

  console.log('general Report', generalReport)

  const headers = [
  {
    align: "start",
    key: "id",
    title: "ID",
  },
  { key: "boat.name", title: t('Boat') },
  { key: "user", title: t('Member'), value: (item) => `${item.user.name} ${item.user.lastname}` },
  { key: "captain", title: t('Captain'), value: (item) => `${item.captain.first_name} ${item.captain.last_name}` },
  { key: "departure", title: t('Departure'), value: (item) => `${item.departure}, ${item.start}` },
  { key: "return", title: t('Return'), value: (item) => `${item.destination}, ${item.end}` },
  { key: "status", title: t('Status') },
];
onMounted(async () => {
  await store.fetchOngoingTrips();
  await reportStore.fetchGeneralReport();
});
</script>
