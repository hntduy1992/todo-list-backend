import {defineStore} from "pinia";
import {computed, ref} from "vue";
import api from "../services/api.js";

export const authStore = defineStore('authStore', () => {
    const token = ref(null)
    const user = ref(null)

    function initializeAuth() {
        const storedToken = localStorage.getItem('authToken')

        if (storedToken) {
            token.value = storedToken
        }
    }

    const isLoggedIn = computed(() => {
        return token.value !== null
    })

    function setToken(newToken) {
        token.value = newToken
        localStorage.setItem('authToken', newToken)
    }

    function clearToken() {
        token.value = null;
        user.value = null;
        localStorage.removeItem('authToken')
    }

    function fetchUser() {
        if (!token) return;
        try {
            api.get('/users/me').then(res => {
                user.value = res.data
            })
        } catch (e) {
            clearToken()
            console.error("Failed to fetch user:", e);
        }

    }

    return {
        token,
        user,
        initializeAuth,
        isLoggedIn,
        setToken,
        fetchUser
    }
})