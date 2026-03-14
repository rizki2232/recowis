<template>
  <v-navigation-drawer
    permanent
    app
    width="260"
  >

    <!-- HEADER SIDEBAR -->
    <v-list-item class="py-4">
      <v-list-item-title class="text-h6 font-weight-bold">
        Admin Panel
      </v-list-item-title>
      <v-list-item-subtitle>
        Disbudporapar
      </v-list-item-subtitle>
    </v-list-item>

    <v-divider />

    <!-- MENU -->
    <v-list nav density="comfortable">

      <v-list-item
        prepend-icon="mdi-view-dashboard"
        title="Dashboard"
        href="/admin/dashboard"
      />

      <v-list-item
        prepend-icon="mdi-map-marker"
        title="Wisata"
        href="/admin/tourist-spot"
      />

      <v-list-item
        prepend-icon="mdi-tag"
        title="Wisata Viral"
        href="/admin/viral"
      />

      <v-list-item
        prepend-icon="mdi-account"
        title="User"
        href="/admin/users"
      />

    </v-list>

    <v-divider class="my-4" />

    <!-- LOGOUT -->
    <v-list>
      <v-list-item
        prepend-icon="mdi-logout"
        title="Logout"
        @click="logout"
      />
    </v-list>

  </v-navigation-drawer>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

const logout = () => {
  router.post('/logout')
}
</script>
