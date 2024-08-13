<template>
  <v-row dense>
    <template v-for="(image, imgIdx) in imageLayout" :key="imgIdx">
      <v-col :cols="image.cols">
        <v-img :src="tour.boat.picture" height="100%" cover></v-img>
      </v-col>
      <v-col v-if="image.children" class="d-flex flex-column" cols="6">
        <v-row dense>
          <v-col
            v-for="(child, childIdx) in image.children"
            :key="childIdx"
            :cols="child.cols"
            class="position-relative"
          >
            <v-img
              :src="tour.boat.pictures[childIdx].picture"
              height="280"
              cover
            ></v-img>
            <v-btn
              v-if="
                imgIdx === imageLayout.length - 1 &&
                childIdx === image.children.length - 1
              "
              class="button-bottom-right"
              color="black"
            >
              see more
            </v-btn>
          </v-col>
        </v-row>
      </v-col>
    </template>
  </v-row>
</template>

<script setup>
import { defineProps } from "vue";

const props = defineProps({
  tour: {
    type: Object,
    required: true,
  },
});

const imageLayout = [
  {
    cols: 6,
    children: [{ cols: 6 }, { cols: 6 }, { cols: 6 }, { cols: 6 }],
  },
];
</script>

<style>
.button-bottom-right {
  position: absolute;
  bottom: 24px;
  right: 24px;
}
</style>
