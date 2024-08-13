<template>
  <!-- <section :style="backgroundStyle" class="d-flex align-center pa-16 text-white video-background">
    <video v-if="isVideo" :src="backgroundSource" autoplay loop muted playsinline class="background-video"></video>
    <v-container fluid class="px-16 content-container">
      <h4 v-if="title" class="mb-2 ml-1 font-serif max-w-3xl mx-auto">
        {{ title }}
      </h4>
      <v-row>
        <v-col v-if="heading" class="font-weight-bold" :cols="split ? '5' : '12'" md="12">
          <div class="text-h3">{{ heading }}</div>
        </v-col>
        <v-col v-if="description" :class="split ? 'px-16' : ''" cols="7">
          <p class="text-h6" :class="split ? '' : 'my-5'">
            {{ description }}
          </p>
          <div v-if="buttons" class="mt-4 d-flex">
            <v-btn v-if="buttons.signUp" :color="buttons.signUp.color" class="mr-4">{{ buttons.signUp.text }}</v-btn>
            <v-btn v-if="buttons.learnMore" :outlined="buttons.learnMore.outlined" :color="buttons.learnMore.color">{{
              buttons.learnMore.text }}</v-btn>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </section> -->

  <v-row :style="backgroundStyle" class="d-flex align-center text-white outer">
    <v-col cols="1"></v-col>
    <v-col class="content-container inner" cols="10" sm="7">
      <div v-if="heading" class="font-weight-bold my-4">
        <div :class="$vuetify.display.xs ? 'text-h4' : 'text-h3'">
          {{ heading }}
        </div>
      </div>
      <br />
      <p
        class="text-h6"
        :class="$vuetify.display.xs ? 'text-subtitle-1' : 'text-h6'"
      >
        {{ description }}
      </p>
      <br />
      <div v-if="buttons" class="mt-4 d-flex">
        <v-btn
          v-if="buttons.signUp"
          :color="buttons.signUp.color"
          class="mr-4"
          >{{ buttons.signUp.text }}</v-btn
        >
        <v-btn
          v-if="buttons.learnMore"
          :outlined="buttons.learnMore.outlined"
          :color="buttons.learnMore.color"
          >{{ buttons.learnMore.text }}</v-btn
        >
      </div>
    </v-col>
    <v-col cols="1" sm="4"></v-col>
    
  </v-row>
</template>

<script setup>
import { computed, defineProps, onMounted } from "vue";
// import Filter from "./FilterCard.vue";

// import { storeToRefs } from "pinia";
// import { useRegionStore } from "../../stores/regions";
// const regionStore = useRegionStore();
// const { regions } = storeToRefs(regionStore);

// onMounted(async () => {
//   await regionStore.fetchRegions();
// });
const props = defineProps({
  title: {
    type: String,
    required: false,
  },
  heading: {
    type: String,
    required: false,
  },
  description: {
    type: String,
    required: false,
  },
  buttons: {
    type: Object,
  },
  split: {
    type: Boolean,
    required: false,
    default: false,
  },
  backgroundSource: {
    type: String,
    required: false,
    default: "https://via.placeholder.com/1600",
  },
  backgroundType: {
    type: String,
    required: false,
    default: "image", // 'image' or 'video'
  },
  imageSize: {
    type: String,
    required: false,
    default: "600px",
  },
});

const isVideo = computed(() => props.backgroundType === "video");
const backgroundStyle = computed(() => ({
  backgroundImage: isVideo.value ? "" : `url(${props.backgroundSource})`,
  backgroundSize: "cover",
  backgroundPosition: "center",
  minHeight: `${props.imageSize}`,
}));
</script>

<style scoped>
.video-background {
  position: relative;
  overflow: hidden;
  width: 100%;
  height: 100vh;
}

.background-video {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 100%;
  height: 100%;
  object-fit: cover;

  transform: translate(-50%, -50%);
}

.content-container {
  position: relative;
  z-index: 1;
}
</style>
