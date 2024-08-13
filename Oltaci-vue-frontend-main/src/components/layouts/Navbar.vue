<template>
  <div>
    <v-app-bar class="px-3 border-b align-center" color="#009ccc" :elevation="0" height="120" >

      <img src="./../../assets/logo4.png" class="pl-2 mr-10 circular-image" height="100" width="400">
      <template v-if="xs || sm" v-slot:prepend>
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      </template>
      <!-- <v-spacer v-if="user"></v-spacer>
      <v-spacer></v-spacer> -->
      <v-toolbar-items v-if="!(xs || sm)">
        <v-btn :to="'/'">{{ $t("About Us") }}</v-btn>
        <v-btn :to="'/boats'">{{ $t("Fishing Tours") }}</v-btn>
        <v-btn :to="'/reservation'">{{ $t("Reservation") }}</v-btn>
        <v-btn :to="'/help'">{{ $t("Help") }}</v-btn>
        <v-btn :to="'/contacts'">{{ $t("Contacts") }}</v-btn>
      </v-toolbar-items>

      <v-spacer></v-spacer>

      <v-toolbar-items>
        <div v-if="user" class="user-info d-flex align-center mr-10">
          <v-icon class="mx-2">mdi-account-outline</v-icon>
            <div>{{ user.name }} {{ user.lastname }}</div>
        </div>

        <v-btn
          v-if="isLoggedIn"
          prepend-icon=" mdi-logout"
          color="black"
          @click="logout"
          >{{ $t("Logout") }}</v-btn
        >
        <v-btn
          v-else
          prepend-icon="mdi-login"
          color="black"
          @click="showAuth"
          >{{ $t("Login") }}</v-btn
        >
      </v-toolbar-items>

      <AuthDialog v-model="dialogLogin" />
    </v-app-bar>

    <Sidebar v-model="drawer" v-if="xs || sm" />

    <v-overlay :model-value="loading" class="align-center justify-center">
      <v-progress-circular
        color="primary"
        size="64"
        indeterminate
      ></v-progress-circular>
    </v-overlay>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useI18n } from "vue-i18n";
import { useTourStore } from "../../stores/tours";
import { useAuthStore } from "../../stores/auth";
import { useRouter } from "vue-router";
import { storeToRefs } from "pinia";
import AuthDialog from "../auth/AuthDialog.vue";
import Sidebar from "../layouts/Sidebar.vue";

import { useDisplay } from "vuetify";

const store = useTourStore();
const authStore = useAuthStore();
const router = useRouter();

const { xs, sm } = useDisplay();
const { filterData } = storeToRefs(store);
const { user, isLoggedIn, loading, dialogLogin } = storeToRefs(authStore);

const { t, locale } = useI18n();
const drawer = ref(false);

function changeLanguage(lang, icon) {
  locale.value = lang;
  selectedLang.value.name = lang;
  selectedLang.value.icon = icon;
}

const selectedLang = ref({
  name: "en",
  icon: "fi fi-gb",
});

onMounted(async () => {
  await authStore.fetchUser();
});

function showAuth() {
  dialogLogin.value = true;
}

function selectCategory(category) {
  filterData.value = { type: category };
  if (router.currentRoute.value.name === "filters") {
    router.go({ name: "filters", query: { category } });
  } else {
    router.push({ name: "filters", query: { category } });
  }
}

const logout = async () => {
  await authStore.handleLogout();
};
</script>

<style scoped>


/* .circular-image {
  border-radius: 10%;
  object-fit: cover;
} */

</style>
