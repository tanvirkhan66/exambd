<template>
    <div class="container" style="display:flex; flex-direction:column">
        <div class="admin-header">
			<div v-if="isLogin">
				<button @click="logOut" class="p-link layout-topbar-button">
					<i class="pi pi-sign-out"></i>
					<span>Sign Out</span>
				</button>
			</div>
        </div>
        <div class="sidebar">
            <a href="#Users"><i class="fa fa-fw fa-users"></i> Users</a>
            <a href="#Homepage"><i class="fa fa-fw fa-wrench"></i> Home</a>20

        </div>
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
        }else{
			localStorage.setItem('message','Login First! Then see Dashboard')
            return window.location.href = '/';
		}
    }
    const logOut = ()=>{
        if(localStorage.getItem('userdata') !== null){
            localStorage.removeItem('userdata');
            //set logout message
            localStorage.setItem('message','Logout Successfully')
            return window.location.href = '/';
        }
    }
</script>
<style scoped>
    .admin-header {
        margin-left: 200px;
    } 
</style>