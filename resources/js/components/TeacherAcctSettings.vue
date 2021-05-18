<template>
  <div>
    <form @submit.prevent="submitTeachersAcctSettings">
      <div class="row mt-5">
        <div class="col-lg-5 text-center">
          <img :src="asset + 'images/ellipse-4.png'" alt="">
            <div class="row up-trial-ctrl p-4">
              <div class="col-lg-12">
                <label for="">Free Trial</label>
              </div>
              <div class="col-lg-12">
                <label for="" class="font-12">30 Minutes Free Lesson</label>
              </div>
              <div class="col-lg-12">
                <label class="switch">
                  <input type="checkbox" id="togBtn">
                  <div class="slider round">
                    <!--ADDED HTML -->
                    <span class="on">Yes</span>
                    <span class="off">No</span>
                    <!--END-->
                  </div>
                </label>
              </div>
              <div class="col-lg-12">
                <label for="" class="font-12">Lorem ipsum dolor, sit</label>
              </div>
              <div class="col-lg-12">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                  <label class="form-check-label font-12" for="inlineRadio1">Free</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                  <label class="form-check-label font-12" for="inlineRadio2">50% Hourly Rate</label>
                </div>
              </div>
            </div>
            <div class="row up-trial-ctrl p-4">
              <div class="col-lg-12">
                <label class="font-12">Student Age Preference</label>
                <div class="value">5</div>
                <input 
                  type="range" 
                  min="0" 
                  max="10" 
                  step="0" 
                  value="5" 
                  name="age_pref"
                  v-model="form.age_pref">
              </div>
            </div>
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

            <label for="" class="text-left w-100">Location</label>
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
            <p class="text-danger text-center" v-if="form.errors.has('country_id')" v-text="form.errors.get('country_id')"></p>

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

            <label for="" class="text-left w-100">Objective Title</label>
            <div class="form-group input-group mb-0">
                <input 
                  type="text" 
                  v-model="form.objective_title" 
                  :class="{'is-invalid' : form.errors.has('objective_title')}" 
                  class="form-control text-center input-custom font-14 mb-3" 
                  id="objective_title" 
                  name="objective_title">
            </div>
            <p class="text-danger text-center mb-3" v-if="form.errors.has('objective_title')" v-text="form.errors.get('objective_title')"></p>
            
            
          </div>
        </div>
        <div class="col-lg-5 offset-lg-6">
            <label for="" class="text-left w-100">Objective Description</label>
            <div class="form-group input-group mb-0">
                <textarea 
                  id="objective_text" 
                  name="objective_text" 
                  v-model="form.objective_text" 
                  class="form-control input-custom font-14 mb-3"
                  :class="{'is-invalid' : form.errors.has('objective_text')}" 
                  cols="30" rows="10"></textarea>
            </div>
            <p class="text-danger text-center mb-3" v-if="form.errors.has('objective_text')" v-text="form.errors.get('objective_text')"></p>
            
            <button type="submit" class="btn btn-default font-14 float-right text-center btn-cust-radius pr-4 pl-4 mt-4 mb-4">Okay</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
    export default {
      name: "TeacherAcctSettings",
      props: [ 'base_url' ],
			data(){
				return{
          // selected: 'Selected Country',
          selectCountryClass: 'w-100 input-custom font-14 pb-2 pr-2 pt-2 mb-3',
          countries: [],
          teachersData: [],
					form: new Form({
            firstname: '',
            lastname: '',
            contact_no: '',
            country_id: '',
            email: '',
            objective_title: '',
            objective_text: ''
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
        getTeachersData(){
          axios.post('/heygo/get-teachers-details', { 'user_id': this.user_id }).then((res) => {
            this.form.firstname = res.data[0].firstname;
            this.form.lastname = res.data[0].lastname;
            this.form.contact_no = res.data[0].contact_no;
            this.form.country_id = res.data[0].country_id;
            this.form.email = res.data[0].email;
            this.form.objective_title = res.data[0].objective_title;
            this.form.objective_text = res.data[0].objective_text;
          }).catch((error) => {});
        },
				submitTeachersAcctSettings(){
					let data = new FormData();
					data.append('firstname', this.form.firstname);
					data.append('lastname', this.form.lastname);
					data.append('contact_no', this.form.contact_no);
					data.append('country_id', this.form.country_id);
					data.append('email', this.form.email);
					data.append('objective_title', this.form.objective_title);
					data.append('objective_text', this.form.objective_text);
					data.append('user_id', this.user_id);
					data.append('_token', this.csrf);
					axios.post('/heygo/update-teacher-settings', data).then((res) => {
            if (typeof res.data.errors === 'undefined') {
              window.location.href = this.base_url + "/teachers-account-settings";
            }
					}).catch((error) => {
            console.log(error);
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
        this.getCountries();
        this.getTeachersData();
      },
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