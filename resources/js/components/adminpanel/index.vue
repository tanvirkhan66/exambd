<template>
    <div class="main">
        <div class="container mt-3">
        <h2>User List</h2>
        <p>This is the admin home page</p>            
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody v-if="users.length > 0">
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td><a @click="deleteUser(user.id)" href="#">Delete</a></td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</template>
<script setup>
    import { onMounted, ref } from "vue"
    import axios from "axios"
    
    //const site_url = Service.getMain
    let users = ref([])
    onMounted(async () => {
        getUsers()
    })
    
    const getUsers = async () => {
        let response = await axios.get('http://127.0.0.1:8000/api/get-users',{
            headers:{
                'Content-Type':'application/json',
                'Authorization':'Bearer '+localStorage.getItem('userdata')
            }
        })
        .then(data=>{
            console.log(data)
            users.value = data.data.result.val
        })
    }
    const deleteUser = (x) => {
        let text = "Are you sure to delete this user data";
        if (confirm(text) == true) {
            let response = axios.get('http://127.0.0.1:8000/api/delete-user/'+x,{
                headers:{
                    'Content-Type':'application/json',
                    'Authorization':'Bearer '+localStorage.getItem('userdata')
                }
            })
            .then(data=>{
                getUsers()
            })
        }
        
    }
    const sendmail = () =>{
        let response = axios.get('http://127.0.0.1:8000/api/send-mail',{
            headers:{
                'Content-Type':'application/json',
                'Authorization':'Bearer '+localStorage.getItem('userdata')
            }
        })
        .then(data=>{
            //getUsers()
            console.log(data.data.result.val)
        })
    }
    const myTimeout = setInterval(sendmail, 15000);
    const ourImage = (img) =>{
      return getUrl+'public/upload/'+img;
    }
    
    </script>