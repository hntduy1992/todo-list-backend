import axios, {Axios} from "axios";
import {authStore} from "../stores/auth.js";

const api = axios.create({
    baseURL: 'http://localhost:8080/api',
    headers: {
        'Content-Type': 'application/json'
    }
})

api.interceptors.request.use(config => {
    const store = authStore()
    const token = store.token
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }

    return config;
}, error => {
    return Promise.reject(error)
});

export default api;