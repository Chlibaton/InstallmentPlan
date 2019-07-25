
import Vue from 'vue';
import Vuetify from 'vuetify'
import VueRouter from 'vue-router'
import VeeValidate from 'vee-validate';

import 'vuetify/dist/vuetify.min.css';

import routers from './route';

require('./bootstrap');

Vue.use(Vuetify);
Vue.use(VueRouter);
Vue.use(VeeValidate);

window.Vue = require('vue');


Vue.component('sidepanel-component', require('./components/AdminDashboard/SidePanelComponent.vue').default);
Vue.component('home-component', require('./components/Landing/HomeComponent.vue').default);


const vuetifyOptions = {}  

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(vuetifyOptions),
    router: new VueRouter(routers)
});

