export default {
    baseUrl: 'user',
    login(data) {
      return axios
            .post(this.baseUrl + '/login', data)
            .then(response => {
               return response
            })
            .catch(error => console.log(error))
            .finally()
    },
    registration(data) {
       return  axios
           .post(this.baseUrl + '/add', data)
           .then(response => {
              return response
           })
           .catch(error => console.log(error))
           .finally()
    },
    getUserStatus(){
       return  axios
            .get(`/user/status/`)
            .then(response => {
                return response
            })
            .catch(error => console.log(error))
            .finally()
    },
    logOutUser(){
       return  axios
            .get(`/user/logout/`)
            .then(response => {
                return response
            })
            .catch(error => console.log(error))
            .finally()
    }
}
