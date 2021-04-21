<template>
	<div >
		<div v-if="showFormSignUp">
			<h2 class="text-center pb-3 font-weight-bold">Sign Up</h2>
			<form @submit.prevent="signupTeachers">
				<div class="form-group input-group mb-0">
						<input 
							type="email" 
							v-model="form.email" 
							:class="{'is-invalid' : form.errors.has('email')}" 
							class="form-control text-center input-custom font-14 mb-3" 
							id="teacher-email" 
							name="email" 
							placeholder="Email">
				</div>
				<p class="text-danger text-center" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></p>
				<div class="form-group input-group mb-0">
						<input 
							type="password" 
							v-model="form.password"
							:class="{'is-invalid' : form.errors.has('password')}" 
							class="form-control text-center input-custom font-14 mb-3" 
							id="teacher-password" 
							name="password" 
							placeholder="Create Password">
				</div>
				<p class="text-danger text-center" v-if="form.errors.has('password')" v-text="form.errors.get('password')"></p>
				
				<button type="submit" class="btn btn-yellow font-14 text-center w-100 btn-cust-radius">Sign Up</button>
				<input type="hidden" name="_token" v-bind:value="csrf">
			</form>

			<small id="emailHelp" class="form-text text-center text-muted">Bys clicking Sign Up, you agree to Preply's Terms of Service and Privacy Policy</small>
			<p class="text-center mt-3">Already have an account? <a href="javascript:void(0);" @click="showTeacherLogin" class="text-warning">Login</a></p>
		</div>
		<div v-if="showFormLogin">
			<TeacherLogin :base_url="base_url"/>
			<p class="text-center mt-3">Create an account? <a href="javascript:void(0);" @click="showTeacherSignUp" class="text-warning">Signup</a></p>
		</div>
	</div>
</template>

<script>
		import TeacherLogin from './TeacherLogin';
    export default {
			name: "SignupFormTeacher",
			props: [ 'base_url' ],
			components: {
				TeacherLogin
			},
			data(){
				return {
					form: new Form({
						email: '',
						password: '',
					}),
					showFormSignUp : true,
					showFormLogin : false,
					csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				}
			},
			methods: {
				signupTeachers(){
					let data = new FormData();
					data.append('email', this.form.email)
					data.append('password', this.form.password)
					axios.post('/heygo/api/register/teachers', data).then(() => {
						this.form.reset();
					}).catch((error) => {
						this.form.errors.record(error.response.data.errors);
					});
				},
				showTeacherLogin(){
					this.showFormSignUp = !this.showFormSignUp;
					this.showFormLogin = !this.showFormLogin;
				},
				showTeacherSignUp(){
					this.showFormSignUp = !this.showFormSignUp;
					this.showFormLogin = !this.showFormLogin;
				},
			},
			mounted() { },
	  }
</script>
