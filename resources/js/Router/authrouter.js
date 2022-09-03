//import Vue from "vue";
import { createRouter, createWebHistory } from "vue-router";
import Login from "../components/authpanel/login.vue";
import Register from "../components/authpanel/register.vue";

const routes = [
    {
        path: '/auth/login',
        component: Login
    },
    {
        path: '/auth/register',
        component: Register
    },
]
const authrouter = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
})
export default authrouter