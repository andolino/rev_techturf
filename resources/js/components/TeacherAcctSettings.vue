<template>
  <div>
    <form @submit.prevent="submitTeachersAcctSettings">
      <div class="row mt-5">
        <div class="col-lg-4 text-right">
          <img :src="asset + 'images/ellipse-4.png'" alt="">
          <div class="value">0</div>
          <input type="range" min="0" max="10" step="1" value="0">
        </div>
        <div class="col-lg-8"></div>
      </div>
      <!-- <div class="form-group input-group mb-0">
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
      </div> -->
      <!-- <button type="submit" class="btn btn-yellow font-14 text-center w-100 btn-cust-radius">Login</button> -->
      <input type="hidden" name="_token" v-bind:value="csrf">
    </form>
  </div>
</template>

<script>
    export default {
      name: "TeacherAcctSettings",
      props: [ 'base_url' ],
			data(){
				return{
					form: new Form({
						email: '',
						password: '',
					}),
          csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
          asset: document.querySelector('meta[name="url-asset"]').getAttribute('content')
				}
			},
			methods: {
				submitTeachersAcctSettings(){
					let data = new FormData();
					data.append('email', this.form.email)
					data.append('password', this.form.password)
					axios.post('/heygo/login/teachers', data).then((res) => {
						this.form.reset();
            if (typeof res.data.errors === 'undefined') {
              window.location.href = this.base_url + "/teachers";
            }
            this.form.errors.record(res.data.errors);
					}).catch((error) => {
						this.form.errors.record(error.response.data.errors);
					});
				},
			},
			mounted() { 
        var elem = document.querySelector('input[type="range"]');
        var rangeValue = function(){
          var newValue = elem.value;
          var target = document.querySelector('.value');
          target.innerHTML = newValue;
        }
        elem.addEventListener("input", rangeValue);
      },
	  }
</script>


