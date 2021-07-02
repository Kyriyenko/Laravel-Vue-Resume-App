export default {
    baseUrl: 'profile',
    edit(data) {
        return axios
            .post(this.baseUrl + `/edit`,data)
            .then(response => {
                return response;
            })
            .catch(error => console.log(error))
            .finally()
    },
    getNetworsData() {
        return   axios
            .get(this.baseUrl +'/network')
            .then(response => {
                return response
            })
            .catch(error => console.log(error))
            .finally()
    },
    getProfileData(){
        return  axios
            .post(this.baseUrl)
            .then(response => {
                return response
            })
            .catch(error => console.log(error))
            .finally()
    },
    createNetwork(data){
        return  axios
            .post(this.baseUrl +`/network/add`,data)
            .then(response => {
               return response
            })
            .catch(error => console.log(error))
            .finally()
    },
    deleteNetworkData(data) {
        return  axios
            .post(this.baseUrl +`/network/delete`,data)
            .then(response => {
               return response
            })
            .catch(error => console.log(error))
            .finally()
    }

}

