/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
import Vue from 'vue';
import App from './Admin.vue'
import VueRouter from 'vue-router'
import router from './router/admin.js'
import mavonEditor from 'mavon-editor'
import 'mavon-editor/dist/css/index.css'
import 'github-markdown-css'
import 'katex'
import element from 'element-ui';
import './static/css/icon.css';
import hljs from "highlight.js";
//是否生产模式
// Vue.config.productionTip = false;
Vue.directive('highlight', (el) => {
    let blocks = el.querySelectorAll('pre code')
    blocks.forEach((block) => {
        hljs.highlightBlock(block)
    })
})

window.Vue = require('vue');
//use
Vue.use(mavonEditor);
Vue.use(VueRouter);
Vue.use(element,{ size: 'small' });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    // el: '#app',
    router,
    render: (h) => h(App)
}).$mount('#app');