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
                    <h3>LogIn</h3>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col reg-header">
                    <h5>Fill all form field to go to next step.</h5>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input v-model="name" type="text" class="form-control"  placeholder="name" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label  for="exampleInputPassword1" class="form-label">Password</label>
                <input v-model="password" type="password" class="form-control" placeholder="password" id="exampleInputPassword1">
            </div>
                <button v-on:click="makeUserLogin" type="button" class="btn btn-success">LogIn</button>
            <div v-if="isLogin" class="alert alert-success mt-3" role="alert">
                {{ serverMessage}}
            </div>
            <div v-if="isIncorrectData" class="mt-3">
                <div  class="alert alert-danger" role="alert">
                    <ul v-for="error in errors">
                        <li>{{error.toString()}}</li>
                    </ul>
                </div>
            </div>
            <div v-if="userDoesNotExist" class="mt-3">
                <div  class="alert alert-danger" role="alert">
                    {{serverMessage}}
                </div>
            </div>
        </form>
    </div>
</div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            name:'',
            password:'',
            userRole:sessionStorage.getItem('role'),
            userDoesNotExist:false,
            isLogin:false,
            serverMessage:'',
            errors:{},
            isIncorrectData:false
        }
    },
    methods: {
        makeUserLogin() {
            this.userDoesNotExist=false
            this.isIncorrectData=false
            axios
                .post('/user/login',{name:this.name,password:this.password})
                .then(response => {
                let isSuccessLogin=response.data.status
                    if(isSuccessLogin==='login'){
                        this.isLogin=true
                        this.serverMessage=response.data.message
                        setTimeout(()=>{
                            window.location.replace('/');
                        }, 1000);
                    }
                   if(isSuccessLogin==='braked') {
                        this.isIncorrectData=true
                        this.errors=response.data.errors
                    }
                    if(isSuccessLogin==='null'){
                        this.userDoesNotExist=true
                        this.serverMessage=response.data.message
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
}

form{
    padding: 45px  20px;
    border: 1px solid #59687c;
    position: absolute;
    width: 500px;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
    background-color: #f2f3f7;
}

.reg-header{
    display: flex;
    justify-content: center;
}

button{
    background-color: #419741;
    color: #ffffff;
    border: none;
}

button:hover{
    background-color: #64bb64;
}

</style>
