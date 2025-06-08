<script setup>
import {Link} from '@inertiajs/vue3';
</script>
<template>
    <div class="welcome-page">
        <h1>Welcome to FindAFriend!</h1>
        <p class="description">
            Your platform to connect with new friends. Discover, chat, and build meaningful connections.
        </p>
        <div class="actions">
            <Link href="/login"> <button>Login</button></Link>
            <Link href="/register"> <button>Register</button></Link>
        </div>
    </div>
</template>
<style scoped>
    .welcome-page {
        text-align: center;
        margin-top: 50px;
    }
    .description {
        font-size: 1.2em;
        margin-bottom: 20px;
    }
    .actions {
        display: flex;
        justify-content: center;
        gap: 20px;
    }
    button {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }
</style>