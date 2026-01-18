<template>
  <v-container class="fill-height" fluid>
    <v-row justify="center">
      <v-col cols="12" md="6">
        <v-card>
          <v-card-title>Register</v-card-title>

          <v-card-text>
            <v-text-field label="Nama Depan" v-model="form.first_name" />
            <v-text-field label="Nama Belakang" v-model="form.last_name" />
            <v-text-field label="Username" v-model="form.username" />
            <v-text-field label="Email" v-model="form.email" />
            <v-text-field label="Password" type="password" v-model="form.password" />
            <v-text-field label="Konfirmasi Password" type="password" v-model="form.password_confirmation" />

            <v-checkbox
                v-for="cat in categories"
                :key="cat.id"
                v-model="form.categories"
                :label="cat.name"
                :value="cat.id"
                />

          </v-card-text>

          <v-card-actions>
            <v-btn color="primary" block @click="register">
              Register
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue'
import axios from 'axios'

const categories = ref([])

const form = reactive({
  first_name: '',
  last_name: '',
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
  categories: [],
})

const fetchCategories = async () => {
  try {
    const res = await axios.get('/api/categories')
    categories.value = res.data
  } catch (e) {
    console.error('Gagal ambil kategori')
  }
}

onMounted(() => {
  fetchCategories()
})

const register = async () => {
  try {
    await axios.post('/api/register', form)
    window.location.href = '/login'
  } catch (err) {
    alert('Register gagal')
  }
}
</script>
