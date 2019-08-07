
import Vue from 'vue';
import Vuex from 'vuex'
import BootstrapVue from 'bootstrap-vue'
import Vuetify from 'vuetify'
import VueRouter from 'vue-router'
import VeeValidate from 'vee-validate';
import VueAxios from 'vue-axios'
import axios from 'axios';
import VueMask from 'v-mask'

import 'vuetify/dist/vuetify.min.css';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import routers from './route';

require('./bootstrap');

Vue.use(Vuetify);
Vue.use(BootstrapVue)
Vue.use(VueAxios, axios)
Vue.use(VueRouter);
Vue.use(VeeValidate);
Vue.use(VueMask);

window.Vue = require('vue');



Vue.component('sidepanel-component', require('./components/AdminDashboard/SidePanelComponent.vue').default);
Vue.component('superadmin-component', require('./components/AdminDashboard/SuperAdminComponent.vue').default);
Vue.component('usertracking-component', require('./components/UserSide/UserTrackingComponent.vue').default);

Vue.component('home-component', require('./components/Landing/HomeComponent.vue').default);


const vuetifyOptions = {}  

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(vuetifyOptions),
    router: new VueRouter(routers)
});

