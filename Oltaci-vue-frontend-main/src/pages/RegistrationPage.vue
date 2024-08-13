<template>
  <div>
    <v-main>
      <Hero heading="Join us, Become one of us" backgroundSource="little-boat-middle-sea.jpg" imageSize="800px" />
      <!--   
        <section class="d-flex align-center pa-16">
          <v-row class="text-center">
            <v-col>
              <p class="font-weight-bold text-h6 text-primary">Register</p>
              <h2 class="text-h3 py-4">
                <strong>Register Your Boat for Free</strong>
              </h2>
              
            </v-col>
          </v-row>
        </section> -->
      <v-container>
        <br />
        <br />
        <v-row class="my-6">
          <v-col class="text-center">
            <p class="font-weight-bold text-h6 text-primary">Register</p>
            <div class="text-h4 py-4 font-weight-bold">
              Register Your Boat for Free
            </div>
          </v-col>
        </v-row>

        <v-row>
          <v-col>
            <Register />
          </v-col>
        </v-row>
      </v-container>
    </v-main>

    <Footer />

  </div>

</template>

<script setup>
import Navbar from "./../components/layouts/Navbar.vue";
import Footer from "./../components/layouts/Footer.vue";
import Register from "../components/base/RegisterCard.vue";
import Hero from "../components/base/Hero.vue";
</script>