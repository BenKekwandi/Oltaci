<template>
  <div>
    <!-- <h1 class="font-weight-bold text-grey">
        {{ tour.boat.description }} | {{ tour.boat.name }} | {{ tour.region.location }}
      </h1> -->

    <div class="d-flex font-weight-bold text-h4 text-medium-emphasis">
      {{ tour.boat.description }}
      <v-divider
        vertical
        class="mx-4 my-1 border-opacity-25"
        :thickness="3"
      ></v-divider>
      {{ tour.boat.name }}
      <v-divider
        vertical
        class="mx-4 my-1 border-opacity-25"
        :thickness="3"
      ></v-divider>
      {{ tour.region.location }}
    </div>

    <menu
      class="d-flex justify-start my-2 text-medium-emphasis font-weight-medium"
      style="list-style: none"
    >
      <li class="d-flex align-center mr-5">
        <v-icon size="x-small" color="primary" class="mr-2">mdi-star</v-icon>4.5
      </li>
      <li class="d-flex align-center mr-5">
        <v-icon size="x-small" color="primary" class="mr-2"
          >mdi-account-tie-hat</v-icon
        >With a captain
      </li>
      <li class="d-flex align-center mr-5">
        <v-icon size="x-small" color="primary" class="mr-2"
          >mdi-account-group</v-icon
        >{{ tour.type }} FISHING TOUR
      </li>
      <li class="d-flex align-center mr-5">
        <v-icon size="x-small" color="primary" class="mr-2">mdi-anchor</v-icon>
        {{ tour.region.location }}
      </li>
    </menu>
    <Images :tour="tour" />

    <h2 class="font-weight-bold mt-8">
      {{ tour.boat.name }}
    </h2>
    <menu
      class="d-flex justify-start items-center mt-4 font-weight-medium text-body-1"
      style="list-style: none"
    >
      <li class="d-flex align-center mr-1">
        <span class="mr-1">
          <v-icon size="x-small" color="primary">mdi-circle-small</v-icon
          >{{ tour.boat.capacity }}</span
        >people
      </li>
      <li class="d-flex align-center mr-1">
        <v-icon size="x-small" color="primary">mdi-circle-small</v-icon
        ><span class="mr-1">3</span>cabins
      </li>
      <li class="d-flex align-center mr-1">
        <v-icon size="x-small" color="primary">mdi-circle-small</v-icon
        ><span class="mr-1">6</span>berths
      </li>
      <li class="d-flex align-center mr-1">
        <v-icon size="x-small" color="primary">mdi-circle-small</v-icon
        ><span class="mr-1">3</span>bathrooms
      </li>
    </menu>
  </div>
</template>

<script setup>
import Images from "./ImagesCard.vue";
import { defineProps } from "vue";

const props = defineProps({
  tour: {
    type: Object,
    required: true,
  },
});
</script>
