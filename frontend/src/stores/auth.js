import {defineStore} from "pinia";
import {computed, ref} from "vue";

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