<template>
  <v-container fluid class="px-16">
    <v-skeleton-loader type="card, actions" :loading="loading">
      <v-card class="pa-5">
        <v-row class="d-flex align-start justify-start">
          <v-col>
            <v-card-title>
              <v-row class="d-flex align-center justify-space-between">
                <div>
                  <v-avatar size="40">
                    <v-img :src="post.media" />
                  </v-avatar>
                  {{ post.user.name }} {{ post.user.lastname }}
                </div>
                <v-col class="text-caption text--secondary" cols="auto">
                  <div>
                    {{ post.created_at }}
                  </div>
                </v-col>
              </v-row>
            </v-card-title>
            <v-card-text>
              <v-divider class="my-1"></v-divider>
              <v-img :src="post.media" height="100%" width="100%"></v-img>
              <div class="mt-5">
                <v-col class="d-flex align-center" cols="auto">
                  <div class="text-h5 text-primary">
                    {{ post.title }}
                  </div>
                </v-col>
                <p class="mt-12 text-h6 font-weight-medium">
                  {{ post.body }}
                </p>
              </div>
            </v-card-text>
            <v-card-actions class="d-flex justify-end">
              <v-btn icon>
                <v-icon>mdi-thumb-up</v-icon>
              </v-btn>
              <span class="ml-2">Like</span>

              <v-btn icon class="ml-5">
                <v-icon>mdi-share-variant</v-icon>
              </v-btn>
              <span class="ml-2">Share</span>
            </v-card-actions>
          </v-col>
        </v-row>
      </v-card>
    </v-skeleton-loader>
  </v-container>
</template>

<script setup>
import { defineProps, watch } from "vue";

const props = defineProps({
  post: {
    type: Object,
    required: true,
  },
  loading: {
    type: Boolean,
    required: true,
  },
});

watch(
  () => props.loading,
  (newVal, oldVal) => {
    console.log(`Loading changed from ${oldVal} to ${newVal}`);
  }
);

import { useI18n } from "vue-i18n";

const { t } = useI18n();
</script>
