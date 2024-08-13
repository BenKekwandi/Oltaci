import { createI18n } from 'vue-i18n';
import tr from './locales/tr';
import en from './locales/en';
import fr from './locales/fr';
import de from './locales/de';
import ar from './locales/ar';


const messages = {
  en,
  fr,
  tr,
  de,
  ar
};

const i18n = createI18n({
  legacy: false,
  locale: 'tr',
  fallbackLocale: 'tr', 
  messages 
});

export default i18n;
