<template>
  <div>
    <form @submit.prevent="submitStudentsAcctSettings">
      <div class="row mt-5">
        <div class="col-lg-5 text-center">
          <img :src="asset + 'images/ellipse-1.png'" alt="">
            
        </div>

        <div class="col-lg-5 offset-lg-1">
          <div class="m-auto">
            <label for="" class="text-left w-100">First Name</label>
            <div class="form-group input-group mb-0">
                <input 
                  type="text" 
                  v-model="form.firstname" 
                  :class="{'is-invalid' : form.errors.has('firstname')}" 
                  class="form-control text-center input-custom font-14 mb-3" 
                  id="firstname" 
                  name="firstname">
            </div>
            <p class="text-danger text-center" v-if="form.errors.has('firstname')" v-text="form.errors.get('firstname')"></p>

            <label for="" class="text-left w-100">Last Name</label>
            <div class="form-group input-group mb-0">
                <input 
                  type="text" 
                  v-model="form.lastname" 
                  :class="{'is-invalid' : form.errors.has('lastname')}" 
                  class="form-control text-center input-custom font-14 mb-3" 
                  id="lastname" 
                  name="lastname">
            </div>
            <p class="text-danger text-center" v-if="form.errors.has('lastname')" v-text="form.errors.get('lastname')"></p>

            <label for="" class="text-left w-100">Contact</label>
            <div class="form-group input-group mb-0">
                <input 
                  type="text" 
                  v-model="form.contact_no" 
                  :class="{'is-invalid' : form.errors.has('contact_no')}" 
                  class="form-control text-center input-custom font-14 mb-3" 
                  id="contact_no" 
                  name="contact_no">
            </div>
            <p class="text-danger text-center" v-if="form.errors.has('contact_no')" v-text="form.errors.get('contact_no')"></p>

            <label for="" class="text-left w-100">Country</label>
            <div class="form-group input-group mb-0">
                  <select name="country_id" 
                          id="country_id" 
                          :class="[{'is-invalid' : form.errors.has('country_id')}, selectCountryClass]" 
                          v-model="form.country_id" 
                          :required="true">
                          <option 
                            :value="t.id"
                            v-for="(t, i) in countries" 
                            :key="i">{{ t.country_name }}</option>
                  </select>
            </div>
            
            <label for="" class="text-left w-100">Email Address</label>
            <div class="form-group input-group mb-0">
                <input 
                  type="text" 
                  v-model="form.email" 
                  :class="{'is-invalid' : form.errors.has('email')}" 
                  class="form-control text-center input-custom font-14 mb-3" 
                  id="email" 
                  name="email">
            </div>
            <p class="text-danger text-center mb-3" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></p>

            <label for="" class="text-left w-100">Abount Me</label>
            <div class="form-group input-group mb-0">
                <textarea 
                  id="about_me" 
                  name="about_me" 
                  v-model="form.about_me" 
                  class="form-control input-custom font-14 mb-3"
                  :class="{'is-invalid' : form.errors.has('about_me')}" 
                  cols="30" rows="10"></textarea>
            </div>
            <p class="text-danger text-center mb-3" v-if="form.errors.has('about_me')" v-text="form.errors.get('about_me')"></p>

            <p class="text-danger text-center" v-if="form.errors.has('country_id')" v-text="form.errors.get('country_id')"></p>
            
          </div>
        </div>
        <div class="col-lg-5 offset-lg-6">
          <button type="submit" class="btn btn-default font-14 float-right text-center btn-cust-radius pr-4 pl-4 mt-4 mb-4">Okay</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
    export default {
      name: "StudentsAcctSettings",
      props: [ 'base_url' ],
			data(){
				return{
          // selected: 'Selected Country',
          selectCountryClass: 'w-100 input-custom font-14 pb-2 pr-2 pt-2 mb-3',
          countries: [],
          studentsData: [],
					form: new Form({
            firstname: '',
            lastname: '',
            contact_no: '',
            country_id: '',
            email: '',
            about_me: '',
					}),
          csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
          asset: document.querySelector('meta[name="url-asset"]').getAttribute('content'),
          user_id: document.querySelector('meta[name="user-id"]').getAttribute('content')
				}
			},
			methods: {
        getCountries(){
          axios.get('/heygo/get-countries', {}).then((res) => {
            this.countries = res.data;
          }).catch((error) => {});
        },
        getStudentsData(){
          axios.post('/heygo/get-students-details', { 'user_id': this.user_id }).then((res) => {
            this.form.firstname = res.data[0].firstname;
            this.form.lastname = res.data[0].lastname;
            this.form.contact_no = res.data[0].contact_no;
            this.form.country_id = res.data[0].country_id;
            this.form.email = res.data[0].email;
            this.form.about_me = res.data[0].about_me;
          }).catch((error) => {});
        },
				submitStudentsAcctSettings(){
					let data = new FormData();
					data.append('firstname', this.form.firstname);
					data.append('lastname', this.form.lastname);
					data.append('contact_no', this.form.contact_no);
					data.append('country_id', this.form.country_id);
					data.append('email', this.form.email);
					data.append('about_me', this.form.about_me);
					data.append('user_id', this.user_id);
					data.append('_token', this.csrf);
					axios.post('/heygo/update-student-settings', data).then((res) => {
            if (typeof res.data.errors === 'undefined') {
              window.location.reload();
            }
					}).catch((error) => {
            console.log(error);
						this.form.errors.record(error.response.data.errors);
					});
				},
			},
			mounted() { 
        this.getCountries();
        this.getStudentsData();
      }
	  }
</script>



<style>
  .value {
    border-bottom: 4px dashed #bdc3c7;
    text-align: center;
    font-weight: bold;
    font-size: 20px;
    width: 174px;
    height: 35px;
    margin: -4px auto;
    letter-spacing: -.07em;
    text-shadow: white 2px 2px 2px;
  }
  input[type="range"] {
    display: block;
    -webkit-appearance: none;
    background-color: #bdc3c7;
    width: 174px;
    height: 5px;
    border-radius: 5px;
    margin: 0 auto;
    outline: 0;
  }
  input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    background-color: #e74c3c;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 2px solid white;
    cursor: pointer;
    transition: .3s ease-in-out;
  }​
  input[type="range"]::-webkit-slider-thumb:hover {
    background-color: white;
    border: 2px solid #e74c3c;
  }
  input[type="range"]::-webkit-slider-thumb:active {
    transform: scale(1.6);
  }

  /* checkbox switch */
  .switch {
    position: relative;
    display: inline-block;
    width: 90px;
    height: 34px;
  }

  .switch input {display:none;}

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ca2222;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 8px;
    bottom: 6px;
    background-color: white;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #2ab934;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(55px);
    -ms-transform: translateX(55px);
    transform: translateX(55px);
  }

  /*------ ADDED CSS ---------*/
  .on
  {
    display: none;
  }

  .on, .off
  {
    color: white;
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    font-size: 10px;
    font-family: Verdana, sans-serif;
  }

  input:checked+ .slider .on
  {display: block;}

  input:checked + .slider .off
  {display: none;}

  /*--------- END --------*/

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;}

  .row.up-trial-ctrl {
    background: #eaeaea;
    margin: 20px;
    border-radius: 19px;
    text-align: left;
  }
</style>
