<template>
  <v-container>
    <v-form @submit.prevent="submit">
      <v-text-field v-model="form.name" label="Name" required />
      <v-text-field v-model="form.email" label="Email" type="email" required />
      <v-text-field v-model="form.password" label="Password" type="password" required />
      <v-text-field v-model="form.password_confirmation" label="Confirm Password" type="password" required />
      <v-btn type="submit" color="primary">Register</v-btn>
    </v-form>
    <v-alert v-if="error" type="error">{{ error }}</v-alert>
  </v-container>
</template>

<script setup>
import { ref } from 'vue'
import { useAuth } from '~/composables/useAuth'
import { useRouter } from 'vue-router'

const { register } = useAuth()
const router = useRouter()

const form = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  role : 'student'})

const error = ref(null)

async function submit() {
  error.value = null
  try {
    await register(form.value)
    router.push('/login')
  } catch (e) {
    error.value = e.message || 'Registration failed'
  }
}
</script>
