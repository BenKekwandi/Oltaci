<template>
  <v-fade-transition>
    <v-card-text v-show="signUpExpand" class="pa-10">
      <v-alert v-show="alert.show" :type="alert.type" variant="outlined" class="mb-2">
        {{ alert.message }}
      </v-alert>
      <form>
        <div class="text-medium-emphasis">First Name</div>
        <v-text-field v-model="form.name" placeholder="Enter your first name" prepend-inner-icon="mdi-account-outline"
          variant="outlined" density="comfortable"
          :error-messages="v$.name.$errors.map(e => e.$message)"></v-text-field>

        <div class="text-medium-emphasis">Last Name</div>
        <v-text-field v-model="form.lastname" placeholder="Enter your first name"
          prepend-inner-icon="mdi-account-outline" variant="outlined" density="comfortable"
          :error-messages="v$.lastname.$errors.map(e => e.$message)"></v-text-field>

        <div class="text-medium-emphasis">Email</div>
        <v-text-field v-model="form.email" placeholder="Enter your email" prepend-inner-icon=" mdi-email-outline"
          variant="outlined" density="comfortable"
          :error-messages="v$.email.$errors.map(e => e.$message)"></v-text-field>

        <div class="text-medium-emphasis">Username</div>
        <v-text-field v-model="form.username" placeholder="Enter your username" prepend-inner-icon="mdi-account-outline"
          variant="outlined" density="comfortable"
          :error-messages="v$.username.$errors.map(e => e.$message)"></v-text-field>


        <div class="text-medium-emphasis d-flex align-center justify-space-between">
          Password
        </div>
        <v-text-field v-model="form.password" :type="visible ? 'text' : 'password'" placeholder="Enter your password"
          prepend-inner-icon="mdi-lock-outline" variant="outlined" @click:append-inner="visible = !visible"
          density="comfortable" :error-messages="v$.password.$errors.map(e => e.$message)"></v-text-field>

        <div class="text-medium-emphasis d-flex align-center justify-space-between">
          Confirm Password
        </div>
        <v-text-field v-model="form.repeated_password" :type="visible ? 'text' : 'password'"
          placeholder="Enter your password" prepend-inner-icon="mdi-lock-outline" variant="outlined"
          @click:append-inner="visible = !visible" density="comfortable"
          :error-messages="v$.repeated_password.$errors.map(e => e.$message)"></v-text-field>

        <v-btn @click="submit" class="my-4" color="blue" block> Sign Up </v-btn>
      
        <br />
        <div class="text-center">
          Already have an account?
          <a type="button" class="text-decoration-underline text-primary" @click="redirect">Sign In</a>
        </div>
      </form>

    </v-card-text>
  </v-fade-transition>
</template>

<script setup>
import { ref, computed } from "vue";
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, maxLength, email, sameAs, helpers } from '@vuelidate/validators'
import { useAuthStore } from "/src/stores/auth.js";
import { storeToRefs } from "pinia";

const signUpExpand = defineModel({ type: Boolean });

const emits = defineEmits(["showLogin"]);

const store = useAuthStore();

const { user, isLoggedIn, errors, response, alert, loading } = storeToRefs(store);

const visible = ref(false);

const form = ref({
  name: "",
  lastname: "",
  email: "",
  username: "",
  password: "",
  repeated_password: null,
})

const rules = computed(() => {
  return {
    name: {
      required: helpers.withMessage('This field cannot be empty', required),
    },
    lastname: {
      required: helpers.withMessage('This field cannot be empty', required),
    },
    email: {
      required: helpers.withMessage('This field cannot be empty', required),
      email: helpers.withMessage('Email must be a valid email address', email),
    },
    username: {
      required: helpers.withMessage('This field cannot be empty', required),
      minLength: helpers.withMessage('Username must be at least 5 characters long', minLength(5)),
      maxLength: helpers.withMessage('Username cannot be more than 20 characters long', maxLength(20))
    },
    password: {
      required: helpers.withMessage('This field cannot be empty', required),
      minLength: helpers.withMessage('Password must be at least 6 characters long', minLength(6))
    },
    repeated_password: {
      sameAsRef: helpers.withMessage('Passwords do not match', sameAs(form.value.password))
    }
  }

})

const v$ = useVuelidate(rules, form.value)

const redirect = () => {
  emits('showLogin')
  setTimeout(() => {
    Object.assign(alert.value, {
      show: false,
      type: null,
      message: ''
    })
  }, 250)
}

const submit = async () => {

  v$.value.$validate()
  if (v$.value.$error) {
    return
  }

  await store.handleRegistration(form.value)
  if (response.value.status === 201) {
    emits('showLogin')
    Object.assign(alert.value, {
      show: true,
      type: 'success',
      message: 'You have signed up successfully!'
    })
  }
  else {
    Object.assign(alert.value, {
      show: true,
      type: 'error',
      message: errors.value
    })
  }
};
</script>
