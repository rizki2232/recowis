<template>
  <v-container class="fill-height" fluid>
    <v-row justify="center" align="center">
      <v-col cols="12" md="4">
        <v-card>
          <v-card-title>Login</v-card-title>

          <v-card-text>
            <v-text-field
              label="Username"
              v-model="form.login"
            />
            <v-text-field
              label="Password"
              type="password"
              v-model="form.password"
            />
          </v-card-text>

          <v-card-actions>
            <v-btn color="primary" block @click="login">
              Login
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
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
  } catch (err) {
    alert('Login gagal')
  }
}
</script>
