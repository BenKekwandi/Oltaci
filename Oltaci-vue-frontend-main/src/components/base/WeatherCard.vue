<template>
  <div v-if="currentWeather">
    <!-- Weather Card -->
    <v-row class="d-flex justify-center align-center">
      <v-card class="mx-auto" min-width="30%">
        <!-- Card Header -->
        <v-card-item title="Bodrum, Muğla, Türkiye">
          <template v-slot:subtitle>
            {{ currentWeather.conditions || '' }}
          </template>
        </v-card-item>

        <!-- Card Body -->
        <v-card-text class="py-0">
          <v-row align="center" no-gutters>
            <v-col class="text-h2" cols="6">{{ currentWeather.temp }}&deg;C</v-col>
            <v-col class="text-right" cols="4">
              <v-icon :color="weatherIcon.color" :icon="weatherIcon.icon" size="88"></v-icon>
            </v-col>
          </v-row>
        </v-card-text>

        <!-- Details -->
        <div class="d-flex py-3 justify-space-between">
          <v-list-item density="compact" prepend-icon="mdi-thermometer">
            <v-list-item-subtitle>Feels like: {{ currentWeather.feelslike }}&deg;C</v-list-item-subtitle>
          </v-list-item>

          <v-list-item density="compact" prepend-icon="mdi-weather-pouring">
            <v-list-item-subtitle>Humidity: {{ currentWeather.humidity }}%</v-list-item-subtitle>
          </v-list-item>

          <v-list-item density="compact" prepend-icon="mdi-weather-windy">
            <v-list-item-subtitle>Wind Speed: {{ currentWeather.windspeed }}m/s</v-list-item-subtitle>
          </v-list-item>

          <v-list-item density="compact" prepend-icon="mdi-weather-windy">
            <v-list-item-subtitle>
              Wind Direction:
              <i :class="getWindDirectionIcon(currentWeather.winddir)"></i>
            </v-list-item-subtitle>
          </v-list-item>

          <v-list-item density="compact" prepend-icon="mdi-weather-rainy">
            <v-list-item-subtitle>Precipitation: {{ currentWeather?.precip || 0 }}%</v-list-item-subtitle>
          </v-list-item>
        </div>

        <v-divider/>

        <v-expand-transition>
          <div v-if="expand1">
            <v-list dense class="px-16">
              <template v-for="(hour, index) in hourlyForecast.slice(0, 24).filter((item, idx) => idx % 4 === 0)" :key="index">
                <v-list-item>
                  <template v-slot:default>
                    <v-list-item-content>
                      <v-list-item-title>{{ formatTime(hour.datetime) }}</v-list-item-title>
                      <v-list-item-subtitle>{{ hour.temp }}°C</v-list-item-subtitle>
                      <v-list-item-subtitle>Humidity : {{ hour.humidity }}%</v-list-item-subtitle>
                      <!-- <v-list-item-subtitle>Wind Speed : {{ hour.windspeed }}m/s</v-list-item-subtitle> -->
                      <v-list-item-subtitle>Wind Direction : <v-icon :class="getWindDirectionIcon(hour.winddir)"></v-icon>({{ hour.winddir }}°)</v-list-item-subtitle>
            
                    </v-list-item-content>
                  </template>
                </v-list-item>
              </template>
            </v-list>
          </div>
        </v-expand-transition>

        <v-divider/>


        <!-- Toggle Button -->
    
        <v-card-actions>
          <v-btn :text="!expand1 ? 'Full Report' : 'Hide Report'" @click="toggleExpand"></v-btn>
        </v-card-actions>
      </v-card>
    </v-row>
  </div>
  <div class="d-flex justify-center align-center py-16">
    <iframe width="1500" height="600" src="https://embed.windy.com/embed.html?type=map&location=coordinates&metricRain=default&metricTemp=°C&metricWind=m/s&zoom=6&overlay=wind&product=ecmwf&level=surface&lat=35.102&lon=28.191&detailLat=36.999&detailLon=27.466&detail=true" frameborder="0"></iframe>
  </div>
</template>

<script>
import { computed, ref } from 'vue';
import { useWeatherStore } from './../../stores/weather';

export default {
  name: 'WeatherCard',

  setup() {
    const weatherStore = useWeatherStore();
    weatherStore.fetchWeather();

    const currentWeather = computed(() => weatherStore.getCurrentWeather);
    const hourlyForecast = computed(() => weatherStore.getHourlyForecast);

    const expand1 = ref(false);

    const formatTime = (datetime) => {
      if (!datetime) return '';
      const t = datetime.split(':');
      const tp = t[0]+':'+t[1];
      return tp;
    };

    const toggleExpand = () => {
      expand1.value = !expand1.value;
    };

    const weatherIcon = computed(() => {
      const weather = currentWeather.value?.conditions || '';
      return {
        icon: 'mdi-weather-sunny',
        color: 'yellow',
      };
    });

    const getWindDirectionIcon = (degrees) => {
      // Determine the icon based on wind direction
      if (degrees >= 315 || degrees < 45) {
        return 'fas fa-arrow-up'; // North
      } else if (degrees >= 45 && degrees < 135) {
        return 'fas fa-arrow-right'; // East
      } else if (degrees >= 135 && degrees < 225) {
        return 'fas fa-arrow-down'; 
      } else if (degrees >= 225 && degrees < 315) {
        return 'fas fa-arrow-left'; 
      } else {
        return 'fas fa-question'; 
      }
    };


    const formatWindDirection = (degrees) => {
      // Convert degrees to compass direction
      if (degrees >= 0 && degrees < 45) {
        return 'N';
      } else if (degrees >= 45 && degrees < 135) {
        return 'E';
      } else if (degrees >= 135 && degrees < 225) {
        return 'S';
      } else if (degrees >= 225 && degrees < 315) {
        return 'W';
      } else {
        return 'N'; // fallback or handle other cases
      }
    };


    return {
      currentWeather,
      hourlyForecast,
      expand1,
      formatTime,
      weatherIcon,
      toggleExpand,
      getWindDirectionIcon,
      formatWindDirection
    };
  },
};
</script>

<style scoped>
/* Scoped styles for table striping */
.table-striped {
  background-color: #ffffff; /* Adjust as per your design */
}

.table-striped tbody tr:nth-child(odd) {
  background-color: #f0f0f0; /* Alternate row color, adjust as needed */
}
</style>
