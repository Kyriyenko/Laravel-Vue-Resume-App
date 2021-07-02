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
                <div class="col mt-2">
                    <hr class="dropdown-divider">
                </div>
                <div class="col reg-header">
                    <h3>Register</h3>
                </div>
                <div class="col mt-2">
                    <hr class="dropdown-divider">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col reg-header">
                    <h5>Create your own account.</h5>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">Your Name</label>
                <input v-model="name" type="text" class="form-control" placeholder="first name" id="exampleInputName1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input v-model="email" type="email" class="form-control" placeholder="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1"  class="form-label">Password</label>
                <input v-model="password" type="password" placeholder="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-check">
                <input v-on:click="isRulesAccepted=!isRulesAccepted" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    I accept <span>The Terms of Use</span> & <span>Privacy Policy</span>.
                </label>
            </div>
            <span v-if="isRegistrationFormError" class="input-error">checkbox should be checked</span>
            <button v-on:click="makeUserRegistration" type="button" class="btn btn-success mt-2">Register Now</button>
            <div v-if="isRegistrationSuccess" class="alert alert-success mt-2" role="alert">
                {{ serverMessage}}
            </div>
            <div v-if="isIncorrectData" class="mt-3">
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
import authService from "../../services/authService";
export default {
    name: "Registration",
    data() {
        return {
            name:'',
            email:'',
            password:'',
            userRole:sessionStorage.getItem('role'),
            isRegistrationSuccess:false,
            serverMessage:'',
            errors:{},
            isIncorrectData:false,
            uniqueUser:true,
            isRulesAccepted:false,
            isRegistrationFormError:false
        }
    },
    methods: {
        makeUserRegistration() {
            this.uniqueUser=true
            this.isIncorrectData=false
            this.isRegistrationSuccess=false
            this.isRegistrationFormError=false
            if(!this.isRulesAccepted){
                this.isRegistrationFormError=true
                return;
            }
            authService.registration({name:this.name,email:this.email,password:this.password})
                .then(response => {
                    let isQuerySuccess=response.data.status
                    if(response.data.unique==='null'){
                        this.uniqueUser=false
                        this.serverMessage=response.data.message.toString()
                        return;
                    }
                    if(isQuerySuccess){
                        this.isRegistrationSuccess=response.data.status
                        this.serverMessage=response.data.message.toString()
                        if(this.isRegistrationSuccess){
                            setTimeout(()=>{
                                window.location.replace('/');
                            }, 1000);
                        }
                    }else{
                        this.errors=response.data.errors
                        this.isIncorrectData=true
                    }
            })
        },
    }
}
</script>

<style scoped>

form{
    background-color: #f2f3f7;
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

li{
    list-style-type: none;
}

*{
    color: #6e7b87;
    font-family: 'Nunito', sans-serif;
}

button{
    width: 100%;
}

span{
    color:#7ec88d;
}

.input-error{
    color: #e3342f;
}

</style>
