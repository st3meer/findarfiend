<script>
//import Vmenu from './vmenu.vue';
//import {Link} from '@inertiajs/vue3';
import axios from 'axios'
export default {
    data: () => ({
      items: [
        { link:"/new_friends", title: 'Add friends' },
        { link:"/freiendship_requests", title: 'Friendsip requests' },
        { link:"/login", title: 'Login' },
        { link:"/register", title: 'register' },
      ],
     user: null,
  }),

  mounted() {
    this.fetchUser()
  },

  methods: {
    async fetchUser() {
      try {
        const response = await axios.get('/api/me')
        this.user = response.data
      } catch (error) {
        console.error('Error fetching user:', error)
      }
    },
  },
}
  


</script>

<template>
    <v-app-bar :elevation="2">
    <template v-slot:prepend>
        <v-app-bar-nav-icon id="menu-activator">
        </v-app-bar-nav-icon>
    </template>

    <v-app-bar-title>FindAFriend</v-app-bar-title>
    <v-icon>logo</v-icon>
    <v-spacer />

    <!-- Emoji avatar shown if user is logged in -->
    <div v-if="user" class="mr-4 text-2xl">
      {{ user.avatar || '⭕️' }}
    </div>
    </v-app-bar>

    <v-menu location="bottom start " activator="#menu-activator">
      <v-list>
        
        <v-list-item v-for="(item, index) in items" :key="index" :value="index" :href=item.link>
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
</template>

<style scoped>
    .v-icon {
        margin-right: 8px;
    }

    
    
</style>