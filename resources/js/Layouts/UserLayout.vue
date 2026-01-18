<template>
  <v-app>
    <NavbarUser />

    <v-main>
      <slot />
    </v-main>

    <FooterUser />
  </v-app>
</template>

<script setup>
import NavbarUser from './NavbarUser.vue'
import FooterUser from './FooterUser.vue'
</script>
