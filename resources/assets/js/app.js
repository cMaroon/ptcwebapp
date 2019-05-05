
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
import Admin from './components/AdminUsers'
import Instructor from './components/InstructorUsers'
import Students from './components/StudentUsers'
import ManageEnroll from './components/ManageEnrollment'
import ManageProgram from './components/ManageProgram'
import ManageCourses from './components/ManageCourses'
import ManageCurriculum from './components/ManageCurriculum'
import ManagaAssesstment from './components/ManageAssesstment'
import ManagaPayment from './components/ManagePayment'
import OtherSettings from './components/OtherSettings'

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
        component: Admin,
        
      },
      {
        path: '/admin/instructors',
        name: 'admin-instructors',
        component: Instructor,
        
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
      {
        path: '/admin/manage-courses',
        name: 'admin-managecourses',
        component: ManageCourses,
        
      },
      {
        path: '/admin/manage-curriculum',
        name: 'admin-managecurriculum',
        component: ManageCurriculum,
        
      },
      {
        path: '/admin/manage-assesstment',
        name: 'admin-manageassesstment',
        component: ManagaAssesstment,
        
      },
      {
        path: '/admin/manage-payment',
        name: 'admin-managepayment',
        component: ManagaPayment,
        
      },
      {
        path: '/admin/other-settings',
        name: 'admin-settings',
        component: OtherSettings,
        
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