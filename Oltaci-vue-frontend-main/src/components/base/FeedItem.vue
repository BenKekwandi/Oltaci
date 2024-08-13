<template>
  <v-row>
    <v-col cols="12" md="12">
      <v-card class="mt-5">
        <!-- Card Header -->
        <v-row class="d-flex">
          <v-col cols="6">
            <div v-if="isImage(post.media)">
              <v-img
                :src="post.media"
                aspect-ratio="16/9"
                class="white--text"
              />
            </div>

            <div v-else-if="isVideo(post.media)">
              <video
                controls
                :src="post.media"
                aspect-ratio="16/9"
                class="post-video"
              ></video>
            </div>
          </v-col>
          <v-col cols="6">
            <v-card-title>
              <v-row class="d-flex align-center justify-space-between">
                <v-col class="d-flex align-center" cols="auto">
                  <div class="font-weight-medium">
                    {{ post.title }}
                  </div>
                </v-col>
                <v-col class="text-caption text--secondary" cols="auto">
                  <div v-if="post.created_at">
                    {{ post.created_at }}
                  </div>
                  <div v-else>Loading</div>
                </v-col>
              </v-row>
            </v-card-title>
            <v-divider></v-divider>
            <!-- Card Text -->
            <v-card-text class="mt-16">
              <p>{{ post.body }}</p>
            </v-card-text>

            <!-- Post Footer -->
            <v-card-actions class="bottom">
              <div class="mr-8">
                <v-avatar size="30">
                  <v-img :src="post.media" />
                </v-avatar>
                {{ post.user.name }} {{ post.user.lastname }}
              </div>
              <v-btn icon>
                <v-icon>mdi-thumb-up</v-icon>
              </v-btn>
              <span class="ml-2">Like</span>

              <v-btn icon class="ml-4">
                <v-icon>mdi-share-variant</v-icon>
              </v-btn>
              <span class="ml-2">Share</span>
              <div class="ml-4">
                <v-btn
                  class="text-caption text-primary text-decoration-underline"
                  :to="{ name: 'BlogDetail', params: { id: post.id } }"
                >
                  {{ t('Read More') }} <span>&rarr;</span>
                </v-btn>
              </div>
            </v-card-actions>
            <!-- <v-form px="8">
              <v-row>
                <v-col cols="12" md="12" px="8">
                  <v-text-field
                    density="comfortable"
                    menu-icon=""
                    variant="solo"
                    label="Comment" 
                  ></v-text-field>
                  </v-col>
              </v-row>
            </v-form>

            <div>
               <v-col v-for="comment in post.comments" :key="comment.id" cols="12" sm="6" md="4">
                @{{ comment.user.name }} {{ comment.user.lastname }} {{ comment.body }}
              </v-col>
            </div> -->
          </v-col>
        </v-row>
      </v-card>
    </v-col>
  </v-row>
</template>

<script setup>
import { ref, defineProps } from "vue";


import { useI18n } from "vue-i18n";

const { t } = useI18n();


const props = defineProps({
  post: {
    type: Object,
    required: true,
  },
  loading: { type: Boolean },
});

const isImage = (media) => {
  return media && media.match(/\.(jpeg|jpg|gif|png|webp)$/) != null;
};

const isVideo = (media) => {
  return media && media.match(/\.(mp4|ogg|webm|avi)$/) != null;
};
</script>

<style scoped>
.top {
  position: absolute;
  top: 3%;
}
.bottom {
  position: absolute;
  bottom: 3%;
}
</style>
