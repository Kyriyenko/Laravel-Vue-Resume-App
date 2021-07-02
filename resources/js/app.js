require('./bootstrap');

window.Vue = require('vue').default;


import App from './components/App'
import Header from './components/navigation/Menu'
import router from './router'

Vue.component('v-header',Header);

const app = new Vue({
    el: '#app',
    router:router,
    render:h =>h(App)
});
