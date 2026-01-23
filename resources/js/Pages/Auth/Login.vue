<template>
  <v-card class="elevation-4 pa-6" max-width="400" width="100%">
    <!-- LOGO -->
    <div class="d-flex align-center justify-center mb-6">
      <v-img
        src="/images/logo_dispora.png"
        max-width="60"
        class="mr-2"
      />
      <span class="text-body-1 font-weight-medium">
        Disbudporapar
      </span>
    </div>

    <!-- USERNAME -->
    <div class="mb-1 text-body-2 font-weight-medium">
      Username
    </div>
    <v-text-field
      density="compact"
      variant="outlined"
      placeholder="Masukkan username"
      hide-details
      v-model="form.login"
    />

    <!-- PASSWORD -->
    <div class="mt-4 mb-1 text-body-2 font-weight-medium">
      Password
    </div>
    <v-text-field
      density="compact"
      variant="outlined"
      type="password"
      placeholder="Masukkan password"
      hide-details
      v-model="form.password"
    />

    <!-- BUTTON -->
    <v-btn
      class="mt-6"
      color="blue"
      variant="tonal"
      block
      @click="login"
    >
      Login
    </v-btn>

    <!-- LINK REGISTER -->
    <div class="text-center mt-4 text-body-2">
      Don't have an account?
      <a href="#" @click.prevent="$emit('switch')">
        Register here
      </a>
    </div>
  </v-card>
</template>

<script setup>
import { reactive } from 'vue'
import axios from 'axios'

const form = reactive({
  login: '',
  password: '',
})

const login = async () => {
  try {
    const res = await axios.post('/login', form)
    window.location.href = res.data.redirect
  } catch {
    alert('Login gagal')
  }
}
</script>
