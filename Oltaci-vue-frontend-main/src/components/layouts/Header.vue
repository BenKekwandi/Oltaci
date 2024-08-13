<template>

<v-app-bar class="px-3 border-b align-center" color="#07507a" :elevation="0" height="60" >
    <img src="./../../assets/whatsapp-icon.ico" class="pl-2 mr-2 circular-image" height="30">
    <h4 class="mr-16 ml-7">Canli Destek</h4>
    <div class="mr-16 pr-16">
        <v-menu min-width="200px" rounded>
          <template v-slot:activator="{ props }">
            <v-btn :prepend-icon="selectedLang.icon" v-bind="props">
              {{ selectedLang.name }}
            </v-btn>
          </template>
          <v-card>
            <v-card-text>
              <div class="mx-auto text-center">
                <v-btn
                  variant="text"
                  prepend-icon="fi fi-tr"
                  @click="changeLanguage('tr', 'fi fi-tr')"
                  >Tr</v-btn
                >
                <v-divider class="my-2"></v-divider>
                <v-btn
                  variant="text"
                  prepend-icon="fi fi-gb"
                  @click="changeLanguage('en', 'fi fi-gb')"
                  >En</v-btn
                >
                <v-divider class="my-2"></v-divider>
              
                <v-btn
                  variant="text"
                  prepend-icon="fi fi-fr"
                  @click="changeLanguage('fr', 'fi fi-fr')"
                  >FR</v-btn
                >
                <v-divider class="my-2"></v-divider>
                <v-btn
                  variant="text"
                  prepend-icon="fi fi-de"
                  @click="changeLanguage('de', 'fi fi-de')"
                  >DE</v-btn
                >
                <v-divider class="my-2"></v-divider>
                <v-btn
                  variant="text"
                  prepend-icon="fi fi-sa" 
                  @click="changeLanguage('ar', 'fi fi-sa')"
                >AR</v-btn>
              </div>
            </v-card-text>
          </v-card>
    </v-menu>
    </div>
    <!-- <v-spacer></v-spacer> -->
    <v-toolbar-items>
        <v-btn color="#00cfe6" :to="'/'">{{ $t("CAMPAIGNS") }}</v-btn>
        
        <v-btn color="#00cfe6" :to="'/service'">{{ $t("SEA WEATHER REPORT") }}</v-btn>
    </v-toolbar-items>
    <v-spacer></v-spacer>
    <v-spacer></v-spacer>
    <div class="icon-group my-8">
        <v-icon @click="navigateToInstagram">mdi-instagram</v-icon>
        <v-icon @click="navigateToFacebook">mdi-facebook</v-icon>
        <v-icon @click="navigateToYoutube">mdi-youtube</v-icon>
        <v-icon @click="navigateToGmail">mdi-gmail</v-icon>
    </div>
</v-app-bar>

</template>
<script setup>
import { ref, onMounted } from "vue";
import { useI18n } from "vue-i18n";

const { t, locale } = useI18n();
const drawer = ref(false);

function changeLanguage(lang, icon) {
  locale.value = lang;
  selectedLang.value.name = lang;
  selectedLang.value.icon = icon;
}

function navigateToInstagram(){
    window.open('https://www.instagram.com', '_blank', 'noopener,noreferrer');
}

function navigateToFacebook(){
    window.open('https://www.facebook.com', '_blank', 'noopener,noreferrer');
}


function navigateToYoutube(){
    window.open('https://www.youtube.com', '_blank', 'noopener,noreferrer');
}

function navigateToGmail(){
    window.open('https://www.gmail.com', '_blank', 'noopener,noreferrer');
}

const selectedLang = ref({
  name: "en",
  icon: "fi fi-gb",
});
</script>

<style scoped>
a {
  text-decoration: none;
}
</style>
