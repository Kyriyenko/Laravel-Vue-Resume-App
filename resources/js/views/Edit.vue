<template>
<div>
    <div class="container mt-5">
        <div v-if="userRole!=='admin'" class="alert alert-warning" role="alert">
            You do not have access to this page
        </div>
    </div>
    <div v-if="userRole==='admin'" class="container mt-4">
        <div v-show="postUpdateStatus">
            <div  class="alert alert-success mt-3" role="alert">
                {{ serverMessage }}
            </div>
        </div>
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
            <label for="exampleFormControlInput6" class="form-label">Network</label>
            <input v-model="post.network" type="text" class="form-control" id="exampleFormControlInput6" >
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
</div>
</template>

<script>
export default {
    name: "Edit",
    data() {
        return {
            post: [],
            postUpdateStatus:'',
            serverMessage:'',
            userRole:sessionStorage.getItem('role')
        }
    },
    created() {
        this.getDataForUpdate()
    },
    methods: {
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

</style>
