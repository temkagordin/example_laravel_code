/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */
import Vue from 'vue';

require('./bootstrap');

window.Vue = Vue;

Vue.component('example', require('./components/Example'));

const app = new Vue({
    el: '#app'
});