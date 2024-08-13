import { createI18n } from 'vue-i18n';
import tr from './locales/tr';
import en from './locales/en';
import fr from './locales/fr';

const messages = {
  en,
  fr,
  tr
};

const i18n = createI18n({
  locale: 'en',
  fallbackLocale: 'en', 
  messages 
});

export default i18n;
