<script>
//import Vmenu from './vmenu.vue';
//import {Link} from '@inertiajs/vue3';

export default {
    data: () => ({
      items: [
        { link:"/new_friends", title: 'Add friends' },
        { link:"/freiendship_requests", title: 'Friendsip requests' },
        { link:"/login", title: 'Login' },
        { link:"/register", title: 'register' },
      ],
    }),
    
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