<script>
    export default {
        data() {
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            login() {
                // Perform login logic here
                console.log('Logging in with', this.email, this.password);
            }
        }
    }
</script>

<template>
<h2>WELCOME BACK</h2>
<h3>Login to your account</h3>
<v-form>
   <v-container>
      <v-row>
         <v-col cols="12" md="4">
            <v-text-field
               v-model="email"
               label="Email"
               required
            ></v-text-field>
         </v-col>
         <v-col cols="12" md="4">
            <v-text-field
               v-model="password"
               label="Password"
               type="password"
               required
            ></v-text-field>
         </v-col>
      </v-row>
      <v-btn @click="login">Login</v-btn>
   </v-container>   
</v-form>
<p>Don't have an account? <a href="/register">Register</a></p>
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