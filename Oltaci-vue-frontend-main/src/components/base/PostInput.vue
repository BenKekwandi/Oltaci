<template>
    <v-card class="mt-6">
     
      <!-- Card Footer -->
      <v-card-actions class="justify-center">
        <v-btn icon @click="$refs.filepickerRef.click()">
          <v-icon>mdi-camera</v-icon>
        </v-btn>
        <v-btn icon>
          <v-icon>mdi-emoticon-happy-outline</v-icon>
        </v-btn>
        <v-btn icon>
          <v-icon>mdi-video</v-icon>
        </v-btn>
  
        <!-- Image Preview -->
        <div
          v-if="imageToPost"
          class="
            flex flex-col
            filter
            hover:brightness-110
            transition
            duration-150
            transform
            hover:scale-105
            cursor-pointer
            ml-4
          "
          @click="removeImage"
        >
          <v-img :src="imageToPost" class="h-10 object-contain"></v-img>
          <span class="text-xs text-red-500 text-center">Remove</span>
        </div>
      </v-card-actions>
    </v-card>
  </template>
  
  <script setup>
  
  </script>
  
  <style scoped>
  /* You can add scoped styles here if needed */
  </style>
  