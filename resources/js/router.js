import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Home from './components/pages/Home'
import Edit from './components/pages/Edit'
import Login from './components/pages/Login'
import Registration from './components/pages/Registration'

const routes=[
    {
        path:'/',
        component:Home
    },
    {
        path:'/edit',
        component:Edit
    },
    {
        path:'/login',
        component:Login
    },
    {
        path:'/registration',
        component:Registration
    }

];

export default new vueRouter({
   mode:'history',
   routes:routes
});
