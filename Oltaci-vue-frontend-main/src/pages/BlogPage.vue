<template>
  <div class="page">
    <v-main class="ma-0 pa-0">
      <Hero
        :heading="$t('Look at what awaits you!!')"
        :description="
          $t(
            `Stay updated with the latest tips, tricks, and news about fishing and boating. Explore our expert articles, gear reviews, and travel guides to enhance your water adventures`
          )
        "
        :buttons="{
          signUp: {
            text: $t('Sign up'),
            color: 'black',
          },
          learnMore: {
            text: $t('Learn More'),
            color: 'white',
          },
        }"
        backgroundSource="motorboat.jpg"
        imageSize="600px"
      />
      <v-container fluid class="pt-16" style="max-width: 1600px">
        <section class="py-16">
          <v-row class="text-center">
            <v-col>
              <p class="font-weight-bold text-primary">
                {{ $t("Blog") }}
              </p>
              <h2 class="text-h3 py-4">
                <strong>{{ $t("Latest Posts and Articles") }}</strong>
              </h2>
              <p class="py-4">
                {{
                  $t(
                    "Stay updated with our latest blog posts, articles, and guides on fishing, boating, and water adventures."
                  )
                }}
              </p>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="9">
              <v-row class="d-flex align-center">
                <v-col cols="12" v-for="post in posts" :key="post.id">
                  <FeedItem :post="post" />
                </v-col>
              </v-row>
            </v-col>
            <v-col cols="3">
              <aside>
                <v-card class="mt-5 recent-blogs">
                  <v-card-title class="sticky-header">
                    <h3>{{ $t('Recent Blogs') }}</h3>
                  </v-card-title>
                  <v-divider></v-divider>
                  <v-list>
                    <v-list-item
                      v-for="post in posts"
                      :key="post.id"
                      @click="goToPost(post.id)"
                    >
                      <v-list-item-title>{{ post.title }}</v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-card>
              </aside>
            </v-col>
          </v-row>
        </section>
      </v-container>
    </v-main>
    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Footer from "./../components/layouts/Footer.vue";
import FeedItem from "./../components/base/FeedItem.vue";
import Hero from "./../components/base/Hero.vue";
import { useRouter } from "vue-router";

import { usePostStore } from "../stores/posts";
import { storeToRefs } from "pinia";
import { useI18n } from "vue-i18n";

const router = useRouter();
const { t } = useI18n();

const goToPost = (post) => {
  router.push({ name: "BlogDetail", params: { id: post } });
};

const store = usePostStore();
const { posts, loading, response } = storeToRefs(store);

onMounted(async () => {
  await store.fetchPosts();
});
</script>

<style scoped>
.recent-blogs {
  max-height: 382px;
  overflow-y: auto;
}

.sticky-header {
  position: sticky;
  top: 0;
  background-color: white;
  z-index: 1;
  padding: 10px;
}
</style>
