    <template>
        <v-card-text
  class="pa-3 d-flex flex-column"
  style="height: 100%;"
>

  <!-- FORM AREA (FLEKSIBEL) -->
  <div style="flex: 1;">

    <h3 class="text-center mb-4">Register</h3>

    <v-row dense class="mt-1">
      <!-- Nama Depan -->
      <v-col cols="6">
        <v-text-field
          label="Nama Depan"
          :rules="nameRules"
          v-model="form.first_name"
          :error-messages="errors.first_name"
          density="compact"
          variant="outlined"
          hide-details="auto"
        />
      </v-col>

      <!-- Nama Belakang -->
      <v-col cols="6">
        <v-text-field
          label="Nama Belakang"
          :rules="nameRules"
          v-model="form.last_name"
          :error-messages="errors.last_name"
          density="compact"
          variant="outlined"
          hide-details="auto"
        />
      </v-col>

      <!-- Username -->
      <v-col cols="12">
        <v-text-field
          label="Username"
          v-model="form.username"
          :error-messages="errors.username"
          density="compact"
          variant="outlined"
          hide-details="auto"
        />
      </v-col>

      <!-- Email -->
      <v-col cols="12">
        <v-text-field
          label="Email"
          v-model="form.email"
          :rules="emailRules"
          :error-messages="errors.email"
          density="compact"
          variant="outlined"
          hide-details="auto"
        />
      </v-col>

      <!-- Password -->
      <v-col cols="12">
        <v-text-field
          label="Password"
          type="password"
          v-model="form.password"
          :error-messages="errors.password"
          density="compact"
          variant="outlined"
          hide-details="auto"
        />
      </v-col>

      <!-- Konfirmasi Password -->
      <v-col cols="12">
        <v-text-field
          label="Konfirmasi Password"
          type="password"
          v-model="form.password_confirmation"
          :error-messages="errors.password_confirmation"
          density="compact"
          variant="outlined"
          hide-details="auto"
        />
      </v-col>
    </v-row>

    <!-- KATEGORI -->
<v-col cols="12">
  <div
    v-if="errors.categories.length"
    class="text-caption mb-1 text-center"
  >
    {{ errors.categories[0] }}
  </div>
  <div class="mb-2">
    <p class="text-center">Pilih kategori yang kamu minati</p>
  </div>

  <v-row dense justify="center">
    <v-col
      v-for="cat in categories"
      :key="cat.id"
      cols="4"
      class="d-flex"
    >
      <v-chip
        :variant="form.categories.includes(cat.id) ? 'flat' : 'outlined'"
        color="primary"
        class="w-100 justify-center"
        :ripple="false"
        @click="toggleCategory(cat.id)"
      >
        {{ cat.name }}
      </v-chip>
    </v-col>
  </v-row>
</v-col>



  </div>

  <div>
    <v-btn
      block
      color="primary"
      class="mt-3"
      @click="register"
      :loading="loading"
    >
      Register
    </v-btn>
  </div>

</v-card-text>

    </template>

    <script setup>
    import { reactive, ref, onMounted } from 'vue'
    import axios from 'axios'

    const categories = ref([])
    const loading = ref(false)

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
    const toggleCategory = (id) => {
        const index = form.categories.indexOf(id)
        if (index === -1) {
            form.categories.push(id)
        } else {
            form.categories.splice(index, 1)
        }
    }

    const errors = reactive({
        first_name:[],
        last_name:[],
        username:[],
        email:[],
        password:[],
        password_confirmation:[],
        categories:[],
    })

    const nameRules = [
    v => !!v || 'Wajib diisi',
    v => /^[A-Za-z\s]+$/.test(v) || 'Tidak boleh mengandung angka atau simbol',
    ]

    const emailRules = [
    v => !!v || 'Email wajib diisi',
    v => /.+@.+\..+/.test(v) || 'Format email tidak valid',
    ]


    const clearErrors=()=>{
        Object.keys(errors).forEach(key=>{
            errors[key]=[]
        })
    }

    onMounted(fetchCategories)

    const register = async () => {
    loading.value = true
    clearErrors()

    try {
        await axios.post('/api/register', form)
        window.location.href = '/login'
    } catch (err) {
        if (err.response?.status === 422) {
        const backendErrors = err.response.data.errors
        Object.keys(backendErrors).forEach(key => {
            if (errors[key] !== undefined) {
            errors[key] = backendErrors[key]
            }
        })
        } else {
        alert('Register gagal. Coba lagi.')
        }
    } finally {
        loading.value = false
    }
}

    </script>
