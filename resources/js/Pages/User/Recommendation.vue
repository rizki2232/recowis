<script setup>
defineProps({
  spots: Array
})
</script>

<template>
  <div>
    <h2>Rekomendasi Untuk Anda</h2>

    <div v-for="spot in spots" :key="spot.id">
      <h3>{{ spot.name }}</h3>
      <p>Kategori: {{ spot.category.name }}</p>
      <p>{{ spot.address }}</p>
      <hr />
    </div>
  </div>
</template>
