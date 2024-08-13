<template>

  <v-card variant="elevated" class="pa-4">

    <v-card-text class="text-left">
      <p class="font-weight-regular text-h6">
        We know how excited everyone is to go on a boat tour. We set out
        with this excitement. As Oltaci, while bringing you captains and sea
        lovers together, we ensure that the sector grows, demand increases
        and your earnings increase.
      </p>

      <v-list class="my-10  text-primary">
        <v-list-item v-for="(item, i) in items" :key=i>
          <template v-slot:prepend>
            <v-icon :icon="item.icon"></v-icon>
          </template>

          <v-list-item-title class="text-h6  font-weight-bold" v-text="item.text"></v-list-item-title>
        </v-list-item>
      </v-list>

      <p class="font-weight-medium my-10 text-h5">
        To register with Oltaci for free, fill out the form below and we
        will call you.
      </p>


      <h6 class="text-subtitle-1 text-grey-darken-2 mb-2">Name & Surname</h6>
      <v-text-field class="mb-6" density="comfortable" v-model="fullName" variant="solo"></v-text-field>

      <h6 class="text-subtitle-1 text-grey-darken-2 mb-2">Phone Number</h6>
      <v-text-field class="mb-6" density="comfortable" v-model="phone" variant="solo"></v-text-field>

      <h6 class="text-subtitle-1 text-grey-darken-2 mb-2">
        City and Region where the Boat is Located
      </h6>
      <v-text-field class="mb-6" density="comfortable" v-model="city" variant="solo"></v-text-field>

      <h6 class="text-subtitle-1 text-grey-darken-2 mb-2">Enter the code below</h6>
      <v-text-field class="mb-6" density="comfortable" v-model="email" variant="solo"></v-text-field>
      <div class="d-flex justify-space-between">
        <v-btn color="primary" class="mt-4" @click="submitForm">Submit</v-btn>
        <v-btn color="black" class="mt-4" @click="submitForm">Submit</v-btn>
      </div>

    </v-card-text>


  </v-card>

</template>

<script setup>
import { ref } from "vue";

const name = ref("");
const email = ref("");
const message = ref("");

function submitForm() {
  console.log("Name:", name.value);
  console.log("Email:", email.value);
  console.log("Message:", message.value);
}
const items = [
  { text: "List Your Tour for Free", icon: "mdi-check" },
  { text: "Reach More Customers", icon: "mdi-check" },
  { text: "Save Time", icon: "mdi-check" },
  {
    text: "Your Profits Are in Your Pocket in Case of Cancellations",
    icon: "mdi-check",
  },
  {
    text: "You Are One Step Ahead with the Installment Advantage",
    icon: "mdi-check",
  },
];
</script>
