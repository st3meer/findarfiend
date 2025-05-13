<script>
//import Vmenu from './vmenu.vue';

export default {
    data: () => ({
      items: [
        { title: 'My profile' },
        { title: 'Settings' },
        { title: 'Click Me' },
        { title: 'Click Me 2' },
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
        <v-list-item v-for="(item, index) in items" :key="index" :value="index">
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