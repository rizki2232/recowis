<template>
  <v-app class="d-flex flex-column" style="min-height: 100vh;">
    <NavbarUser />

    <v-main class="flex-grow-1">
      <slot />
    </v-main>

    <FooterUser />
  </v-app>
</template>


<script setup>
import NavbarUser from './NavbarUser.vue'
import FooterUser from './FooterUser.vue'
</script>
