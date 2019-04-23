
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import Dashboard from './components/Dashboard'
import Users from './components/Users'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  routes: [
      {
          path: '/admin/dashboard',
          name: 'dashboard',
          component: Dashboard,
          props: true
      },
      {
        path: '/admin/users',
        name: 'users',
        component: Users,
        props: true
    },

  ],
});



const app = new Vue({
  el: '#app',
  router,
  data:{

    },
    methods:{



    }
});