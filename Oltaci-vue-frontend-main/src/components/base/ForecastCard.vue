<template>
  <h1>Forecast</h1>
</template>

<script>
export default {
  name: "ForecastCard",
  data() {
    return {
      forecast: {
        dt: 1587272400,
        sunrise: 1587251185,
        sunset: 1587295221,
        temp: {
          day: 27.89,
          min: 18.58,
          max: 27.89,
          night: 18.58,
          eve: 23.25,
          morn: 27.89
        },
        feels_like: { day: 32.03, night: 19.55, eve: 25.27, morn: 32.03 },
        pressure: 1007,
        humidity: 68,
        weather: [
          { id: 501, main: "Rain", description: "moderate rain", icon: "10d" }
        ],
        speed: 0.37,
        deg: 75,
        clouds: 85,
        rain: 6.35
      }
    };
  },
  computed: {
    roundedMornTemperature: function () {
      return Math.round(this.forecast.temp.morn);
    },
    roundedDayTemperature: function () {
      return Math.round(this.forecast.temp.day);
    },
    roundedNightTemperature: function () {
      return Math.round(this.forecast.temp.night);
    },
    formattedDate: function () {
      var options = { weekday: "short", month: "short", day: "numeric" };
      var milliseconds = this.forecast.dt * 1000;
      var dt = new Date(milliseconds);
      return dt.toLocaleDateString("en-gb", options);
    },
    precipitation: function () {
      if (this.forecast.rain !== undefined) {
        return this.forecast.rain.toFixed(1);
      }
      return "-";
    },
    wind: function () {
      if (this.forecast.speed !== undefined) {
        return this.forecast.speed.toFixed(1);
      }
      return "-";
    }
  }
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css?family=Lora:400,700&Open+Sans&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Lora, Helvetica, Arial, sans-serif;
  color: #2c3e50;
}

.daily-forecast-card {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-template-rows: auto auto auto auto;
  grid-row-gap: 10px;
  grid-column-gap: 5px;
  align-items: end;
  min-width: 150px;
  background: white;
  overflow: hidden;
  border-radius: 5px;
  border: 1px solid lightgrey;
  width: 270px;
  margin: 20px auto;
  padding-top: 10px;
}

.forecast-date {
  grid-column: 1 / span 3;
  font-size: 1.5em;
  text-align: center;
  padding-bottom: 0.25em;
}

.condition-icon {
  grid-column: 1 / span 3;
  width: 100px;
  margin: 0 auto;
  padding: 0;
  border-radius: 10px;
}

.condition-summary {
  grid-column: 1 / span 3;
  font-size: 1.25em;
  text-align: center;
  font-weight: 600;
}

.morn-temp,
.night-temp {
  opacity: 0.5;
}

.morn-temp-span {
  margin-left: 0.5em;
}

.day-temp {
  font-size: 1.75em;
  margin-left: 0.25em;
  margin-bottom: 0.25em;
  text-align: center;
}

.degree {
  vertical-align: top;
  margin: 0;
}

.icon {
  height: 1.25em;
}

.morn-temp,
.night-temp,
.measurement {
  font-size: 1em;
  text-align: center;
}

.measurement {
  padding-bottom: 2em;
}
</style>
