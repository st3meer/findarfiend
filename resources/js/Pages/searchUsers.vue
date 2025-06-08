<template>
  <div>
    <v-text-field label="Search users" v-model="search" @input="fetchUsers" />

    <v-list v-if="users.length">
      <v-list-item v-for="user in users" :key="user.id">
        <v-list-item-title>{{ user.name }}</v-list-item-title>
        <v-btn size="small" color="primary" @click="sendRequest(user.id)">
          Add Friend
        </v-btn>
      </v-list-item>
    </v-list>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const search = ref('')
const users = ref([])

const fetchUsers = async () => {
  if (search.value.length < 2) return
  const response = await axios.get('/friends/search', { params: { q: search.value } })
  users.value = response.data
}

const sendRequest = async (id) => {
  await axios.post('/friends/request', { receiver_id: id })
  alert('Request sent')
}
</script>