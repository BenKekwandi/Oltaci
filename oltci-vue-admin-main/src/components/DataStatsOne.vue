<template>
    <div>
      <!-- Daily Totals Section -->
      <div v-if="daily_totals">
        <v-row class="ml-5 mb-5">
          <h1>Daily</h1>
        </v-row>
        <v-row>
          <v-col v-for="(total, currency) in daily_totals" :key="currency" cols="12" md="3">
            <v-card class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
              <v-card-text class="pa-6">
                <v-row align="center">
                  <v-col cols="3">
                    <div class="rounded-full bg-meta-2 dark:bg-meta-4 fill-secondary">
                      <v-icon class="fill-primary dark--text">{{ getIcon(currency) }}</v-icon>
                    </div>
                  </v-col>
  
                  <v-col cols="9">
                    <div class="text-center text-3xl font-bold text-black dark--text">
                      <text style="font-size:20px;font-weight:bold">
                        {{ total }}
                        <v-icon>{{ getIcon(currency) }}</v-icon>
                      </text>
                    </div>
                    <div class="text-center text-title-md font-bold">{{ currency }}</div>
                  </v-col>
  
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </div>
  
      <!-- Weekly Totals Section -->
      <div v-if="weekly_totals">
        <v-row class="ml-5 mb-5 mt-8">
          <h1>Weekly</h1>
        </v-row>
        <v-row>
          <v-col v-for="(total, currency) in weekly_totals" :key="currency" cols="12" md="3">
            <v-card class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
              <v-card-text class="pa-6">
                <v-row align="center">
                  <v-col cols="3">
                    <div class="rounded-full bg-meta-2 dark:bg-meta-4 fill-secondary">
                      <v-icon class="fill-primary dark--text">{{ getIcon(currency) }}</v-icon>
                    </div>
                  </v-col>
  
                  <v-col cols="9">
                    <div class="text-center text-3xl font-bold text-black dark--text">
                      <text style="font-size:20px;font-weight:bold">
                        {{ total }}
                        <v-icon>{{ getIcon(currency) }}</v-icon>
                      </text>
                    </div>
                    <div class="text-center text-title-md font-bold">{{ currency }}</div>
                  </v-col>
  
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </div>
  
      <!-- Monthly Totals Section -->
      <div v-if="monthly_totals">
        <v-row class="ml-5 mb-5 mt-8">
          <h1>Monthly</h1>
        </v-row>
        <v-row>
          <v-col v-for="(total, currency) in monthly_totals" :key="currency" cols="12" md="3">
            <v-card class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
              <v-card-text class="pa-6">
                <v-row align="center">
                  <v-col cols="3">
                    <div class="rounded-full bg-meta-2 dark:bg-meta-4 fill-secondary">
                      <v-icon class="fill-primary dark--text">{{ getIcon(currency) }}</v-icon>
                    </div>
                  </v-col>
  
                  <v-col cols="9">
                    <div class="text-center text-3xl font-bold text-black dark--text">
                      <text style="font-size:20px;font-weight:bold">
                        {{ total }}
                        <v-icon>{{ getIcon(currency) }}</v-icon>
                      </text>
                    </div>
                    <div class="text-center text-title-md font-bold">{{ currency }}</div>
                  </v-col>
  
                </v-row>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </div>
    </div>
  </template>
  
  

  <script>
import { ref, onMounted } from 'vue';
import { useReportStore } from "../stores/report";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";
import { useI18n } from "vue-i18n";

export default {
  setup() {
    const { t } = useI18n();
    const { xs, sm } = useDisplay();
    const store = useReportStore();
    const { report } = storeToRefs(store);

    const daily_totals = ref({});
    const weekly_totals = ref({});
    const monthly_totals = ref({});

    async function fetchTotals() {
      await store.fetchReport();
      daily_totals.value = report.value.daily_totals;
      weekly_totals.value = report.value.weekly_totals;
      monthly_totals.value = report.value.monthly_totals;
    }

    onMounted(() => {
      fetchTotals();
    });

    function getIcon(currency) {
      switch (currency) {
        case 'TRY':
          return 'mdi-currency-try';
        case 'USD':
          return 'mdi-currency-usd';
        case 'GBP':
          return 'mdi-currency-gbp';
        case 'EUR':
          return 'mdi-currency-eur';
        default:
          return 'mdi-currency';
      }
    }

    return {
      daily_totals,
      weekly_totals,
      monthly_totals,
      getIcon,
    };
  }
};
</script>