<template>
  <div>
    <List
      :title="$t('Oltaci Rules')"
      icon="mdi-hook"
      :header="$t('Equipment')"
      :paragraph="$t('Fishing rods, bait and other fishing equipment are brought by guests.')"
    />
    <List
      icon="mdi-food-outline"
      :header="$t('Food & Beverage')"
      :paragraph="$t('Complimentary hot beverage service is available on the tour. Other food and beverages can be brought by guests.')"
    />
    <List
      icon="mdi-file-document-check-outline"
      :header="$t('Individual Rental')"
      :paragraph="$t('You can make individual rentals on this tour. To rent this tour as a whole boat, you must purchase as much as the boat capacity.')"
    />
    <List
      icon="mdi-file-cancel-outline"
      :header="$t('Cancellation Policy')"
      :paragraph="$t('The tour may be canceled only due to the captain or weather conditions. A 100% refund will be given for canceled tours.')"
      end
    />
  </div>
</template>

<script setup>
import List from "./ListCard.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
</script>
