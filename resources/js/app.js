/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
import Form from './Form'
import HomeSlider from './components/HomeSlider.vue';
import AvailableLesson from './components/AvailableLesson.vue';
import SignupFormTeacher from './components/SignupFormTeacher.vue';
import SignupFormStudent from './components/SignupFormStudent.vue';
import TeacherAcctSettings from './components/TeacherAcctSettings.vue';
import TeacherFeeds from './components/TeacherFeeds.vue';
import FetchFeeds from './components/FetchFeeds.vue';
import { BootstrapVue, IconsPlugin, BCard } from 'bootstrap-vue';

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

window.Form = Form

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.component('BCard', BCard)
Vue.component('todo-component', require('./components/TodoComponent.vue').default );
// Vue.component('b-carousel', '');




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
	el: '#app',
	components: {
		// 'todo-component':
		'home-slider'						: HomeSlider,
		'available-lesson' 			: AvailableLesson,
		'signup-form-teacher'   : SignupFormTeacher,
		'signup-form-student'   : SignupFormStudent,
		'teacher-acct-settings' : TeacherAcctSettings,
		'teacher-feeds'					: TeacherFeeds,
		'fetch-feeds'						: FetchFeeds
	}
});



