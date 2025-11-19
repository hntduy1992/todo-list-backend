import {createApp} from 'vue'
import './style.css'
import App from './App.vue'
import router from "./router/index.js";
import {authStore} from "./stores/auth.js";
import {createPinia} from "pinia";


const store = createPinia()
const app = createApp(App)
app.use(store)
app.use(router)
app.mount('#app')

const auth = authStore()
auth.initializeAuth()