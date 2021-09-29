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
import StudentAcctSettings from './components/StudentAcctSettings.vue';
import TeacherFeeds from './components/TeacherFeeds.vue';
import FetchFeeds from './components/FetchFeeds.vue';
import TeachersProfile from './components/TeachersProfile.vue';
import StudentHomework from './components/StudentHomework.vue';
import StudentPaymentMethods from './components/StudentPaymentMethods.vue';
import TeacherPaymentMethods from './components/TeacherPaymentMethods.vue';
import TeacherUpcomingLesson from './components/TeacherUpcomingLesson.vue';
import StudentUpcomingLesson from './components/StudentUpcomingLesson.vue';
import TeachersNotifications from './components/TeachersNotifications.vue';
import TeachersLibrary from './components/TeachersLibrary.vue';
import TeachersCalendar from './components/TeachersCalendar.vue';
import TeachersPurchaseHistory from './components/TeachersPurchaseHistory.vue';
import { BootstrapVue, IconsPlugin, BCard } from 'bootstrap-vue';
import VueSweetalert2 from 'vue-sweetalert2';
import swal from 'sweetalert2';


// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

//view dropzone
import 'vue2-dropzone/dist/vue2Dropzone.min.css'


window.Form = Form
window.Swal = swal

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
Vue.use(VueSweetalert2)
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
		'home-slider'							: HomeSlider,
		'available-lesson' 				: AvailableLesson,
		'signup-form-student'   	: SignupFormStudent,
		'signup-form-teacher'   	: SignupFormTeacher,
		'student-acct-settings' 	: StudentAcctSettings,
		'teacher-acct-settings' 	: TeacherAcctSettings,
		'fetch-feeds'							: FetchFeeds,
		'teacher-feeds'						: TeacherFeeds,
		'student-homework'				: StudentHomework,
		'teachers-profile'				: TeachersProfile,
		'student-payment-methods'	: StudentPaymentMethods,
		'teacher-payment-methods'	: TeacherPaymentMethods,
		'teacher-upcoming-lesson' : TeacherUpcomingLesson,
		'student-upcoming-lesson' : StudentUpcomingLesson,
		'teachers-notifications' 	: TeachersNotifications,
		'teachers-library' 			 	: TeachersLibrary,
		'teachers-calendar' 			: TeachersCalendar,
		'teachers-purchase-history' : TeachersPurchaseHistory
	}
});



