<template>
<div>
    <div class="container-fluid">
        <header class="d-flex justify-content-center py-3">
            <ul class="nav nav-pills">
                <li class="nav-item"><router-link to="/" class="nav-link px-4 text-white">Home</router-link></li>
                <li v-if="CurrentRole==='admin'" class="nav-item"><router-link to="/edit" class="nav-link px-4 text-white">Admin panel</router-link></li>
                <li v-if="CurrentRole==='guest'" class="nav-item"><router-link to="/login" class="nav-link px-4 text-white">Login</router-link></li>
                <li v-if="CurrentRole==='guest'" class="nav-item" ><router-link to="/registration" class="nav-link px-4 text-white">Registration</router-link></li>
                <li v-if="CurrentRole!=='guest'" class="nav-item"><a v-on:click="logOut" href="#" class="nav-link px-4 text-white">Log out</a></li>
            </ul>
        </header>
    </div>
</div>
</template>

<script>
import authService from "../../services/authService";
export default {
    name: "Header",
    data(){
        return{
            CurrentRole:'guest',
            user:[]
        }
    },
    created() {
        this.setUserStatus()
    },
    methods: {
        logOut(){
            authService.logOutUser().then(response => {
                this.CurrentRole=response.data.toString()
                this.CurrentRole=response.data.role.toString()
                if(response.data.status){
                    sessionStorage.clear()
                    window.location.replace('/');
                }
            })
        },
        setUserStatus(){
            authService.getUserStatus().then(response => {
                this.CurrentRole=response.data.toString()
            })
        },
    }
}
</script>

<style scoped>

.container-fluid{
    background-color: #53b090;
}

.nav-link:hover{
    background-color: #2b652b;
}

</style>
