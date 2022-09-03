//require('./bootstrap');
import { createApp } from 'vue'
import Authview from './components/Authview.vue'
import Authrouter from './Router/authrouter.js'
import App from './components/App.vue'
import Router from "./Router"
import Adminview from './components/Adminview.vue'
import Adminrouter from './Router/adminrouter.js'

const app = createApp({})
app.config.globalProperties.$main_url = import.meta.env.NODE_ENV === 'production' ? 'http://127.0.0.1:8000/' : 'http://127.0.0.1:8000/';
const Appview = document.querySelector('#app');
if(Appview){
    createApp(App).use(Router).mount('#app')
}

const Adminview1 = document.querySelector('#dashboard')
if(Adminview1){
    createApp(Adminview).use(Adminrouter).mount('#dashboard')
}
const Authview1 = document.querySelector('#auth')
if(Authview1){
    createApp(Authview).use(Authrouter).mount('#auth')
}