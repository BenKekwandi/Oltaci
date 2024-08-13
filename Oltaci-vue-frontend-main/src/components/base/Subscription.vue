<template>
    <v-row>
      <v-col cols="12" md="10">
        <v-card class="pa-5 mb-5 custom-card">
          <v-card-title class="text-h4 text-primary">
           {{$t('Subscribe to Our Newsletters' )}}
          </v-card-title>
          <v-card-title>
            {{ $t('Stay updated with our latest news and updates. Enter your email below to subscribe to our newsletter and never miss an update!') }}
          </v-card-title>
          <v-card-subtitle class="text-h6">
            {{ $t(
                `Fill out the form below to join our mailing list and receive exclusive content, offers, and more directly to your inbox.`
            )}}
          </v-card-subtitle>
          <v-card-text>
          <v-text-field
            v-model="name"
            :label="$t('Name')"
            variant="outlined"
            density="comfortable"
          ></v-text-field>
          <v-text-field
            v-model="lastName"
            :label="$t('Last Name')"
            variant="outlined"
            density="comfortable"
          ></v-text-field>
          <v-text-field
            v-model="email"
            :label="$t('Email')"
            variant="outlined"
            density="comfortable"
          ></v-text-field>
        </v-card-text>
          <v-card-actions>
            <v-btn
              color="#009ccc"
              class="mt-4"
              variant="flat"
              rounded="lg"
              width="12%"
              @click="submitForm"
            >
              {{ $t("Subscribe") }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </template>
  
  <script setup>
  import { ref, onMounted } from "vue";
  import { useSubscriberStore } from "./../../stores/subscriber";

  const name = ref("");
  const lastName = ref("");
  const email = ref("");

  const store = useSubscriberStore();

  const submitForm = async () => {
    try {
      const subscriber = {
        first_name: name.value,
        last_name: lastName.value,
        email: email.value
      };
  
      await store.handleAddSubscriber(subscriber);
      console.log("Subscriber added successfully!");

      name.value = "";
      lastName.value = "";
      email.value = "";
  
    } catch (error) {
      console.error("An error occurred:", error);
    }
  };
  
  onMounted(() => {
  });
  </script>
  
  <style scoped>
  .custom-card {
    background-color: #fefcff;
  }
  </style>
  