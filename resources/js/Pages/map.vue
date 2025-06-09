<script setup>
    import {ref, onMounted } from 'vue';
    import "leaflet/dist/leaflet.css"
    import * as L from 'leaflet';
    import { router } from '@inertiajs/vue3'
    import SvgIcon from '@jamescoyle/vue-icon';
    import { mdiMapMarker } from '@mdi/js';



    const initialMap = ref(null);

    onMounted(()=> {
    initialMap.value = L.map('map').setView([23.8041, 90.4152], 6);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19, 
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(initialMap.value);
});

function whereAmI() {
    var c_lat = 0;
    var c_lon = 0;
    navigator.geolocation.getCurrentPosition((position) => {
        const { latitude, longitude } = position.coords
        c_lat = position.coords.latitude;
        c_lon = position.coords.longitude;
         router.post('/location', { latitude, longitude }, {
            preserveScroll: true,
            only: [], // Prevent Inertia page reload
        });
        //console.log(c_lat, c_lon);
        initialMap.value.setView([c_lat, c_lon], 15);
        L.marker([c_lat, c_lon]).addTo(initialMap.value);


    });
}
whereAmI();
</script>

<template>

<div id="map">
    <v-fab absolute center left90 color="primary" @click="whereAmI">
        <v-icon>mdi-map-marker</v-icon>
    </v-fab>
</div>

</template>

<style scoped>
    #map {
        height: 100%;
        width: 100%;
    }
    .v-fab {
        z-index: 10000;
        
        margin-right: 30px !important;
      /*  margin-top: 90px !important; */
    }

</style>