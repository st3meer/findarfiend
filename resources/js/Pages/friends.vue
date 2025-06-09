<template>
  <v-container>
    <h1 class="text-h5 mb-4">My Friends</h1>

    <!-- Show message if no friends -->
    <div v-if="friends.length === 0">You have no friends yet.</div>

    <v-row v-else>
      <v-col v-for="friend in friends" :key="friend.id" cols="12" md="6" lg="4">
        <v-card>
          <v-card-title>
            <span class="text-2xl mr-2">{{ friend.avatar }}</span>
            {{ friend.name }}
        </v-card-title>
        <v-card-text v-if="friend.distance_km !== null">
            Distance: {{ friend.distance_km }} km
        </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const friends = ref([])

onMounted(async () => {
  try {
    const response = await axios.get('/friends/api')
    // Log response to debug
    console.log('Friends data:', response.data)

    if (Array.isArray(response.data)) {
      friends.value = response.data
    } else {
      console.error('Unexpected friends data:', response.data)
    }
  } catch (error) {
    console.error('Error fetching friends:', error)
  }
})
</script>