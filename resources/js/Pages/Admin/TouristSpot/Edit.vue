<template>
  <v-container>
    <h2>Edit Wisata</h2>

    <form @submit.prevent="submit">

      <v-text-field
        label="Nama Wisata"
        v-model="form.name"
        :error-messages="form.errors.name"
      />

      <v-select
        label="Kategori"
        :items="categories"
        item-title="name"
        item-value="id"
        v-model="form.category_id"
        :error-messages="form.errors.category_id"
      />

      <v-textarea label="Deskripsi" v-model="form.description" />

      <v-file-input
        label="Gambar Wisata"
        v-model="form.image"
        accept="image/*"
      />

      <v-text-field label="Jam Buka" type="time" v-model="form.open_time" />
      <v-text-field label="Jam Tutup" type="time" v-model="form.close_time" />
      <v-text-field label="Harga Tiket" type="number" v-model="form.ticket_price" />
      <v-text-field label="Alamat" v-model="form.address" />
      <v-text-field label="Lokasi (Lat,Lng)" v-model="form.location" />

      <v-btn type="submit" color="primary" class="mt-4">
        Update
      </v-btn>

    </form>
  </v-container>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineOptions({ layout: AdminLayout })

const props = defineProps({
  spot: Object,
  categories: Array
})

const form = useForm({
  name: props.spot.name,
  category_id: props.spot.category_id,
  description: props.spot.description,
  image: null,
  open_time: props.spot.open_time,
  close_time: props.spot.close_time,
  ticket_price: props.spot.ticket_price,
  address: props.spot.address,
  location: props.spot.location,
})

const submit = () => {
  form.transform((data) => ({
    ...data,
    _method: 'put'
  })).post(`/admin/tourist-spot/${props.spot.id}`, {
    forceFormData: true,
    preserveScroll: true
  })
}


</script>
