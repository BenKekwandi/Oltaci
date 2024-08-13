<template>
  <v-menu :close-on-content-click="false" v-model="menu">
    <template v-slot:activator="{ props }">
      <v-text-field :color="color" :class="class" :label="label" v-model="dateString" readonly clearable :flat="flat"
        prepend-inner-icon="mdi-calendar" :variant="variant" v-bind="props" :density="density"
        :placeholder="placeholder" hide-details :rounded="rounded">
      </v-text-field>
    </template>
    <v-date-picker :color="color" hide-header @update:modelValue="(val) => formatDate(val)"></v-date-picker>
  </v-menu>
</template>

<script setup>
import { ref, watch } from "vue";
import format from "date-fns/format";

const props = defineProps({
  class: String,
  color: String,
  label: String,
  variant: String,
  density: String,
  flat: Boolean,
  placeholder: String,
  rounded: String
});

const dateString = defineModel({ type: String });

const menu = ref(false);

const formatDate = (val) => {
  dateString.value = format(val, "do MMM yyyy");
  menu.value = false;
};
</script>