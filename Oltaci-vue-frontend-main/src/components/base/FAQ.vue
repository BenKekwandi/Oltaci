<template>
  <div>
 
      <span class="font-weight-bold text-h5">{{$t('Frequently Asked Questions')}}</span>

      <v-expansion-panels class="my-5">
        <v-expansion-panel v-for="(item, i) in items" :key="i">
          <v-expansion-panel-title
            collapse-icon="mdi-minus"
            expand-icon="mdi-plus"
            class="text-body-1 font-weight-medium"
          >
            {{ item.title }}
          </v-expansion-panel-title>
          <v-expansion-panel-text>{{ item.text }}</v-expansion-panel-text>
        </v-expansion-panel>
      </v-expansion-panels>
  
 
  </div>
</template>

<script setup>
import { ref } from "vue";

import { useI18n } from "vue-i18n";

const { t } = useI18n();


const items = ref([
  { title: t("How does the reservation process work?"), text: t("Text for item 1") },
  {
    title: t("How can I find out the availability of the boat?"),
    text: t("Text for item 2"),
  },
  { title: t("What are the payment options?"), text: t("Text for item 3") },
  { title: t("Can I cancel the tour I booked?"), text: t("Text for item 3") },
  {
    title: t("If there is not enough capacity for the tour I have individually booked, will the tour be cancelled?"),
    text: t("Text for item 3"),
  },
  { title: t("Is it safe to book a tour from Oltaci?"), text: t("Text for item 3") },
]);

</script>
