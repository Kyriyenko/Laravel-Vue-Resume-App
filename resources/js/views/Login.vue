<template>
<div>
    <div>
        <div class="container mt-5">
            <div v-if="userRole!=='guest'" class="alert alert-warning" role="alert">
                You do not have access to this page
            </div>
        </div>
        <form v-if="userRole==='guest'">
            <div class="container">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input v-model="name" type="text" class="form-control"  placeholder="name" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label  for="exampleInputPassword1" class="form-label">Password</label>
                <input v-model="password" type="password" class="form-control" placeholder="your password" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
                <button v-on:click="makeUserLogin" type="button" class="btn btn-primary">Submit</button>
            <div v-if="isLogin" class="alert alert-success mt-2" role="alert">
                {{ serverMessage}}
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
            isLogin:false,
            serverMessage:''
        }
    },
    methods: {
        makeUserLogin() {
            axios
                .get(`/user/login/${this.name}/${this.password}`)
                .then(response => {
                    this.isLogin=response.data.status
                    this.serverMessage=response.data.message.toString()
                    if(this.isLogin){
                        setTimeout(()=>{
                            window.location.replace('/');
                        }, 1000);
                    }
                })
                .catch(error => console.log(error))
                .finally()
        },

    }

}
</script>

<style scoped>

form{
    padding: 45px  20px;
    border: 1px solid #59687c;
    position: absolute;
    width: 500px;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
}

</style>


