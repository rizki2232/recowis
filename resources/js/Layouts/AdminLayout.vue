<template>
    <v-app>
        <SidebarAdmin />

        <v-main>
            <v-container fluid class="pa-6">
                <slot />
            </v-container>
        </v-main>

    </v-app>
</template>


<script setup>
import SidebarAdmin from './SidebarAdmin.vue'
</script>
