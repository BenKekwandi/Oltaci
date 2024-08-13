<template>
  <v-container>
    <v-skeleton-loader type="card, actions" :loading="loading">
      <v-card outlined class="product-card text-no-wrap" border>
        <v-img
          :src="tour.boat.picture"
          cover
          width="100%"
          :height="250"
        ></v-img>

        <v-card-item class="pa-5 h-100">
          <div class="d-flex justify-space-between align-center">
            <v-card-title
              class="overflow-x-hidden w-75 font-weight-bold"
              style="font-size: 15px"
            >
              {{ tour.description }} | {{ tour.boat.name }} <br />
              <!-- {{ tour.departure.location}} - {{ tour.destination.location }} -->
            </v-card-title>
            <!-- <div class="d-flex align-center">
              <v-rating
                v-model="rating"
                color="primary"
                length="1"
                hover
              ></v-rating>
              <span class="font-weight-bold text-grey">(5)</span>
            </div> -->
          </div>
        </v-card-item>

        <v-card-text class="px-5">
          <div style="height: 80px">
            <div class="text-grey text-subtitle-1 truncated-text">
              {{ tour.description }}
            </div>
          </div>
          <div class="d-flex justify-space-between align-center">
            <p class="mb-5 text-caption font-weight-bold text-primary">
              {{ tour.type }}
            </p>
            <p>
              <v-icon size="x-small" color="primary" class="mr-2"
                >mdi-account-tie-hat</v-icon
              >{{ tour.captain.first_name }} {{ tour.captain.last_name }} ({{ tour.captain.average_rating}})
            </p>
          </div>
          <div class="d-flex justify-space-between">
            <div class="info-item font-weight-bold">
              <strong>Price:</strong> {{ tour.price
              }}<span class="text-caption text-grey"> /TL</span>
            </div>
            <div class="info-item font-weight-bold">
              <strong>Time:</strong> {{ tour.duration
              }}<span class="text-caption text-grey">/Hours</span>
            </div>
          </div>
        </v-card-text>

        <div class="pa-5">
          <v-btn
            flat
            color="#009ccc"
            block
            :to="{ name: 'BoatDetail', params: { id: tour.id } }"
            >{{t("Book Now")}}</v-btn
          >
        </div>
      </v-card>
    </v-skeleton-loader>
  </v-container>
</template>

<script setup>
import { ref, defineProps } from "vue";
import { useI18n } from "vue-i18n";
const { t, locale } = useI18n();
const props = defineProps({
  tour: {
    type: Object,
    required: true,
  },
  loading: { type: Boolean },
});
const rating = ref(5);

</script>

<style scoped>
.product-card {
  width: 500px;
  min-height: 480px;
  margin: 0 auto;
}

.info-item {
  font-size: 0.9rem;
}

.truncated-text {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
