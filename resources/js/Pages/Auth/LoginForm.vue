<template>
  <v-card max-width="400" width="100%" elevation="4">
    <v-card-text>
      <h3 class="text-center mb-4">Login</h3>

      <v-text-field
        label="Username"
        v-model="form.login"
        density="compact"
        variant="outlined"
      />

      <v-text-field
        label="Password"
        type="password"
        v-model="form.password"
        density="compact"
        variant="outlined"
        class="mt-2"
      />

      <v-btn block color="primary" class="mt-4" @click="login">
        Login
      </v-btn>

    </v-card-text>
  </v-card>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
  login: '',
  password: '',
})

const login = () => {
  router.post('/login', form)
}
</script>
