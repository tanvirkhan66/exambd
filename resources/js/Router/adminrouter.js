//import Vue from "vue";
import { createRouter, createWebHistory } from "vue-router";
import Index from "../components/adminpanel/index.vue";

const routes = [
    {
        path: '/dashboard',
        component: Index
    },
]
const authrouter = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
})
export default authrouter