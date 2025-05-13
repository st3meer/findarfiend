<template>
  <v-app>
    <v-main>
      <AppHeader />
      <slot/>
    </v-main>
  </v-app>
</template>

<script setup>

import AppHeader from '../Components/AppHeader.vue'

</script>
