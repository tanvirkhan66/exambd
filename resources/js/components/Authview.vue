<template>
<div class="container" style="display:flex; flex-direction:column">
<header>Header 
    <router-link to="/auth/login" >Login</router-link> | 
    <router-link to="/auth/register" >Register</router-link>
</header>
<Router-view />
</div>
    
</template>