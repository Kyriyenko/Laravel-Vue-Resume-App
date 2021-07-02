<template>
<div>
    <v-header></v-header>
    <router-view></router-view>
</div>
</template>

<script>
import authService from "../services/authService";

export default {
    data(){
        return{
            userCurrentRole:'',
        }
    },
    created() {
        this.setUserStatus()
    },
    methods: {
        setUserStatus(){
            authService.getUserStatus().then(response => {
                this.userCurrentRole=response.data.toString()
                sessionStorage.setItem('role',`${this.userCurrentRole}`)
            })
        },
    }
}
</script>

