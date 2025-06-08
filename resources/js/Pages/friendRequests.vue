<template>
  <v-list>
    <v-list-item v-for="req in requests" :key="req.id">
      <v-list-item-title>{{ req.sender.name }}</v-list-item-title>
      <v-btn color="green" @click="respond(req.id, 'accept')">Accept</v-btn>
      <v-btn color="red" @click="respond(req.id, 'reject')">Reject</v-btn>
    </v-list-item>
  </v-list>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const requests = ref([])

onMounted(async () => {
  const res = await axios.get('/friends/requests')
  requests.value = res.data
})

const respond = async (id, action) => {
  await axios.post('/friends/respond', { request_id: id, action })
  requests.value = requests.value.filter(r => r.id !== id)
}
</script>