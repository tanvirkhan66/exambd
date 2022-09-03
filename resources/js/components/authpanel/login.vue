<template>
    <div class="container">
        <h1>Login Page</h1>
       <div class="col-md-8 text-center">
        <div id="error-msg" style="color:red; font-size:15px;"></div>
        <div class="form-group">
            <label for="name">Email:</label>
            <input type="text" v-model="state.email" class="form-control" placeholder="Enter email" name="email"/>
            <span class="error-msg" v-if="v$.email.$error">
                {{ v$.email.$errors[0].$message }}
            </span>
        </div>
        <div class="form-group">
            <label for="name">Password:</label>
            <input type="password" v-model="state.password.password" class="form-control" placeholder="Enter password" name="password"/>
            <span class="error-msg" v-if="v$.password.$error">
                {{ v$.password.$errors[0].$message }}
            </span>
        </div>
        <button @click="submitForm" class="btn btn-primary">Submit</button>

       </div>
    </div>
</template>
<script>
    import { onMounted, ref } from "vue";
    
    import axios from "axios";
    import useVuelidate from '@vuelidate/core';
    import { required, email, minLength, helpers } from '@vuelidate/validators';
    import { reactive, computed } from 'vue'
        export default{
            setup(){
                let isAuth = ref(false)
                let logOutMessage = ref('')
                const state = reactive({
                    email:'',
                    password:{
                        password:'',
                    },
                })
                const rules = computed(() =>{
                    return {
                        email: {
                            required: helpers.withMessage("Email field is required!", required),
                            email: helpers.withMessage("Email field must be valid email address!", email) ,
                            },
                        password:{
                            password: { 
                            required:helpers.withMessage("Password field is required!", required),
                            minLength:helpers.withMessage("Password field must be contain 6 charecters!", minLength(6))
                            },
                        },
                    }
                })
                onMounted(async () => {
                    //checkLogin()
                })
    
                const checkLogin = ()=>{
                    if(localStorage.getItem('userdata') !== null){
                        //this.$toast.add({severity:'success', summary: 'Successful', detail: 'Product Updated', life: 3000});
                        return window.location.href = '/dashboard';
                    }else{
                        if(localStorage.getItem('message') !==null){
                            logOutMessage.value = localStorage.getItem('message')
                        }
                        localStorage.clear();
                    }
                }
                
                const v$ = useVuelidate(rules,state)
                return {
                    state,
                    v$,
                    isAuth,
                    logOutMessage,
                }
            },
            methods:{
                submitForm(){
                    this.v$.$validate()
                    if(!this.v$.$error){
                        
                        let res = axios.post('http://127.0.0.1:8000/api/user-login',{
                            email: this.state.email,
                            password: this.state.password.password
                        },
                        {
                            headers:{
                                'Content-Type':'application/json'
                            }
                        })
                        .then(data=>{
                            console.log(this.$main_url)
                            console.log(data)
                            
                            if(data.data.result.key==101){
                                document.getElementById("error-msg").innerHTML = data.data.result.val;
                            }
                            if(data.data.result.key==200){
                                localStorage.setItem('userdata',data.data.result.token);
                                this.isAuth = true;
                                if(data.data.result.role=="admin"){
                                    return window.location.href = '/dashboard';
                                }else{
                                    return window.location.href = '/';
                                }
                                
                            }
                        })
                        console.log(res);
                    }else{
                        
                    }
                },
                
            },
            components: {

            }
        }
    </script>