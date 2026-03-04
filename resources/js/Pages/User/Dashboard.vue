<template>
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

       <v-col cols="12" md="6" class="position-relative">
        <div class="hero-rotator">


        <v-avatar
            size="300"
            class="hero-avatar main"
            :class="positionClasses.main"
        >
            <v-img :src="circleImages[mainIndex]" cover />
        </v-avatar>

        <v-avatar
            size="170"
            class="hero-avatar top"
            :class="positionClasses.top"
        >
            <v-img :src="circleImages[topIndex]" cover />
        </v-avatar>

        <v-avatar
            size="170"
            class="hero-avatar bottom"
            :class="positionClasses.bottom"
        >
            <v-img :src="circleImages[bottomIndex]" cover />
        </v-avatar>

        </div>
      </v-col>

      </v-row>
      <div>
        <h2>Rekomendasi Untuk Anda</h2>

        <div
        v-for="spot in recommendedSpots"
        :key="spot.id"
        style="margin-bottom:20px;"
        >
        <img
            v-if="spot.image"
            :src="`/storage/${spot.image}`"
            alt="gambar wisata"
            width="200"
        />

        <h3>{{ spot.name }}</h3>
        </div>
    </div>
    </v-container>
  </section>
</template>



<script setup>
import UserLayout from '@/Layouts/UserLayout.vue'
defineOptions({ layout: UserLayout })
import { ref, onMounted, onUnmounted } from 'vue'


defineProps({
  recommendedSpots: Array
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



<style scoped>
.hero-rotator {
  position: relative;
  width: 100%;
  height: 420px;
}

/* TRANSISI HALUS */
.hero-avatar {
  position: absolute;
  transition:
    transform 0.8s cubic-bezier(0.4, 0, 0.2, 1),
    opacity 0.8s ease;
}

/* POSISI NORMAL */
.hero-avatar.main {
  right: 60px;
  top: 80px;
  z-index: 3;
  transform: scale(1);
}

.hero-avatar.top {
  right: -20px;
  top: 0;
  z-index: 2;
  transform: scale(0.85);
  opacity: 0.8;
}

.hero-avatar.bottom {
  right: -20px;
  bottom: 0;
  z-index: 1;
  transform: scale(0.7);
  opacity: 0.6;
}

/* === ANIMASI PERPINDAHAN POSISI === */

/* TOP → MAIN */
.to-main {
  transform: translate(-80px, 140px) scale(1);
  opacity: 1;
  z-index: 4;
}

/* MAIN → BOTTOM */
.to-bottom {
  transform: translate(40px, 200px) scale(0.7);
  opacity: 0.6;
  z-index: 1;
}

/* BOTTOM → TOP */
.to-top {
  transform: translate(-40px, -180px) scale(0.85);
  opacity: 0.8;
  z-index: 2;
}

.bg-hero{
background-color: #B8D779;
}
</style>
