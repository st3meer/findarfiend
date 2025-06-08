<script setup>
    import { Link } from '@inertiajs/vue3'
    import {useForm } from '@inertiajs/vue3';
    const form = useForm({
        email: '',
        password: ''
    });
   const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
<h2>WELCOME BACK</h2>
<h3>Login to your account</h3>
<v-form @submit.prevent="submit">
   <v-container>
      <v-row>
         <v-col cols="12" md="4">
            <v-text-field
               v-model="form.email"
               label="Email"
               required
            ></v-text-field>
         </v-col>
         <v-col cols="12" md="4">
            <v-text-field
               v-model="form.password"
               label="Password"
               type="password"
               required
            ></v-text-field>
         </v-col>
      </v-row>
      <v-btn  type="submit" :loading="form.processing">Login</v-btn>
   </v-container>   
</v-form>
<p>Don't have an account? <Link href="/register">Register</Link></p>
</template>

<style scoped>
    h2, h3, p {
        text-align: center;
        margin-top: 20px;
    }

    .v-container {
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