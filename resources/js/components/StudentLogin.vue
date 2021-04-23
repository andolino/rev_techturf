<template>
  <div>
    <h2 class="text-center pb-3 font-weight-bold">Login In</h2>
      <form @submit.prevent="loginStudents">
        <div class="form-group input-group mb-0">
            <input 
              type="email" 
              v-model="form.email" 
              :class="{'is-invalid' : form.errors.has('email')}" 
              class="form-control text-center input-custom font-14 mb-3" 
              id="student-email" 
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
              id="student-password" 
              name="password" 
              placeholder="Password">
        </div>
        <p class="text-danger text-center" v-if="form.errors.has('password')" v-text="form.errors.get('password')"></p>
        <div class="form-group row">
          <div class="col-md-6 offset-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" v-model="form.remember" name="remember" id="remember">
              <label class="form-check-label" for="remember">
                  Remember Me
              </label>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-yellow font-14 text-center w-100 btn-cust-radius">Login</button>
        <input type="hidden" name="_token" v-bind:value="csrf">
      </form>
      <small id="emailHelp" class="form-text text-center text-muted">By clicking Sign Up, you agree to Preply's Terms of Service and Privacy Policy</small>
    </div>
</template>

<script>
    export default {
      name: "StudentLogin",
      props: [ 'base_url' ],
			data(){
				return{
					form: new Form({
						email: '',
						password: '',
					}),
          csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				}
			},
			methods: {
				loginStudents(){
					let data = new FormData();
					data.append('email', this.form.email)
					data.append('password', this.form.password)
					axios.post('/heygo/login/students', data).then((res) => {
						this.form.reset();
            if (typeof res.data.errors === 'undefined') {
              window.location.href = this.base_url + "/students";
            }
            this.form.errors.record(res.data.errors);
					}).catch((error) => {
						this.form.errors.record(error.response.data.errors);
					});
				},
			},
			mounted() { },
	  }
</script>
