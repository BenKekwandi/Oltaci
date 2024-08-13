import { createApp } from 'vue'
import { createPinia } from 'pinia'

import "@mdi/font/css/materialdesignicons.css";
//Vue-router
import route from './router'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { fa } from 'vuetify/iconsets/fa'
import { aliases,mdi } from 'vuetify/iconsets/mdi'
import '@fortawesome/fontawesome-free/css/all.css'

// Components
import App from './App.vue'

//translation
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
const app = createApp(App)

app.use(pinia)
app.use(route)
app.use(vuetify)
app.use(i18n)
app.mount('#app')
