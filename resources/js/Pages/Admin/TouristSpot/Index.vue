<template>
  <v-container>

    <div class="d-flex justify-space-between align-center mb-4">
      <h2>Data Wisata</h2>

      <v-btn
        color="primary"
        href="/admin/tourist-spot/create"
      >
        + Tambah Wisata
      </v-btn>
    </div>

    <v-table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Harga</th>
          <th>Kategori</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="spot in spots" :key="spot.id">
          <td>{{ spot.name }}</td>
          <td>{{ spot.address }}</td>
          <td>{{ spot.ticket_price }}</td>
          <td>{{ spot.category.name}}</td>
          <td class="d-flex gap-2">

            <!-- EDIT -->
            <v-btn
              size="small"
              color="warning"
              :href="`/admin/tourist-spot/${spot.id}/edit`"
            >
              Edit
            </v-btn>

            <!-- DELETE -->
            <v-btn
              size="small"
              color="error"
              @click="deleteSpot(spot.id)"
            >
              Delete
            </v-btn>

          </td>
        </tr>
      </tbody>
    </v-table>

  </v-container>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineOptions({ layout: AdminLayout })

const props = defineProps({
  spots: Array
})

const deleteSpot = (id) => {
  if (confirm('Yakin mau hapus data ini?')) {
    router.delete(`/admin/tourist-spot/${id}`)
  }
}
</script>
