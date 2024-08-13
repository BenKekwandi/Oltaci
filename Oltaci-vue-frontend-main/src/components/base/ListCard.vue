<template>
  <v-sheet class="text-body-2">
    <span class="font-weight-bold text-h5">{{ title }}</span>

    <template v-if="split">
      <v-row :class="{ 'd-flex flex-row': split }" class="my-4">
        <v-col cols="1" class="d-flex justify-start">
          <v-icon class="text-h2" color="grey-darken-1">{{ icon }}</v-icon>
        </v-col>

        <v-col cols="5">
          <div class="font-weight-bold text-h6">{{ header }}</div>
          <p class="mt-2 text-body-1" v-html="paragraph"></p>
        </v-col>
        <v-col cols="1" class="d-flex justify-start">
          <v-icon class="text-h2" color="grey-darken-1">{{ icon2 }}</v-icon>
        </v-col>
        <v-col cols="5">
          <div class="font-weight-bold text-h6">{{ header2 }}</div>
          <p class="mt-2 text-body-1" v-html="paragraph2"></p>
        </v-col>
      </v-row>
    </template>

    <template v-else>
      <v-row class="mt-5">
        <v-col cols="1" class="d-flex justify-start">
          <v-icon class="text-h2" color="grey-darken-1">{{ icon }}</v-icon>
          <!-- <v-img :src="image" height="88" cover></v-img> -->
        </v-col>
        <v-col cols="11" class="text-start px-8">
          <div class="font-weight-bold text-h6">{{ header }}</div>
          <p class="mt-2 text-body-1" v-html="paragraph"></p>
        </v-col>
      </v-row>
    </template>

    <v-divider
      v-if="end"
      :thickness="3"
      class="border-opacity-25 my-6"
    ></v-divider>
  </v-sheet>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
  paragraph: {
    type: String,
    required: false,
  },
  header: {
    type: String,
    required: false,
  },
  header2: {
    type: String,
    required: false,
  },
  paragraph2: {
    type: String,
    required: false,
  },
  title: {
    type: String,
    required: false,
  },
  image: {
    type: String,
    required: false,
  },
  icon: {
    type: String,
    required: false,
  },
  icon2: {
    type: String,
    required: false,
  },
  end: {
    type: Boolean,
    required: false,
  },
  split: {
    type: Boolean,
    required: false,
    default: false,
  },
});
</script>
