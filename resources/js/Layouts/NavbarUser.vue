<template>
  <v-app-bar app color="#E8EDF5" dark height="75">


    <div class="d-flex align-center ml-4" style="height: 100%;">
      <img
        src="/images/logo.png"
        alt="Logo"
        style="height: 50px; width: auto;"
        class="mr-3"
      />

      <span class="text-subtitle-1 font-weight-medium">
        Disbudporapar
      </span>
    </div>

    <v-spacer />


    <v-menu offset-y>
      <template #activator="{ props }">
        <div
          v-bind="props"
          class="d-flex align-center mr-6 cursor-pointer"
        >
          <span class="mr-2">
            Hei, {{ user.first_name }}
          </span>

          <v-icon>
            mdi-account-circle
          </v-icon>

        </div>
      </template>

      <v-list>
        <v-list-item @click="logout">
          <v-list-item-title>
            Logout
          </v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>

  </v-app-bar>
</template>


<script setup>
import {router, usePage} from "@inertiajs/vue3";



const page = usePage()
const user = page.props.auth.user

const logout = () => {
  console.log('Logout clicked')
  router.post('/logout')
}
</script>
