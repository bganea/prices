/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.http = require('vue-resource').Http;
Vue.config.devtools = true

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.filter('toCurrency', function (value) {
	Number.prototype.formatMoney = function (n, x, s, c) {
		var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
			num = this.toFixed(Math.max(0, ~~n));
		
		return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
	};
	return Number(value).formatMoney(2, 3, " ", ".") + " RON";
});

import VueRouter from "vue-router"
Vue.use(VueRouter);

import App from "./components/App"
import Prices from "./components/Prices"
import Products from "./components/Products"

const router = new VueRouter({
	mode:'history',
	routes:[
		{
			path:'/',
			name:'products',
			component:Products
		},
		{
			path:'/prices/*',
			name:'prices',
			component:Prices
		},
	]
});

const app = new Vue({
	el: '#app',
	components: {
		App
	},
	router
});
