
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Form = Form

import Vue from 'vue'
import { Form, HasError, AlertError, AlertErrors, AlertSuccess } from 'vform'
import VueRouter from 'vue-router'
import VueProgressBar from 'vue-progressbar'
import Snotify, { SnotifyPosition} from 'vue-snotify'
import Dashboard from './components/Dashboard'
import Users from './components/AdminUsers'
import Students from './components/StudentUsers'
import ManageEnroll from './components/ManageEnrollment'
import ManageProgram from './components/ManageProgram'

Vue.use(Snotify, SnotifyOptions, SnotifyPosition)
Vue.use(VueProgressBar, VueProgressBarOptions)
Vue.use(VueRouter)

const SnotifyOptions = {
  toast: {
    position: SnotifyPosition.rightTop,
  }
}

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

const router = new VueRouter({
  mode: 'history',
  routes: [
      {
          path: '/admin/dashboard',
          name: 'admin-dashboard',
          component: Dashboard,
          
      },
      {
        path: '/admin/adminusers',
        name: 'admin-users',
        component: Users,
        
      },
      {
        path: '/admin/studentusers',
        name: 'admin-studentlist',
        component: Students,
        
      },
      {
        path: '/admin/manage-enrollment',
        name: 'admin-managenroll',
        component: ManageEnroll,
        
      },
      {
        path: '/admin/manage-program',
        name: 'admin-manageprogram',
        component: ManageProgram,
        
      },

  ],
});

Vue.component('pagination',require('./components/partial/PaginationComponent.vue').default)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(AlertSuccess.name, AlertSuccess)


const app = new Vue({
  el: '#app',
  router,
  data:{

    },
    methods:{



    }
});