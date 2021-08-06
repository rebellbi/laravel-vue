/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
window.axios = require('axios');
window.draggable = require('vuedraggable');
window.autoscroll = require('vue-autoscroll');

import { BootstrapVue, BootstrapVueIcons} from 'bootstrap-vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret, faArrowsAlt, faTimes, faThList} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)

library.add(faUserSecret, faTimes, faArrowsAlt, faThList)

Vue.component('font-awesome-icon', FontAwesomeIcon)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('user', require('./components/User.vue').default);
Vue.component('create', require('./components/Create.vue').default);
Vue.component('edit', require('./components/edit.vue').default);

Vue.component('todo', require('./components/todolist/Todo.vue').default);

Vue.component('loading', require('./components/loading/InfiniteLoading.vue').default);
Vue.component('upload-image', require('./components/UploadImage.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
