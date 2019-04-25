
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform';

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


import Dashboard from './components/Dashboard'
import Users from './components/Users'

import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  routes: [
      {
          path: '/admin/dashboard',
          name: 'admin-dashboard',
          component: Dashboard,
          
      },
      {
        path: '/admin/users',
        name: 'admin-users',
        component: Users,
        
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