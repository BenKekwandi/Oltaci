<template>
  <v-row>
    <v-col cols="2" md="2">
      <v-row>
        <v-col cols="6" sm="12">
          <v-card class="pa-4 mb-4 custom-card">
            <v-icon large class="mb-1">mdi-email</v-icon>
            <h6 class="font-weight-bold text-h6">Email</h6>
            <p class="mb-2">Send us an email</p>
            <p class="font-weight-bold text-decoration-underline">
              hello@oltaci.com
            </p>
          </v-card>
        </v-col>

        <v-col cols="6" sm="12">
          <v-card class="pa-4 mb-4 custom-card">
            <v-icon large class="mb-1">mdi-phone</v-icon>
            <h6 class="font-weight-bold text-h6">Phone</h6>
            <p class="mb-2">Call us for assistance</p>
            <p class="font-weight-bold text-decoration-underline">
              +1 (555) 123-4567
            </p>
          </v-card>
        </v-col>

        <v-col cols="6" sm="12">
          <v-card class="pa-4 mb-4 custom-card">
            <v-icon large class="mb-1">mdi-pin</v-icon>
            <h6 class="font-weight-bold text-h6">Office</h6>
            <p class="mb-2">123 Main St, Sydney NSW 2000, Australia</p>
            <p class="font-weight-bold text-decoration-underline">
              Get Directions <span>&rarr;</span>
            </p>
          </v-card>
        </v-col>

        <v-col cols="6" sm="12">
          <v-card class="pa-4 mb-4 custom-card">
            <v-icon large class="mb-1">mdi-clock</v-icon>
            <h6 class="font-weight-bold text-h6">Hours</h6>
            <p class="mb-2">Mon-Fri: 9 AM - 6 PM</p>
            <p class="font-weight-bold text-decoration-underline">Visit Us</p>
          </v-card>
        </v-col>
      </v-row>
    </v-col>
    <!-- Second Column: Form with Background Image -->
    <v-col cols="12" md="10">
      <v-card class="pa-5 mb-5 custom-card">
        <v-card-title class="text-h4 text-primary">
          Send Us a Message
        </v-card-title>
        <v-card-subtitle class="text-h6">
          We are here to assist you. Fill out the form below and we'll get back
          to you as soon as possible.
        </v-card-subtitle>
        <v-card-text>
          <h6 class="text-h6">{{ $t("Name") }}</h6>
          <v-text-field
            class="mb-8"
            v-model="name"
            outlined
            variant="outlined"
          ></v-text-field>
          <h6 class="text-h6">{{ $t("Email") }}</h6>
          <v-text-field
            class="mb-8"
            v-model="email"
            outlined
            variant="outlined"
          ></v-text-field>

          <h6 class="mb-2 text-h6">{{ $t("Message") }}</h6>
          <v-textarea
            class=""
            v-model="message"
            outlined
            variant="outlined"
          ></v-textarea>
        </v-card-text>
        <v-card-actions>
          <v-btn
            color="primary"
            class="mt-4"
            variant="flat"
            rounded="lg"
            width="12%"
            @click="submitForm"
          >
            {{ $t("Submit") }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script setup>
import { ref, onMounted } from "vue";

const name = ref("");
const email = ref("");
const message = ref("");
const date = ref();

const backgroundImageUrl = ref("https://via.placeholder.com/600");

function submitForm() {
  // Implement form submission logic here, e.g., send data to server
  console.log("Name:", name.value);
  console.log("Email:", email.value);
  console.log("Message:", message.value);
}

onMounted(() => {
  const startDate = new Date();
  const endDate = new Date(new Date().setDate(startDate.getDate() + 7));
  date.value = [startDate, endDate];
});
</script>

<style scoped>
.custom-card {
  background-color: #fefcff;
}
</style>
