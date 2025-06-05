<template>
  <v-container>
    <v-form @submit.prevent="submit">
      <v-text-field
        v-model="form.email"
        label="Email"
        type="email"
        required
      />
      <v-text-field
        v-model="form.password"
        label="Password"
        type="password"
        required
      />
      <v-btn type="submit" color="primary">Login</v-btn>
    </v-form>
    <v-alert v-if="error" type="error">{{ error }}</v-alert>
  </v-container>
</template>

<script setup>
import { ref } from 'vue'
import { useAuth } from '~/composables/useAuth'
import { useRouter } from 'vue-router'

const { login } = useAuth()
const router = useRouter()

const form = ref({
  email: '',
  password: '',
})

const error = ref(null)

async function submit() {
  error.value = null
  try {
    await login(form.value)
    router.push('/dashboard')  
  } catch (e) {
    error.value = e.message || 'Login failed'
  }
}
</script>
