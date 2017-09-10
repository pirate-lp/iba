require('./bootstrap');

var Vue = require('vue');
Vue.config.productionTip = false

import axiosApp from './configs/axios';

// axios.defaults.baseURL = process.env.APP_URL

Vue.prototype.$http = axiosApp;

import App from './App'

/*
var router = new VueRouter({
    history: true,
    root: 'dashboard'
})
*/

// import N3Components from 'N3-components'

// install N3
// Vue.use(N3Components)

// for English  (default chinese)
// version 2.2.0 or later
// Vue.use(N3Components, 'en')

/* eslint-disable no-new */

import router from './router.js'

import auth from './auth'
auth.checkAuth()
console.log(auth.user.authenticated)

const iba = new Vue({
	el: '#app',
	router,
	template: '<App/>',
	components: { App },
})