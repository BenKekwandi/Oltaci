<template>
  <div>
    <List
      :title="$t('Tour Summary')"
      icon="mdi-account-tie-hat-outline"
      :header="$t('With a captain')"
      :paragraph="$t('A captain will accompany you.')"
    />
    <List
      icon="mdi-gas-station-off-outline"
      :header="$t('Fuel is included in the price')"
      :paragraph="$t('This rental includes the price of gas.')"
      end
    />
    
  </div>
</template>

<script setup>
import List from "./ListCard.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
</script>
