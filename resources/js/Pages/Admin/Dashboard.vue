<template>
  <div>
    <h1 class="text-h5 font-weight-bold mb-4">
      Dashboard Admin
    </h1>

    <v-row>
      <v-col cols="12" md="4">
        <v-card>
          <v-card-text>Total Wisata</v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
defineOptions({ layout: AdminLayout })
</script>
