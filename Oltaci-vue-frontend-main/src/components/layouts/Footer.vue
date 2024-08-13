
<template>
  <v-footer
    color="#009ccc"
    class="d-flex justify-space-between pt-16"
    name="footer"
  >
    <v-container fluid>
      <v-row>
        <v-col cols="4">
          <img src="./../../assets/logo4.png" class="pl-2 mr-10 circular-image" height="100" width="400">
          <h3 class="py-1">
            Balık Oltamda, Keyif Yanımda!
          </h3>
          <div :style="{ color: '#07507a' }">
            <h4>Balık tutmayı sevenler için</h4>
            <h4>Bodrum’da eşsiz bir deneyim</h4>
            <h4>sunuyoruz.</h4>
          </div>
          <div class="icon-group my-8">
            <v-icon @click="navigateToInstagram">mdi-instagram</v-icon>
            <v-icon @click="navigateToFacebook">mdi-facebook</v-icon>
            <v-icon @click="navigateToYoutube">mdi-youtube</v-icon>
            <v-icon @click="sendmail">mdi-gmail</v-icon>
          </div>
          <div>
            <v-icon>mdi-map-marker</v-icon><p>Bodrum, Güvercinlik</p>
          </div>
          <p>
            <v-icon>mdi-phone</v-icon>+9056255550054<br />
          </p>
          <p @click="sendmail">
            <v-icon>mdi-gmail</v-icon>info@oltaci.com<br />
          </p>
        </v-col>

        <v-col cols="2">
          <ul>
            <li to="/">{{ $t("Home") }}</li>
            <li to="/service">{{ $t("Services") }}</li>
            <li to="/boats">{{ $t("Boats") }}</li>
            <li to="/contact-us">{{ $t("Contact Us") }}</li>
          </ul>
        </v-col>

        <v-col cols="2">
          <ul>
            <li to="/blog">{{ $t("Blog") }}</li>
            <li to="/terms-and-conditions">{{ $t("Terms of Use") }}</li>
            <li to="/privacy-polivy">{{ $t("Privacy Policy") }}</li>
          </ul>
        </v-col>
        <v-col cols="2">
          <a href="https://wa.me/+905338375179" target="_blank" rel="noopener noreferrer">
            <img src="./../../assets/whatsapp-icon.ico" class="pl-2 mr-2 circular-image" height="60">
          </a>
        </v-col>
      </v-row>

      <v-row class="mt-16">
        <v-divider class="font-weight-black" />

        <v-col cols="7">
          <p>© 2024 Oltaci. {{ $t("All rights reserved") }}</p>
        </v-col>
        <v-col cols="5" class="text-right">
          <a href="/privacy-policy">{{ $t("Privacy Policy") }}</a> |
          <a href="/terms-and-conditions">{{ $t("Terms and Conditions") }}</a> |
        </v-col>
      </v-row>
    </v-container>
  </v-footer>
</template>

<script setup>

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

function sendmail(){
  window.open('mailto:info@oltaci.com', '_blank', 'noopener,noreferrer');
}
</script>


<style scoped>

ul {
  list-style-type: none;
}
ul li {
  text-decoration: none;
  font-weight: 700;
  line-height: 2rem;
}
.icon-group {
  display: flex;
  gap: 12px;
}
</style>
