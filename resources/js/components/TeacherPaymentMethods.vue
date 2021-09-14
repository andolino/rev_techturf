<template>
  <div>
    <div class="row pl-5 pr-5 cont-payment-methods pt-3">
      <div class="col-lg-12 mb-2">
        <button type="button" class="btn w-100 text-left p-3"><img :src="asset + 'images/spay.png'" alt=""></button>
      </div>
      <!-- <div class="col-lg-12 mb-2">
        <button type="button" class="btn w-100 text-left p-3"><img :src="asset + 'images/apay.png'" alt=""></button>
      </div> -->
      <!-- <div class="col-lg-12 mb-3">
        <button type="button" class="btn w-100 text-left p-3"><img :src="asset + 'images/ppay.png'"></button>
      </div> -->
      <!-- <div class="col-lg-12">
        <hr>
      </div>
      <div class="col-lg-4 mb-3 pr-0">
        <button type="button" class="btn w-100 text-left font-12 p-2 rounded-0">Eastwest <br> **** **** **** *015</button>
      </div>
      <div class="col-lg-4 mb-3 pr-0">
        <button type="button" class="btn w-100 text-left font-12 p-2 rounded-0">Account 2 <br> Bpi</button>
      </div>
      <div class="col-lg-4 mb-3 pr-0">
        <button type="button" class="btn w-100 text-left p-2 rounded-0 font-12 h-100" v-on:click="showFrm = !showFrm">+ Add Account</button>
      </div> -->
      
    </div>
    <form >
      <!-- <b-form-group>
        <b-form-input v-model="formStudentPayment.student_name" placeholder="Student Name"></b-form-input>
      </b-form-group>
      <b-form-group>
        <b-form-input v-model="formStudentPayment.student_email" placeholder="Student Email"></b-form-input>
      </b-form-group>
      <b-form-group>
        <b-form-input v-model="formStudentPayment.amount" placeholder="Amount"></b-form-input>
      </b-form-group> -->
      
    </form>
    <!-- @submit.prevent="submitStudentBankAccouts" -->
    <form @submit.prevent="submitStudentPayment">
      <div class="frm-add-bnk-acct" v-if="showFrm">
        <div class="row mt-3">
          <div class="col-lg-2"></div>
          <div class="col-lg-8">
            <div class="cont-form-card">
                <div class="form-group">
                  <label for="" class="font-14">Card Holder Name</label>
                  <input type="text" 
                        v-model="form.account_name" 
                        :class="{'is-invalid' : form.errors.has('account_name')}" 
                        class="form-control text-center input-custom font-14 mb-3" 
                        name="account_name">
                </div>
                <div class="form-group">
                  <label for="" class="font-14">Card Holder Email</label>
                  <input type="text" 
                        v-model="form.email" 
                        :class="{'is-invalid' : form.errors.has('email')}" 
                        class="form-control text-center input-custom font-14 mb-3" 
                        name="email">
                </div>
                <!-- <div class="form-group">
                  <label for="" class="font-14">Card Number</label>
                  <input type="text" 
                        v-model="form.card_number" 
                        :class="{'is-invalid' : form.errors.has('card_number')}" 
                        class="form-control text-center input-custom font-14 mb-3" 
                        name="card_number">
                </div> -->
                <!-- <div class="row">
                  <div class="col-lg-6">
                    <label for="" class="font-14">Expiry Date</label>
                    <input type="text" 
                          v-model="form.expiry_date" 
                          :class="{'is-invalid' : form.errors.has('expiry_date')}" 
                          class="form-control text-center input-custom font-14 mb-3" 
                          name="expiry_date">
                  </div>
                  <div class="col-lg-6">
                    <label for="" class="font-14">CVV Code</label>
                    <input type="text" 
                          v-model="form.cvv_code" 
                          :class="{'is-invalid' : form.errors.has('cvv_code')}" 
                          class="form-control text-center input-custom font-14 mb-3" 
                          name="cvv_code">
                  </div>
                </div> -->
                <!-- <div class="form-group">
                  <label for="" class="font-14">Add Card Name</label>
                  <input type="text" 
                        v-model="form.card_name" 
                        :class="{'is-invalid' : form.errors.has('card_name')}" 
                        class="form-control text-center input-custom font-14 mb-3" 
                        name="card_name">
                </div> -->
            </div>

            <div ref="card" id="stripe_card"></div>
            <b-button ref="submitStudPayFrm" class="d-none" type="submit">Submit</b-button>

          </div>
          <div class="col-lg-2"></div>
        </div>
        <div class="row mt-3 mb-3">
          <div class="col-lg-5"></div>
          <div class="col-lg-2">

            
            <button type="button" v-on:click="submitTeacherPayment" class="btn btn-default btn-md font-14 w-100 p-2">Update</button>
          </div>
          <div class="col-lg-5"></div>
        </div>
      </div>
    </form>


  </div>
</template>



<script>
    var stripe = Stripe(`${process.env.MIX_STRIPE_KEY}`);
    var elements = stripe.elements();
    var stripe_style = {
      base: {
        color: "#32325d",
        fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: "16px", 
        "::placeholder": {
          color: "#aab7c4",
        }
      },
      invalid:{
        color: "#fa755a",
        iconColor: "#fa755a"
      }
    };
    var card = undefined;


    export default {
      name: "TeacherPaymentMethods",
      props: [ 'base_url' ],
			data(){
				return{
          showFrm: true,
					form: new Form({
            account_name : '',
            card_number : '',
            expiry_date : '',
            email:'',
            cvv_code : ''
					}),
          csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
          asset: document.querySelector('meta[name="url-asset"]').getAttribute('content'),
          user_id: document.querySelector('meta[name="user-id"]').getAttribute('content')
				}
			},
			methods: {
      	fetchAllBankAccount(){
          axios.post('/heygo/get-bank-acct-per-student', data).then((res) => {
            // if (typeof res.data.errors === 'undefined') {
            //   window.location.reload();
            // }

					}).catch((error) => {
            console.log(error);
						this.form.errors.record(error.response.data.errors);
					});
        },
      	submitStudentBankAccouts(){
					let data = new FormData();
					data.append('account_name', this.form.account_name);
					data.append('card_number', this.form.card_number);
					data.append('expiry_date', this.form.expiry_date);
					data.append('cvv_code', this.form.cvv_code);
					data.append('card_name', this.form.card_name);
					data.append('user_id', this.user_id);
					data.append('_token', this.csrf);
					axios.post('/heygo/save-student-bank-acct', data).then((res) => {
            // if (typeof res.data.errors === 'undefined') {
            //   window.location.reload();
            // }

					}).catch((error) => {
            console.log(error);
						this.form.errors.record(error.response.data.errors);
					});
				},
        submitStudentPayment: function (e) {
          stripe.createToken(card).then(result=>{
            if (result.error) {
              console.log('error happend when getting token');
            } else {
              this.handlePaymentToken(result.token);
            }
          });
        },
        handlePaymentToken(token){
          Swal.fire({
            title: 'Are you sure?',
            text: "You are updating your wallet",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fcb017',
            cancelButtonColor: '#212222',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Wait',
          }).then((result) => {
            if (result.isConfirmed) {
              axios.post('api/teacher-create-stripe', { 
                'account_name': this.form.account_name,
                'email': this.form.email,
                'teachers_id': this.user_id
               }).then((res)=>{
                console.log(res);
              }).catch((err)=>console.log(err));
            } 
            // else {
            // }
          });
        },
        showPaymentSection(){
          // if (t == 'next') {
          //   this.showStepper3 = !this.showStepper3; 
          //   this.showStepper4 = !this.showStepper4;
          // } else {
          //   this.showStepper4 = !this.showStepper4; 
          //   this.showStepper5 = !this.showStepper5;
          // }
          card = elements.create('card', {
            style: stripe_style,
            hidePostalCode: true
          });
          /**
           * element need to exists on the page before calling mount().
           */
          setTimeout(function(){
            card.mount("#stripe_card");
          }, 500);
        },
        submitTeacherPayment(){
          this.$refs.submitStudPayFrm.click();
          // if (t == 'next') {
          //   this.$refs.submitStudPayFrm.click();
          // } else {
          //   //previous
          //   setTimeout(function(){
          //     card.destroy("#stripe_card");
          //   }, 500);
          //   this.showStepper3 = !this.showStepper3;
          //   this.showStepper4 = !this.showStepper4;
          // }
          
        }
			},
			mounted() { 
        // this.getCountries();
        // this.getStudentsData();
        this.showPaymentSection();
      }
	  }
</script>


<style>
.cont-payment-methods hr{
  border-top: 2px solid rgba(0, 0, 0, 0.24);
}
.cont-payment-methods{
  width: 80%;
  margin: auto !important;
}
.cont-payment-methods button {
  background: #ddd;
  display: block;
  padding: 23px;
  border-radius: 20px;
}
</style>