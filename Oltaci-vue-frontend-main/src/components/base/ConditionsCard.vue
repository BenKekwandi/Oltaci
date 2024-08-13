<template>
  <div>
    <List
      :title="$t('Payment & Cancellation Conditions')"
      icon="mdi-credit-card-outline"
      :header="$t('Payment')"
      :paragraph="$t(`The entire tour fee is paid through Oltaci.`)"
    />
    <List
      icon=" mdi-cash-sync"
      :header="$t('Cancellation policy')"
      :paragraph="$t(`Tours may be canceled due to the captain or weather conditions. In these cases, a <span class='text-primary'></List>100% </span>refund will be given.`)"
      end
    />
  </div>
</template>

<script setup>
import List from "./ListCard.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
</script>
