<template>
  <div class="auth-wrapper" :class="{ register: mode === 'register' }">
    <div class="auth-container">

      <!-- LOGIN FORM -->
      <div class="form-container login">
        <LoginForm />
      </div>

      <!-- REGISTER FORM -->
      <div class="form-container register">
        <RegisterForm />
      </div>

      <!-- OVERLAY -->
      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h2>Welcome Back!</h2>
            <p>Silakan login dengan akun kamu</p>
            <v-btn variant="outlined" @click="mode = 'login'">
              Login
            </v-btn>
          </div>

          <div class="overlay-panel overlay-right">
            <h2>Hello, Friend!</h2>
            <p>Daftar untuk mulai menggunakan aplikasi</p>
            <v-btn variant="outlined" @click="mode = 'register'">
              Register
            </v-btn>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import LoginForm from './LoginForm.vue'
import RegisterForm from './RegisterForm.vue'

const mode = ref('login')
</script>

<style scoped>
/* WRAPPER */
.auth-wrapper {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #f6f7fb;
}

.auth-container {
  position: relative;
  width: 1000px;
  height: 550px;
  background: #fff;
  overflow: hidden;
  border-radius: 12px;
}

/* ================= FORM ================= */
.form-container {
  position: absolute;
  top: 0;
  height: 100%;
  width: 50%;
  padding: 40px;
  transition: transform 0.7s ease;
  z-index: 2;
}

/* LOGIN → KIRI */
.form-container.login {
  left: 0;
  transform: translateX(0);
}

/* REGISTER → KANAN (AWAL DISEMBUNYIKAN) */
.form-container.register {
  left: 0;
  transform: translateX(100%);
  padding: 16px 20px;
}

/* SAAT MODE REGISTER */
.auth-wrapper.register .form-container.login {
  transform: translateX(-100%);
}

.auth-wrapper.register .form-container.register {
  transform: translateX(100%);
}
/* ================= OVERLAY ================= */
.overlay-container {
  position: absolute;
  top: 0;
  left: 50%;
  width: 50%;
  height: 100%;
  overflow: hidden;
  z-index: 5;
  transition: transform 0.7s ease;
}

/* PANEL BIRU → 2x LEBAR */
.overlay {
  position: relative;
  left: -100%;
  width: 200%;
  height: 100%;
  display: flex;
  background: linear-gradient(135deg, #1e88e5, #42a5f5);
  color: #fff;
  transition: transform 0.7s ease;
}

/* SAAT REGISTER → GESER OVERLAY */
.auth-wrapper.register .overlay-container {
  transform: translateX(-100%);
}

.auth-wrapper.register .overlay {
  transform: translateX(50%);
}

/* PANEL */
.overlay-panel {
  width: 50%;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  padding: 40px;
}

.overlay-left {
  transform: translateX(0);
}

.overlay-right {
  transform: translateX(0);
}


/* SAAT MODE REGISTER */
.auth-wrapper.register .overlay-left {
  opacity: 1;
  pointer-events: auto;
}

.auth-wrapper.register .overlay-right {
  opacity: 0;
  pointer-events: none;
}

/* ANIMASI HALUS */
.overlay-left,
.overlay-right {
  transition: opacity 0.4s ease;
}

</style>
