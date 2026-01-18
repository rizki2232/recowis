<template>
    <v-app>
        <SidebarAdmin />

        <v-main>
        <slot />
        </v-main>

    </v-app>
</template>


<script setup>
import SidebarAdmin from './SidebarAdmin.vue'
</script>
