import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Index from './views/Index'
import Edit from './views/Edit'
import Login from './views/Login'
import Registration from './views/Registration'

const routes=[
    {
        path:'/',
        component:Index
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
