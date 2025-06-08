<template>
    <v-card>
        <v-card-title>
            <v-avatar>
                <v-img src={{user.imglink}}></v-img>
            </v-avatar>
            <span class="ml-3">{{ user.name }}</span>
        </v-card-title>
        <v-card-text>
            <p>{{ user.distance }}</p>
        </v-card-text>
        <v-card-actions>
            <v-btn @click="viewProfile">View Profile</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script setup>
const user = {
  name: 'John Doe',
  email: 'john@example.com',
  distance: '300m',
};

function viewProfile() {
  console.log('Go to profile page...');
}

</script>

<style scoped>
    .v-card {
        max-width: 400px;
        margin: auto;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        max-width: 90%;
    }
    .v-btn {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>