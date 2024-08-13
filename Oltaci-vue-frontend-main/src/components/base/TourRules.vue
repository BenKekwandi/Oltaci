<template>
  <div>
    <List
      :title="$t('Tour Rules')"
      :header="$t('Equipment')"
      :paragraph="$t('Fishing rods, bait and other fishing equipment are brought by guests.')"
      icon="mdi-hook"
      split
      :header2="$t('Legal permission')"
      :paragraph2="$t('It has an Amateur Fishing Tourism Permit for Commercial Purposes.')"
      icon2="mdi-license"
    />

    <List
      :header="$t('Food & Beverage')"
      :paragraph="$t('All your food and drinks can be brought by guests.')"
      icon="mdi-food-outline"
      split
      :header2="$t('Pastures')"
      :paragraph2="$t('The pastures previously registered with the captain are visited. If there are not enough fish, pastures can be changed')"
      icon2="mdi-island"

    />

    <List
      :header="$t('Fish You Catch')"
      :paragraph="$t('You can take all the fish you catch.')"
      icon="mdi-fish"
      split
      :header2="$t('Children')"
      :paragraph2="$t('Each child is charged as 1 person.')"
      icon2="mdi-account-child-outline"
      end
    />
  </div>
</template>

<script setup>
import List from "./ListCard.vue";
</script>
