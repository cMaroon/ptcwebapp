
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform';

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


import Dashboard from './components/Dashboard'
import Users from './components/AdminUsers'
import Pagination from './components/partial/PaginationComponent.vue'

import VueRouter from 'vue-router'
import VueProgressBar from 'vue-progressbar'

const VueProgressBarOptions = {
  color: '#50d38a',
  failedColor: '#874b4b',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'top',
  inverse: false
}
Vue.use(VueProgressBar, VueProgressBarOptions)
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

Vue.component('pagination',require('./components/partial/PaginationComponent.vue').default)


const app = new Vue({
  el: '#app',
  router,
  data:{

    },
    methods:{



    }
});