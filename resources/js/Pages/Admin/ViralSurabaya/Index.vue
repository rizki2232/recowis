<template>

<v-container>

<h2 class="text-h5 mb-4">Viral di Surabaya</h2>
<v-table>
<thead>
<tr>
<th>Posisi</th>
<th>Nama Wisata</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>
<tr v-for="item in viral" :key="item.id">

<td>{{ item.position }}</td>

<td>
{{ item.tourist_spot?.name }}
</td>

<td>
<v-btn
color="primary"
@click="openModal(item)"
>
Ganti
</v-btn>
</td>

</tr>
</tbody>
</v-table>

</v-container>


<!-- MODAL -->
<v-dialog v-model="dialog" width="500">

<v-card>

<v-card-title>
Ganti Wisata Viral
</v-card-title>

<v-card-text>

<v-select
label="Pilih Wisata"
:items="touristSpots"
item-title="name"
item-value="id"
v-model="selectedTourist"
/>

</v-card-text>

<v-card-actions>

<v-spacer />

<v-btn
color="grey"
variant="text"
@click="dialog=false"
>
Batal
</v-btn>

<v-btn
color="primary"
@click="save"
>
Simpan
</v-btn>

</v-card-actions>

</v-card>

</v-dialog>

</template>


<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
defineOptions({ layout: AdminLayout })
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
viral: Array,
touristSpots: Array
})

const dialog = ref(false)
const selectedTourist = ref(null)
const selectedViral = ref(null)

function openModal(item){
selectedViral.value = item
selectedTourist.value = item.tourist_spot_id
dialog.value = true
}

function save(){

router.put(
`/admin/viral/${selectedViral.value.id}`,
{
tourist_spot_id: selectedTourist.value
},
{
onSuccess: () => {
dialog.value = false
}
}
)

}

</script>
