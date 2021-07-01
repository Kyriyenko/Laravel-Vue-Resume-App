<template>
<div>
    <div class="container-fluid mt-5">
        <div v-if="userRole!=='admin'" class="alert alert-warning" role="alert">
            You do not have access to this page
        </div>
    </div>
    <div v-show="postUpdateStatus">
        <div  class="alert alert-success mt-3" role="alert">
            {{ serverMessage }}
        </div>
    </div>
    <div v-if="userRole==='admin'" class="container mt-4">
        <div class="row">
            <div class="col-md-9">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input v-model="post.name" type="text" class="form-control" id="exampleFormControlInput1" >
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Email address</label>
                    <input  v-model="post.email" type="email" class="form-control" id="exampleFormControlInput2" >
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput5" class="form-label">Contact number</label>
                    <input v-model="post.number" type="text" class="form-control" id="exampleFormControlInput5" >
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Profile</label>
                    <textarea v-model="post.profile" class="form-control" id="exampleFormControlTextarea1" rows="3">{{post.profile}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea2" class="form-label">Experience</label>
                    <textarea v-model="post.experience" class="form-control" id="exampleFormControlTextarea2" rows="3">{{post.experience}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea3" class="form-label">Skills</label>
                    <textarea v-model="post.skills" class="form-control" id="exampleFormControlTextarea3" rows="3">{{post.skills}}</textarea>
                </div>
                <button  v-on:click="updateUserInfo" type="button" class="btn btn-primary">Save changes</button>
            </div>
            <div class="col-md-3">
                <h2>Networks</h2>
                <div class="">
                    <div class="mb-3">
                        <label for="exampleInputPassword1"  class="form-label">Network name</label>
                        <input v-model="networkName" type="text" class="form-control" placeholder="network" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Network Link</label>
                        <input v-model="networkLink" type="text" class="form-control" placeholder="link" id="examplesInputPassword1">
                    </div>
                    <div class="mb-3">
                        <button type="button" v-on:click="addNetworks" class="btn btn-primary">Add</button>
                    </div>
                </div>
                <div class="mb-3">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Network</th>
                            <th scope="col">Do</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="network in networkData">
                            <td>{{ network.name }}</td>
                            <td>
                                <button v-on:click="deleteNetwork(network.id)" type="button" class="btn btn-dark">Delete</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "Edit",
    data() {
        return {
            post: {},
            postUpdateStatus:'',
            serverMessage:'',
            userRole:sessionStorage.getItem('role'),
            networkName:'',
            networkLink:'',
            networkData:[]
        }
    },
    created() {
        this.getDataForUpdate()
        this.getNetworks()
    },
    methods: {
        deleteNetwork(id){
            axios
                .post(`post/network/delete`,{id:id})
                .then(response => {
                   if(response.data.status===true){
                       this.getNetworks()
                   }
                })
                .catch(error => console.log(error))
                .finally()
        },
        addNetworks(){
            axios
                .post(`post/network/add`,{name:this.networkName,link:this.networkLink})
                .then(response => {
                    this.responseFromNetwork=response.data.message.toString()
                    console.log( this.responseFromNetwork)
                })
                .catch(error => console.log(error))
                .finally(()=>{
                    this.getNetworks()
                    this.networkName=''
                    this.networkLink=''
                })
        },
        getNetworks(){
            axios
                .get('/post/network')
                .then(response => {
                    this.networkData=response.data
                })
                .catch(error => console.log(error))
                .finally()
        },
        getDataForUpdate() {
            axios
                .post('/post')
                .then(response => {
                    this.post = response.data[0]
                })
                .catch(error => console.log(error))
                .finally()
        },
        updateUserInfo(){
            axios
                .post(`post/edit`,this.post)
                .then(response => {
                    this.postUpdateStatus=response.data.status
                    this.serverMessage=response.data.message
                })
                .catch(error => console.log(error))
                .finally()
        }
    }
}
</script>

<style scoped>

    .container{
        box-shadow: 0 0 10px rgba(0,0,0,0.5);
        padding: 25px ;
    }

</style>
