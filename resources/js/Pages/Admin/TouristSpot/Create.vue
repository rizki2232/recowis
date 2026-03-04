<template>
  <v-container>
    <h2>Tambah Wisata</h2>

    <v-text-field label="Nama Wisata" v-model="form.name" />

    <v-select
    label="Kategori"
    :items="props.categories"
    item-title="name"
    item-value="id"
    v-model="form.category_id"
    />


    <v-textarea
      label="Deskripsi"
      v-model="form.description"
    />

    <v-file-input
      label="Gambar Wisata"
      v-model="form.image"
      accept="image/*"
    />

    <v-text-field
      label="Jam Buka"
      type="time"
      v-model="form.open_time"
    />

    <v-text-field
      label="Jam Tutup"
      type="time"
      v-model="form.close_time"
    />

    <v-text-field
      label="Harga Tiket"
      type="number"
      v-model="form.ticket_price"
    />

    <v-text-field
      label="Alamat"
      v-model="form.address"
    />

    <v-text-field
      label="Lokasi (Lat,Lng)"
      v-model="form.location"
    />

    <v-btn color="primary" class="mt-4" @click="submit">
      Simpan
    </v-btn>
  </v-container>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineOptions({ layout: AdminLayout })

const props = defineProps({
  categories: {
    type: Array,
    default: () => []
  }
})

const form = useForm({
  name: '',
  category_id: '',
  description: '',
  image: null,
  open_time: '',
  close_time: '',
  ticket_price: '',
  address: '',
  location: '',
})

const submit = () => {
  form.post('/admin/tourist-spot', {
    forceFormData: true,
  })
}
</script>
