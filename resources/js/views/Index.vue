<template>
<div>
<div class="container mt-5 ">
    <div class="row">
        <div class="col-md-3 aside-block">
            <div class="img-box mt-2">
                <img  src="https://st.depositphotos.com/1898481/3932/i/600/depositphotos_39322185-stock-photo-male-silhouette-isolated-on-white.jpg"  class="aside-img">
            </div>
            <div class="tool-block mt-2">
                <h4 class="profile-header">Contacts</h4>
                <h5>{{ post.email}}</h5>
                <h5>{{ post.network}}</h5>
                <h5>{{ post.number}}</h5>
            </div>
            <div class="tool-block mt-2">
                <h4 class="profile-header">Education</h4>
                <h5>{{ post.education}}</h5>
            </div>
            <div class="tool-block mt-2">
                <h5 class="profile-header">Skills</h5>
                <ul v-for="item in skills">
                    <li>{{item}}</li>
                </ul>
            </div>
        </div>
        <div class="col-md-9 p-4">
            <div class="representation-block">
                <h5 style="color: floralwhite; text-transform: uppercase">{{ post.name }}</h5>
            </div>
            <div class="profile-block">
                <h4 >Profile</h4>
                <p>
                    {{ post.profile}}
                </p>
            </div>
            <div class="experience-block mt-5">
                <h4 >Professional experience</h4>
                <p>
                    {{ post.experience}}
                </p>
            </div>
        </div>
    </div>
</div>
</div>
</template>

<script>
export default {
    name: "index",
    data() {
        return {
            post: [],
            skills:[]
        }
    },
    created() {
        this.getData()
    },
    methods: {
        getData() {
            axios
                .post('/post')
                .then(response => {
                    this.post = response.data[0]
                    this.skills=this.post.skills.split(" ");
                })
                .catch(error => console.log(error))
                .finally()
        },
    }
}

</script>

<style scoped>

.profile-header{
    color: #ffffff;
    background-color: #323026;
    padding: 8px;
}

.container{
    border: 1px solid black;
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
}

.aside-block{
    background-color: #d9c3a7;
}
.img-box{
    display: flex;
    justify-content: center;
}

.aside-img{
    width: 200px;
    height: 200px;
    border-radius: 100px;
}

.tool-block{
    display: flex;
    flex-direction: column;
    align-items: center;
}

.representation-block{
    height: 200px;
    background-color: #323026;
    display: flex;
    justify-content: center;
    align-items: center;
}

</style>
