<template>
<div>
    <div>
        <div class="container mt-5">
            <div v-if="userRole!=='guest'" class="alert alert-warning" role="alert">
                You do not have access to this page
            </div>
        </div>
        <form v-if="userRole==='guest'">
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">Your Name</label>
                <input v-model="name" type="text" class="form-control" id="exampleInputName1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input v-model="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input v-model="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button v-on:click="makeUserRegistration" type="button" class="btn btn-primary">Submit</button>
            <div v-if="isRegistration" class="alert alert-success mt-2" role="alert">
                {{ serverMessage}}
            </div>
        </form>
    </div>
</div>
</template>

<script>
export default {
    name: "Registration",
    data() {
        return {
            name:'',
            email:'',
            password:'',
            userRole:sessionStorage.getItem('role'),
            isRegistration:false,
            serverMessage:''
        }
    },

    methods: {
        makeUserRegistration() {
            axios
                .get(`/user/create/${this.name}/${this.email}/${this.password}`)
                .then(response => {
                    this.isRegistration=response.data.status
                    this.serverMessage=response.data.message.toString()
                    if(this.isRegistration){
                        setTimeout(()=>{
                            window.location.replace('/');
                        }, 2000);
                    }
                })
                .catch(error => console.log(error))
                .finally(()=>{
                    window.location.replace('/');
                })
        },


    }
}
</script>

<style scoped>

form{
    padding: 45px  25px;
    border: 1px solid #59687c;
    position: absolute;
    width: 500px;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
}

</style>
