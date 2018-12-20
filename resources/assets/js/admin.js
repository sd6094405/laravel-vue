
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
import Admin from './Admin.vue'
import VueRouter from 'vue-router'
import router from './router/admin.js'
import mavonEditor from 'mavon-editor'
import 'mavon-editor/dist/css/index.css'
import './my-theme/index.less';
import iView from 'iview';
import 'iview/dist/styles/iview.css';
window.Vue = require('vue');
//use
Vue.use(mavonEditor);
Vue.use(iView);
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    // el: '#app',
    router,
    render: (h) => h(Admin)
}).$mount('#app');