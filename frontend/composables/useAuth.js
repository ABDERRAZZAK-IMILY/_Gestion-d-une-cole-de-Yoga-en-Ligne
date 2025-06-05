import { useState } from '#app'
import axios from 'axios'

export function useAuth() {
  const user = useState('user', () => null)

  async function register(form) {
    try {
      const config = useRuntimeConfig()
      const res = await axios.post(`${config.public.apiBase}/register`, form)
      return res.data
    } catch (error) {
      throw error.response?.data || error
    }
  }

  async function login(form) {
    try {
      const config = useRuntimeConfig()
      const res = await axios.post(`${config.public.apiBase}/login`, form, {
      })
      user.value = await fetchUser()
      return res.data
    } catch (error) {
      throw error.response?.data || error
    }
  }

  async function fetchUser() {
    try {
      const config = useRuntimeConfig()
      const res = await axios.get(`${config.public.apiBase}/user`, {
        withCredentials: true
      })
      return res.data
    } catch {
      return null
    }
  }

  async function logout() {
    user.value = null
  }

  return {
    user,
    register,
    login,
    fetchUser,
    logout,
  }
}
