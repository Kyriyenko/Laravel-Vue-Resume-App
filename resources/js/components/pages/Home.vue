<template>
<div>
<div class="container mt-5 mb-4">
    <div class="row">
        <div class="col-md-3 aside-block">
            <div class="img-box mt-2">
                <img src="https://st.depositphotos.com/1898481/3932/i/600/depositphotos_39322185-stock-photo-male-silhouette-isolated-on-white.jpg"  class="aside-img">
            </div>
            <div class="tool-block mt-3 ">
                <div class="profile-header mb-2 mt-4"><h5>Contacts</h5></div>
                <div>
                    <h5 class="profile-header-post">{{ post.email}}</h5>
                </div>
                <div class="profile-header mb-2 mt-4"><h5>Contact number</h5></div>
                <div>
                    <h5 class="profile-header-post">{{ post.number}}</h5>
                </div>
                <div class="profile-header mb-2 mt-4"><h5>Education</h5></div>
                <div>
                    <h5 class="profile-header-post">{{ post.education}}</h5>
                </div>
                <div class="profile-header mb-2 mt-4"><h5>Networks</h5></div>
                <div class="profile-header-post">
                    <ul v-for="network in networkData">
                        <li><a :href="network.link" class="network-link">{{network.name}}</a></li>
                    </ul>
                </div>
                <div class="profile-header mb-2 mt-3"><h5>Skills</h5></div>
                <div class="profile-header-post">
                    <ul v-for="item in skills">
                        <li>{{item}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9 p-4">
            <div class="representation-block">
                <h1 class="index-header-name-maine">{{ post.name }}</h1>
                <h5 class="index-header-name-under">Lorem Ipsum passage</h5>
            </div>
            <div class="profile-block mt-2">
                <h4 class="mb-3 mt-5" >Profile</h4>
                <p>
                    {{ post.profile}}
                </p>
            </div>
            <div class="experience-block mt-5">
                <h4 class="mb-3">Professional experience</h4>
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
import profileService from "../../services/profileService";
export default {
    name: "index",
    data() {
        return {
            post: [],
            skills:[],
            networkData:[]
        }
    },
    created() {
        this.getData()
        this.getNetworks()
    },
    methods: {
        getNetworks(){
            profileService.getNetworsData().then(response => {
                this.networkData=response.data
            })
        },
        getData() {
            profileService.getProfileData().then(response => {
                this.post = response.data
                this.skills=this.post.skills.split(" ");
            })
        },
    }
}

</script>

<style scoped>

*{
    font-family: "Nunito", sans-serif;
}

.profile-header{
    color: #ffffff;
    background-color: #323026;
    padding: 3px;
    width: 80%;
    margin: 0 auto;
    letter-spacing: 3px;
    font-family: cursive;
}

.profile-header-post{
    padding: 2px;
    width: 80%;
    margin: 0 auto;
}

.container{
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
}

.index-header-name-maine{
    color: floralwhite;
    text-transform: uppercase;
    letter-spacing: 8px;
    font-family: cursive;
}

.index-header-name-under{
    color: floralwhite;
    text-transform: uppercase
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
}

.representation-block{
    height: 200px;
    background-color: #323026;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

a{
    text-decoration: none;
    color: #2a2823;
}

.network-link:hover{
    color: #46433a;
}

</style>
