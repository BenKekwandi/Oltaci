<template>

  <v-navigation-drawer v-model="drawer" temporary>
    <v-list>
      <v-list-item :to="'/'">{{ $t("Home") }}</v-list-item>
      <v-list-item :to="'/service'">{{ $t("Services") }}</v-list-item>
      <v-list-item :to="'/boats'">{{ $t("Boats") }}</v-list-item>
      <v-list-item :to="'/contact-us'">{{ $t("Contact Us") }}</v-list-item>

      <v-list-group value="Users">
        <template v-slot:activator="{ props }">
          <v-list-item v-bind="props" :title="$t('Categories')"></v-list-item>
        </template>

        <v-list class="pl-6">
          <v-list-item @click="selectCategory('Individual')">{{
            $t("Individual Fishing Tour")
          }}</v-list-item>
          <v-list-item @click="selectCategory('Group')">{{
            $t("Group Fishing Tour")
          }}</v-list-item>
          <v-list-item @click="selectCategory('VIP')">{{
            $t("VIP Fishing Tour")
          }}</v-list-item>
        </v-list>
      </v-list-group>

    </v-list>
  </v-navigation-drawer>

</template>


<script setup>
import { useI18n } from "vue-i18n";
import { useTourStore } from "../../stores/tours";
import { storeToRefs } from "pinia";
import { useRouter } from "vue-router";

const store = useTourStore();
const { filterData } = storeToRefs(store);
const { t, locale } = useI18n();
const router = useRouter();

const drawer = defineModel({ type: Boolean })

function selectCategory(category) {
  filterData.value = { type: category };
  router.push({ name: "filters" });
}
</script>