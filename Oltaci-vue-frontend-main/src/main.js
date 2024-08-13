import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import route from './router'
import '@fortawesome/fontawesome-free/css/all.css'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';
import "@mdi/font/css/materialdesignicons.css";
import './scss/main.scss'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { fa } from 'vuetify/iconsets/fa'
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import { VueReCaptcha } from 'vue-recaptcha-v3';


// Components
import App from './App.vue'

// Translation
import i18n from './i18n';

const vuetify = createVuetify({
  components,
  directives,
  icons: {
    defaultSet: 'mdi',
    aliases,
    sets: {
      fa,
      mdi,
    },
  },
})

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)
const app = createApp(App)

app.use(pinia)
app.use(route)
app.use(vuetify)
app.use(i18n)
app.use(VueReCaptcha, { siteKey: '6LduRxwqAAAAAHnRdMqqHlw1rcmexa_-nN-QHnfV' });
app.component('font-awesome-icon', FontAwesomeIcon);
app.mount('#app')
