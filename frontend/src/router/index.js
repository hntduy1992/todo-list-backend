import {createRouter, createWebHistory} from "vue-router";
import LoginPage from "../pages/LoginPage.vue";
import TaskPage from "../pages/TaskPage.vue";
import {authStore} from "../stores/auth.js";

const routes = [
    {path: '/auth', component: LoginPage, name: 'Auth'},
    {path: '/tasks', component: TaskPage, meta: {requiresAuth: true}}
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach(async (to, from, next) => {
    const store = authStore()
    //Khoi tao xac thuc lan dau
    if (!store.user && store.isLoggedIn) {
        await store.fetchUser()
    }

    //Kiem tra bao ve route
    //Route bat buoc dang nhap + chua dang nhap = redirect /auth
    if (to.meta.requiresAuth && !store.isLoggedIn) {
        next({path: '/auth'})
    }
    //Da dang nhap nhung co gang truy cap trang dang nhap = redirect /tasks
    else if (to.path === '/auth' && store.isLoggedIn) {
        next({path: '/tasks'})
    }
    //Cac truong hop khac cho qua (da dang nhap)
    else {
        next();
    }
})

export default router