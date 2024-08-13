<template>
  <v-responsive class="border rounded">
    <v-app>
      <v-app-bar elevation="0" color="orange-darken-4" density="compact">
        <v-app-bar-nav-icon
          v-show="$vuetify.display.mobile"
          variant="text"
          @click.stop="drawer = !drawer"
        ></v-app-bar-nav-icon>
        <v-toolbar-title><a href="/" style="">Admin</a></v-toolbar-title>
        <v-spacer></v-spacer>
        <div>
          <v-btn @click="changeLanguage('en')">En</v-btn>
          <v-btn @click="changeLanguage('tr')">Tr</v-btn>
        </div>
        <v-btn @click="logout">{{ $t('Logout') }} </v-btn>
      </v-app-bar>

      <Sidebar v-model="drawer" />
      <v-main>
        <v-breadcrumbs :items="items">
          <template v-slot:title="{ item }">
            {{  $t(item.title) }}
          </template>
        </v-breadcrumbs>
        <v-container fluid>
          <router-view />
        </v-container>
      </v-main>
    </v-app>
  </v-responsive>
</template>

<script setup>
import { ref, computed } from "vue";
import Sidebar from "../components/layouts/Sidebar.vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../stores/auth";
import { useI18n } from "vue-i18n";

const { t, locale } = useI18n();

function changeLanguage(lang) {
  locale.value = lang;
}

const store = useAuthStore();
const route = useRouter();

const drawer = ref(true);

const items = computed(() => {
  return route.currentRoute.value.meta.breadcrumb;
});

const logout = async () => {
  await store.handleLogout();
  route.push({ name: "login" });
  localStorage.removeItem("token");
};
</script>