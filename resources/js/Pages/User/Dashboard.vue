<template>

<!-- HERO SECTION -->
<section class="bg-hero">
  <v-container fluid>
    <v-row align="center" class="py-12">

      <!-- TEKS -->
      <v-col cols="12" md="6">
        <h1 class="text-h4 text-md-h3 font-weight-medium text-center text-md-left text-white">
          SELAMAT DATANG DI WEBSITE <br>
          REKOMENDASI PARIWISATA SURABAYA
        </h1>
      </v-col>

      <!-- GAMBAR -->
      <v-col cols="12" md="6" class="position-relative">
        <div class="hero-rotator">

          <v-avatar size="300" class="hero-avatar main" :class="positionClasses.main">
            <v-img :src="circleImages[mainIndex]" cover />
          </v-avatar>

          <v-avatar size="170" class="hero-avatar top" :class="positionClasses.top">
            <v-img :src="circleImages[topIndex]" cover />
          </v-avatar>

          <v-avatar size="170" class="hero-avatar bottom" :class="positionClasses.bottom">
            <v-img :src="circleImages[bottomIndex]" cover />
          </v-avatar>

        </div>
      </v-col>

    </v-row>
  </v-container>
</section>


<!-- SECTION VIRAL -->
<section class="viral-wrapper">
  <div class="viral-label">
    <v-sheet elevation="4" rounded="xl" class="px-6 py-2">
      Viral di Surabaya
    </v-sheet>
  </div>

  <v-container>

    <v-row justify="center">

      <v-col
        v-for="spot in viralSpots"
        :key="spot.id"
        cols="12"
        sm="4"
      >
        <v-card
          class="viral-card"
          @click="openModal(spot)"
        >

          <v-img
            :src="`/storage/${spot.tourist_spot?.image}`"
            height="560"
            cover
            >
            <div class="card-title">
                {{ spot.tourist_spot?.name }}
            </div>
            </v-img>

        </v-card>
      </v-col>

    </v-row>

  </v-container>

</section>

<!-- MODAL VIRAL -->
<v-dialog v-model="dialog" max-width="900">

<v-card v-if="selectedSpot">

<v-row no-gutters>

<!-- GAMBAR -->
<v-col cols="12" md="6">
<v-img
:src="`/storage/${selectedSpot?.tourist_spot?.image}`"
height="100%"
cover
/>
</v-col>

<!-- INFO -->
<v-col cols="12" md="6" class="pa-6">

<!-- MODE DETAIL -->
<div v-if="!showRatingForm">

<h2 class="text-h5 mb-4 text-center">
    {{ selectedSpot?.tourist_spot?.name }}
</h2>

<!-- ADDRESS (TIDAK BISA DIKLIK) -->
<div class="info-row">
  <v-icon>mdi-map-marker</v-icon>
  <span>{{ selectedSpot?.tourist_spot?.address }}</span>
</div>

<div class="info-row">
    <v-icon>mdi-cash</v-icon>
   <span>{{ formatPrice(selectedSpot?.tourist_spot?.ticket_price) }}</span>
</div>

<div class="info-row">
    <v-icon>mdi-clock-outline</v-icon>
<span>
    {{ selectedSpot?.tourist_spot?.open_time }} -
    {{ selectedSpot?.tourist_spot?.close_time }}
</span>

</div>

<!-- LOCATION (LINK GOOGLE MAPS) -->
<div class="info-row">

    <v-icon color="green">mdi-google-maps</v-icon>

    <a
    :href="selectedSpot?.tourist_spot?.location"
    target="_blank"
    class="maps-link"
    >
    Lihat lokasi di Google Maps
    </a>

</div>

<v-btn
block
class="rating-btn mt-6"
@click="showRatingForm = true"
>
Beri Rating
</v-btn>

</div>


<!-- MODE RATING -->
<div v-else class="rating-mode">

<h2 class="text-h5 mb-6">
{{ selectedSpot?.tourist_spot?.name }}
</h2>

<v-rating
v-model="ratingValue"
length="5"
size="45"
color="yellow"
background-color="grey-lighten-2"
/>

<v-btn
    class="rating-btn mt-6"
    >
    Beri Rating
</v-btn>

<v-btn
variant="text"
class="mt-2"
@click="showRatingForm = false"
>
Kembali
</v-btn>

</div>

</v-col>

</v-row>

</v-card>

</v-dialog>

        <!-- conten base filtering -->
         <!-- SECTION REKOMENDASI -->
<!-- SECTION REKOMENDASI -->
<section class="recommend-wrapper">

<v-container>

<div class="recommend-title">
  Rekomendasi Untuk Kamu
</div>

<v-row>

<v-col
v-for="spot in recommendedSpots"
:key="spot.id"
cols="12"
sm="4"
>
<v-card
class="recommend-card"
@click="openRecommendModal(spot)"
>

<v-img
:src="`/storage/${spot.image}`"
height="250"
cover
>
<div class="card-title">
{{ spot.name }}
</div>
</v-img>

</v-card>
</v-col>

</v-row>

</v-container>

</section>

<!-- MODAL REKOMENDASI -->
<v-dialog v-model="recommendDialog" max-width="900">

<v-card v-if="selectedRecommend">

<v-row no-gutters>

<!-- GAMBAR -->
<v-col cols="12" md="6">
<v-img
:src="`/storage/${selectedRecommend?.image}`"
height="100%"
cover
/>
</v-col>

<!-- INFO -->
<v-col cols="12" md="6" class="pa-6">

<!-- MODE DETAIL -->
<div v-if="!showRatingForm">

<h2 class="text-h5 mb-4 text-center">
{{ selectedRecommend?.name }}
</h2>

<div class="info-row">
<v-icon>mdi-map-marker</v-icon>
<span>{{ selectedRecommend?.address }}</span>
</div>

<div class="info-row">
    <v-icon>mdi-cash</v-icon>
    <span>{{ formatPrice(selectedRecommend?.ticket_price) }}</span>
</div>

<div class="info-row">
<v-icon>mdi-clock-outline</v-icon>
<span>
{{ selectedRecommend?.open_time }} -
{{ selectedRecommend?.close_time }}
</span>
</div>

<div class="info-row">

<v-icon color="green">mdi-google-maps</v-icon>

<a
:href="selectedRecommend?.location"
target="_blank"
class="maps-link"
>
Lihat lokasi di Google Maps
</a>

</div>

<v-btn
block
class="rating-btn mt-6"
@click="showRatingForm = true"
>
Beri Rating
</v-btn>

</div>

<!-- MODE RATING -->
<div v-else class="rating-mode">

<h2 class="text-h5 mb-6">
{{ selectedRecommend?.name }}
</h2>

<v-rating
v-model="ratingValue"
length="5"
size="45"
color="yellow"
background-color="grey-lighten-2"
/>

<v-btn class="rating-btn mt-6">
Beri Rating
</v-btn>

<v-btn
variant="text"
class="mt-2"
@click="showRatingForm = false"
>
Kembali
</v-btn>

</div>

</v-col>

</v-row>

</v-card>

</v-dialog>

</template>


<script setup>
import UserLayout from '@/Layouts/UserLayout.vue'
import '../../../css/dashboarduser.css'
defineOptions({ layout: UserLayout })
import { ref, onMounted, onUnmounted, watch } from 'vue'


const dialog = ref(false)
const selectedSpot = ref(null)

const { viralSpots, recommendedSpots } = defineProps({
  viralSpots: Array,
  recommendedSpots: Array
})

const formatPrice = (price) => {
  if(price == 0){
    return 'Gratis'
  }
  return 'Rp ' + price
}

const showRatingForm = ref(false)
const ratingValue = ref(0)


const recommendDialog = ref(false)
const selectedRecommend = ref(null)

const openRecommendModal = (spot)=>{

  selectedRecommend.value = spot
  recommendDialog.value = true

  showRatingForm.value = false
  ratingValue.value = 0
}

watch(recommendDialog,(val)=>{
  if(!val){
    showRatingForm.value = false
    ratingValue.value = 0
  }
})

const openModal = (spot)=>{
    selectedSpot.value = spot
    dialog.value = true

    // reset tampilan
    showRatingForm.value = false
    ratingValue.value = 0
}

watch(dialog,(val)=>{
  if(!val){
    showRatingForm.value = false
    ratingValue.value = 0
  }
})
const circleImages = ref([
  '/images/buaya.jpg',
  '/images/kota.jpg',
  '/images/makan.jpg',
  '/images/kbs.png',
])

const mainIndex = ref(0)
const topIndex = ref(1)
const bottomIndex = ref(2)

const positionClasses = ref({
  main: '',
  top: '',
  bottom: '',
})


let interval = null

onMounted(() => {
  interval = setInterval(() => {
    positionClasses.value = {
      main: 'to-bottom',
      top: 'to-main',
      bottom: 'to-top',
    }

    setTimeout(() => {
      const oldMain = mainIndex.value
      mainIndex.value = topIndex.value
      topIndex.value = bottomIndex.value
      bottomIndex.value = oldMain

      positionClasses.value = {
        main: '',
        top: '',
        bottom: '',
      }
    }, 700)

  }, 5000)
})

onUnmounted(() => {
  clearInterval(interval)
})
</script>


