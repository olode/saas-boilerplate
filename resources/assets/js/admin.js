
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//load more lib here
// require('pace-progress');

//chartjs

window.Vue = require('vue').default;

var VueScrollTo = require('vue-scrollto');

Vue.use(VueScrollTo);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('data-table', require('./components/DataTable.vue').default);

const app = new Vue({
    el: '#app'
});

// Core UI js
require('./admin/core');
