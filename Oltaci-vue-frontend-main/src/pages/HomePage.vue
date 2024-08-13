<template>
  <div class="page">
    <v-main class="ma-0 pa-0" >
      <div class="hero-with-filter">
        <Hero
          :heading="$t('Rent the perfect boat for your fishing adventure')"
          :description="
            $t(
              `Discover a wide selection of boats and fishing equipment for rent at Oltaci. Whether you're planning a relaxing day on the water or an exciting fishing trip, we have the perfect options to suit your needs.`
            )
          "
          :buttons="{
            signUp: {
              text: $t('Explore'),
              color: '#009ccc',
            },
            learnMore: {
              text: $t('Learn More'),
              color: 'white',
            },
          }"
          backgroundSource="little-boat-middle-sea.jpg"
          imageSize="800px"
        />
        <div class="filter-wrapper">
          <Filter :regionStore="regionStore" />
        </div>
      </div>

      <v-container fluid class="pt-16" style="max-width: 1600px">
        <section class="py-16">
          <v-row class="text-center">
            <v-col>
              <p class="font-weight-bold text-primary">
                {{ $t("Discover") }}
              </p>
              <h2 class="text-h3 py-4">
                <strong>{{ $t("Unmatched Variety of Boats") }}</strong>
              </h2>
              <p class="py-4">
                {{
                  $t(
                    "Choose from our wide selection of boats for every occasion"
                  )
                }}
              </p>
            </v-col>
          </v-row>
          <InfoCard />
        </section>

        <section class="py-16">
          <v-row class="text-center">
            <v-col>
              <p class="font-weight-bold text-primary">
                {{ $t("Weather Update") }}
              </p>
              <h2 class="text-h3 py-4">
                <strong>{{
                  $t("Stay Informed with Accurate Weather Forecasts")
                }}</strong>
              </h2>
              <p class="py-4">
                {{ $t("Get the latest weather updates before sailing.") }}
              </p>
            </v-col>
          </v-row>
          <!-- <WeatherCard :weather="weather" /> -->
          <WeatherCard />
        </section>

        <section class="py-16">
          <v-row class="text-center">
            <v-col>
              <h2 class="text-h3 py-4">
                <strong>{{ $t("Extensive Coverage in Turkey") }}</strong>
              </h2>
            </v-col>
          </v-row>
          <div class="d-flex pt-16">
            <v-row>
              <v-col
                v-for="(tour, index) in tours.slice(0, 6)"
                :key="index"
                cols="12"
                sm="6"
                md="4"
              >
                <BoatCard :tour="tour" :loading="loading" />
              </v-col>
            </v-row>
          </div>
        </section>

        <section class="pb-16">
          <!-- <v-row class="text-center">
            <v-col>
              <h2 class="text-h3 py-4">
                <strong>{{
                  $t(
                    "Discover Our Wide Selection of Boats and Fishing Equipment"
                  )
                }}</strong>
              </h2>
            </v-col>
          </v-row> -->
          <div>
            <!-- <v-row>
              <v-col
                v-for="region in regions"
                :key="region.id"
                cols="12"
                sm="6"
                md="4"
              >
                <RegionCard :region="region" />
              </v-col>
            </v-row> -->
            <v-row class="text-center">
              <v-col>
                <h2 class="text-h4 py-4">
                  <strong>{{
                    $t(
                      ""
                    )
                  }}</strong>
                </h2>
              </v-col>
            </v-row>
            <v-row>
              <Subscription/>
            </v-row>
          </div>
        </section>
      </v-container>
      <Hero
        :heading="$t('Rent a boat or equipment')"
        :description="
          $t(
            `Explore the beauty of Turkey's waters with our wide selection of boats and rental equipment`
          )
        "
        :buttons="{
          signUp: {
            text: $t('Book'),
            color: 'black',
          },
          learnMore: {
            text: $t('Learn More'),
            color: 'white',
            outlined: true,
          },
        }"
        backgroundSource="boat-min.jpg"
      />
    </v-main>
    <div></div>

    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Footer from "./../components/layouts/Footer.vue";
import InfoCard from "./../components/base/infoCard.vue";
import BoatCard from "./../components/base/BoatsCard.vue";
import RegionCard from "./../components/base/RegionCard.vue";
import Hero from "./../components/base/Hero.vue";
import Filter from "./../components/base/FilterCard.vue";
import WeatherCard from "../components/base/WeatherCard.vue";
import Subscription from "../components/base/Subscription.vue";
import { useTourStore } from "../stores/tours";
import { useWeatherStore } from "../stores/weather";
import { useRegionStore } from "../stores/regions";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";

const tourStore = useTourStore();
const weatherStore = useWeatherStore();
const regionStore = useRegionStore();

const { tours, loading } = storeToRefs(tourStore);
const { regions } = storeToRefs(regionStore);
const { weathers } = storeToRefs(weatherStore);
const { xs, sm } = useDisplay();
const selectedCategory = ref(null);

onMounted(async () => {
  await tourStore.fetchTours();
  await regionStore.fetchRegions();
  await weatherStore.fetchWeather();
});
</script>
<style scoped>
.hero-with-filter {
  position: relative;
}

.filter-wrapper {
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 1;
  width: 100%;
  /* Adjust as needed */
}

@media (max-width: 600px) {
  .filter-wrapper {
    top: 70%;
    /* Adjust for mobile view */
  }
}


</style>
