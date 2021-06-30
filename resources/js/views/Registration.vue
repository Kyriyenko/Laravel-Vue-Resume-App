<template>
<div>
    <div>
        <div class="container mt-5">
            <div v-if="userRole!=='guest'" class="alert alert-warning" role="alert">
                You do not have access to this page
            </div>
        </div>
        <form v-if="userRole==='guest'">
            <div class="row justify-content-center">
                <div class="col reg-header">
                    <h3>Register</h3>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col reg-header">
                    <h5>Create your own account its free.</h5>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">Your Name</label>
                <input v-model="name" type="text" class="form-control" placeholder="name" id="exampleInputName1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input v-model="email" type="email" class="form-control" placeholder="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1"  class="form-label">Password</label>
                <input v-model="password" type="password" placeholder="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button v-on:click="makeUserRegistration" type="button" class="btn btn-success">Registrate</button>
            <div v-if="isRegistration" class="alert alert-success mt-2" role="alert">
                {{ serverMessage}}
            </div>
            <div v-if="isIncorrectData" class="mt-2">
                <div  class="alert alert-danger" role="alert">
                   <ul v-for="error in errors">
                       <li>{{error.toString()}}</li>
                   </ul>
                </div>
            </div>
            <div v-if="!uniqueUser" class="mt-2">
                <div  class="alert alert-danger" role="alert">
                    {{ serverMessage}}
                </div>
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
            serverMessage:'',
            errors:{},
            isIncorrectData:false,
            uniqueUser:true
        }
    },

    methods: {
        makeUserRegistration() {
            this.uniqueUser=true
            this.isIncorrectData=false
            this.isRegistration=false
            axios
                .post('/user/add',{name:this.name,email:this.email,password:this.password})
                .then(response => {
                    console.log(response)
                    let isQuerySuccess=response.data.status
                    if(response.data.unique==='null'){
                        this.uniqueUser=false
                        this.serverMessage=response.data.message.toString()
                        return;
                    }
                    if(isQuerySuccess){
                        this.isRegistration=response.data.status
                        this.serverMessage=response.data.message.toString()
                        if(this.isRegistration){
                            setTimeout(()=>{
                                window.location.replace('/');
                            }, 1000);
                        }
                    }else{
                        this.errors=response.data.errors
                        this.isIncorrectData=true
                    }
                })
                .catch(error => console.log(error))
                .finally()
        },

    }
}
</script>

<style scoped>

*{
    color: #6e7b87;
    background-color: #f2f3f7;
}

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

.reg-header{
    display: flex;
    justify-content: center;
}

button{
 background-color: #419741;
    color: #ffffff;
}

button:hover{
    background-color: #64bb64;
}


</style>
