//window.Vue = require('vue');
import { createRouter, createWebHistory } from "vue-router";
import Index from '../components/userpanel/index.vue';


//Vue.prototype.$site_url = "http://localhost/vueapp/";
const routes = [
    
    {
        path:'/',
        component: Index
    },
    
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
})
export default router