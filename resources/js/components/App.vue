<template>
<div class="container" style="display:flex; flex-direction:column">
<header>Header
    <div v-if="isLogin">
        <a @click="logOut" href="#" >Logout</a>
    </div>
    <div v-else>
        <a href="/auth/login" >Login</a>
    </div>
    <h1>This is index Header</h1>
    
</header>
<Router-view />
</div>
    
</template>
<script setup>
	import { onMounted, ref } from "vue";
    let isLogin = ref(false)

    onMounted(async () => {
        checkLogin()
    })

    const checkLogin = ()=>{
        if(localStorage.getItem('userdata') !== null){
            console.log(localStorage.getItem('userdata'))
            isLogin.value = true
        }
    }
    const logOut = ()=>{
        if(localStorage.getItem('userdata') !== null){
            localStorage.removeItem('userdata');
            //set logout message
            localStorage.setItem('message','Logout Successfully')
            return window.location.href = 'auth/login';
        }
    }
</script>