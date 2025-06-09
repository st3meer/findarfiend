<template>
  <v-bottom-navigation grow>

  <v-btn value="Map" to="/map">
    <v-icon>mdi-map-marker</v-icon>

    <span>Map</span>
  </v-btn>

  <v-btn value="Friends" to="/friends">
    <v-icon>mdi-account-group</v-icon>

    <span>Friends</span>
  </v-btn>

  <v-btn value="Events" to="/new_friends">
    <v-icon>mdi-star-box</v-icon>

    <span>Events</span>
  </v-btn>

  <v-btn value="My Account" to="/account">
    <v-icon>mdi-chat</v-icon>

    <span>My Account</span>
  </v-btn>
</v-bottom-navigation>
</template>

<script setup>
  
</script>