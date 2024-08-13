<script setup>
import Navbar from "./components/layouts/Navbar.vue";
import Header from "./components/layouts/Header.vue";
import Snackbar from "./components/base/Snackbar.vue";
</script>

<template>
  <v-responsive>
    <v-app>
      <Header />
      <Navbar />
      <Snackbar />

      <router-view v-slot="{ Component }">
        <transition name="slide" mode="out-in">
          <component :is="Component" />
        </transition>
      </router-view>
    </v-app>
  </v-responsive>
</template>

<script>
export default {
  mounted() {
    this.initializeGoogleSignIn();
  },
  methods: {
    initializeGoogleSignIn() {
      // Load Google Sign-In API if not already loaded
      if (window.gapi && window.gapi.auth2) {
        this.checkAuth();
      } else {
        const script = document.createElement('script');
        script.src = 'https://apis.google.com/js/platform.js';
        script.onload = () => {
          window.gapi.load('auth2', () => {
            window.gapi.auth2.init({
              client_id: 'YOUR_CLIENT_ID.apps.googleusercontent.com',
            }).then(() => {
              this.checkAuth();
            });
          });
        };
        document.head.appendChild(script);
      }
    },
    checkAuth() {
      const auth2 = window.gapi.auth2.getAuthInstance();
      if (auth2.isSignedIn.get()) {
        // User is already signed in
        const user = auth2.currentUser.get();
        this.handleSignIn(user);
      } else {
        // No user signed in, prompt for sign-in
        auth2.signIn().then((user) => {
          this.handleSignIn(user);
        }).catch((error) => {
          console.error('Sign-in error:', error);
        });
      }
    },
    handleSignIn(user) {
      const profile = user.getBasicProfile();
      console.log('User signed in:', profile.getName());
      // Send user data or token to your backend here
      this.sendTokenToBackend(user.getAuthResponse().id_token);
    },
    sendTokenToBackend(idToken) {
      // Use the /auth/google/callback endpoint to process the token
      fetch('/auth/google/callback', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ id_token: idToken })
      })
      .then(response => response.json())
      .then(data => {
        // Handle response from backend
        console.log('Backend response:', data);
      })
      .catch(error => {
        console.error('Error sending token to backend:', error);
      });
    }
  }
}
</script>


<style>
@import url("https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;300;400;500;700;900&display=swap");



/* * {
  font-family: "Nunito", sans-serif;
} */

/* .v-application {
  font-family: "Nunito", sans-serif !important;
} */

.v-application {
  font-family: 'Roboto Slab', serif;
}


.slide-enter-active,
.slide-leave-active {
  transition: opacity 0.5s;
  transform: 0.5;
}

.slide-enter-from,
.slide-leave-to {
  opacity: 0;
  /* transform: translate(-30%); */
}

.page{
  background-color: #ceeef2;
}
</style>
