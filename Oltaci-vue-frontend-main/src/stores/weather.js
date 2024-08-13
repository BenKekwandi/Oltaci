import { defineStore } from 'pinia';
import { getWeather } from '../http/weather-api';

export const useWeatherStore = defineStore('WeatherStore', {
  state: () => ({
    weatherData: null,
    loading: false,
    error: null,
  }),

  actions: {
    async fetchWeather() {
      this.loading = true;
      try {
        const { data } = await getWeather();
        this.weatherData = data;
        this.error = null;
      } catch (error) {
        console.error('Error fetching weather:', error);
        this.error = error.message || 'Failed to fetch weather data';
      } finally {
        this.loading = false;
      }
    },
  },

  getters: {
    getCurrentWeather() {
      return this.weatherData ? this.weatherData.currentConditions : null;
    },

    getHourlyForecast() {
      return this.weatherData ? this.weatherData.days[0].hours : [];
    },
  },
});
