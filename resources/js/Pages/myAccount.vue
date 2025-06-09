<template>
  <v-container>
    <h1>My Account</h1>

    <v-form @submit.prevent="update">
      <v-text-field label="Name" v-model="form.name" :error-messages="form.errors.name" />
      <v-text-field label="Email" v-model="form.email" :error-messages="form.errors.email" />
      <v-text-field
    v-model="form.emoji_avatar"
    label="Emoji Avatar"
    maxlength="2"
    :error-messages="form.errors.emoji_avatar"
    placeholder="😎"
    />
      <v-btn type="submit" color="primary" :loading="form.processing">Update</v-btn>
    </v-form>

    <v-divider class="my-6"></v-divider>

    <h2>Change Password</h2>
    <v-form @submit.prevent="changePassword">
      <v-text-field label="Current Password" v-model="passwordForm.current_password" type="password" :error-messages="passwordForm.errors.current_password" />
      <v-text-field label="New Password" v-model="passwordForm.password" type="password" :error-messages="passwordForm.errors.password" />
      <v-text-field label="Confirm Password" v-model="passwordForm.password_confirmation" type="password" :error-messages="passwordForm.errors.password_confirmation" />
      <v-btn type="submit" color="primary" :loading="passwordForm.processing">Change Password</v-btn>
    </v-form>
    <v-alert
        v-if="$page.props.flash.success"
        type="success"
        variant="tonal"
        class="mt-4"
        >
        {{ $page.props.flash.success }}
    </v-alert>

    <v-alert
        v-if="passwordForm.hasErrors"
        type="error"
        variant="tonal"
        class="mt-4"
        >
        <ul>
            <li v-for="(msg, field) in passwordForm.errors" :key="field">
            {{ msg }}
            </li>
        </ul>
    </v-alert>
  </v-container>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { computed } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

const page = usePage()
const user = computed(() => page.props.auth.user)

const form = useForm({
  name: user.value.name,
  email: user.value.email,
  emoji_avatar: user.value.emoji_avatar || '',
})

const update = () => {
  form.put(route('account.update'))
}

const passwordForm = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
})

const changePassword = () => {
  passwordForm.put(route('account.password.update'))
}
</script>