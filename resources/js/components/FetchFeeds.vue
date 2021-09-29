<template>
  <div>
    <div v-for="dft in findtutor" :key="dft.id" class="mb-3">
      <div class="card rounded-11px">
        <div class="card-body mt-2">
          <div class="row">
            <div class="col-lg-2 text-center mt-3 pr-1">
              <img :src="asset + 'images/ellipse-1.png'" alt="">
            </div>
            <div class="col-lg-10">
              <div class="cicle-active"></div>
              <div class="row">
                <div class="col-lg-7">
                  <span class="ml-4" style="font-size: 23px;"> 
                    {{ dft.lastname.toUpperCase() }}, {{ dft.firstname.toUpperCase() }}</span>
                  <span class="ml-3">
                    <i class="fas fa-map-marker-alt text-warning p-2"></i>
                    <img :src="asset + 'images/flag-1.png'" width="20"></span>
                  <span class="ml-3">
                    <i class="fas fa-star text-warning p-2"></i>
                    <strong>4.5</strong></span>
                </div>
                <div class="col-lg-5">
                  <span class="ml-3" style="float: right;">
                    {{ dft.currency }} - {{ new Intl.NumberFormat().format(dft.rate_per_hr) }}
                  </span><br>
                  <span class="ml-3 font-12" style="float: right;line-height: 1.5;">
                    {{ dft.type }}
                  </span>
                </div>
              </div>
              
              <!-- <span class="ml-3">
                43 Reviews 
                <i class="fas fa-heart" style="color: rgb(217, 22, 132);"></i></span> -->
              
              <hr>
              <label for=""><strong>Speaks:</strong> English, Japanese</label><br>
              <label for=""><strong>About Me</strong></label>
              <p class="font-14">{{ dft.objective_text  }}</p>
              <div class="row">
                <div class="col-lg-3">
                  <h6><strong>Earned Badge</strong></h6>
                  <img :src="asset + 'images/badge.png'" width="35">
                  <img :src="asset + 'images/badge.png'" width="35">
                  <img :src="asset + 'images/badge.png'" width="35">
                </div>
                <div class="col-lg-9 mt-4">
                  <button class="btn btn-default font-12 float-right text-center ml-3 btn-dashboard" 
                    @click="fnBookATrial(dft.id)">
                    {{ hasTrial(dft.lesson_option_id) ? 'Book a Lesson' : 'Book a Trial' }}
                  </button>
                  <button 
                      class="btn btn-default font-12 float-right text-center btn-dashboard" 
                      @click="showTeacherProfile(dft.id)">
                    See Profile
                  </button>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <!-- <div class="card-footer">
          <div class="row cont-count-feeds">
            <div class="col-lg-1 text-right pl-1 pr-1 offset-lg-9 count-feeds-like">
              <i class="fas fa-heart"></i>
              <span class="font-12">100</span>
            </div>
            <div class="col-lg-1 text-center pl-1 pr-1 count-feeds-comment">
              <i class="fas fa-eye"></i>
              <span class="font-12">100</span>
            </div>
            <div class="col-lg-1 text-left pl-1 pr-1 count-feeds-dislikes">
              <i class="fas fa-minus-square"></i>
              <span class="font-12">100</span>
            </div>
          </div>
        </div> -->
      </div>
    </div>  

    <div class="modal fade bd-example-modal-lg" id="modalBookTrial" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> -->
          <div class="modal-body p-0">
            

            <!-- <section> -->
              <div class="rt-container row">
                <div class="col-lg-4 pr-0">
                  <div class="left-stepper-tab h-100">
                    <h5 for="" class="mb-5">Book Your Trial</h5>
                    <div class="step" :class="{ 'step-active' : showStepper1 }">
                      <div>
                        <div class="circle">&nbsp;</div>
                      </div>
                      <div>
                        <div class="title mt-0">Lesson Option</div>
                        <!-- <div class="caption">Optional</div> -->
                      </div>
                    </div>
                    <div class="step" :class="{ 'step-active' : showStepper2 }">
                      <div>
                        <div class="circle">&nbsp;</div>
                      </div>
                      <div>
                        <div class="title mt-0">Schedule</div>
                      </div>
                    </div>
                    <div class="step" :class="{ 'step-active' : showStepper3 }">
                      <div>
                        <div class="circle">&nbsp;</div>
                      </div>
                      <div>
                        <div class="title mt-0">Booking Information</div>
                      </div>
                    </div>
                    <div class="step" :class="{ 'step-active' : showStepper4 }">
                      <div>
                        <div class="circle">&nbsp;</div>
                      </div>
                      <div>
                        <div class="title mt-0">Choose Payment</div>
                      </div>
                    </div>
                    <div class="step" :class="{ 'step-active' : showStepper5 }">
                      <div>
                        <div class="circle">&nbsp;</div>
                      </div>
                      <div>
                        <div class="title mt-0">Done</div>
                      </div>
                    </div>

                  </div>
                </div>
                <transition name="fade">
                  <div class="col-lg-8 pl-0" v-if="showStepper1">
                    <div class="stepper-control">
                      <div class="btn-vertical btn-group-toggle" data-toggle="buttons">
                        <label v-for="lo in lessonOption" :key="lo.id" ref="sc_price" @click="getTitleLessonOpt(lo.title, lo.trial_lesson_rate, lo.id)" class="btn btn-light w-100 mb-2 p-3">
                          <input type="radio" v-model="formToSave.lesson_option_id" :value="lo.id" 
                            name="lesson-option" id="lesson-option" autocomplete="off" :disabled="lo.lesson_option_id == 1 && lo.trial_lesson_rate == 0"> 
                          <span class="trial_lesson_taked" v-if="lo.lesson_option_id == 1 && lo.trial_lesson_rate == 0">
                            <i class="fas fa-exclamation"></i> Sorry you've already used your trial lesson.
                          </span>
                          <span class="sc-title">{{ lo.title }}</span>
                          <span class="sc-sm-silent">{{ lo.lesson_count }} Lessons</span>
                          <span  class="sc-price" v-if="lo.id == 1 || lo.lesson_option_id == 1">
                            {{ ( lo.trial_lesson_rate == 0 
                                    ? 'Free'
                                    : lo.currency + ' ' + (rate_per_hr * (lo.trial_lesson_rate / 100)) ) }}
                          </span>
                          <span class="sc-price" v-else>
                            {{ lo.currency + ' ' + ( rate_per_hr || 0) }}
                          </span> 
                        </label>
                      </div>
                    </div>
                    <button type="button" 
                        class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                        v-on:click="showStepper1 = !showStepper1; 
                                    showStepper2 = !showStepper2;">Next</button>
                  </div>
                  <div class="col-lg-8 pl-0" v-if="showStepper2">
                    <div class="stepper-control">
                      <!-- <table class="table table-sm font-12">
                        <thead>
                          <tr>
                            <td class="text-center bg-calendar-hdr" v-for="dwc in dataWeekCalendar" :key="dwc.key">
                              {{ dwc.key }} <strong>{{ dwc.value }}</strong>
                            </td>
                          </tr>
                          <tr v-for="dta in dataTimaAvPerDay" :key="dta.time">
                            <td class="text-center clk-time" v-for="dwc in dataWeekCalendar" :key="dwc.key">
                              
                            </td>
                          </tr>
                        </thead>
                      </table> -->
                      <h5>Calendar</h5>
                      <b-row class="p-b bg-light text-center">
                        <b-col class="p-3" v-for="(dwc, i) in dataWeekCalendar" :key="i">
                          <label for="">{{ dwc.key }} <strong>{{ dwc.value }}</strong></label>
                          <b-row v-for="(dta, i2) in dataTimaAvPerDay" :key="i2">
                            <b-col class="border-1 font-12 pb-2" v-if="dta.w_date == dwc.w_date">
                              <button type="button" 
                                  class="btn btn-xs btn-radio-select "
                                  :class="{ 'active-time' : formToSave.lesson_date.some(d => d === dwc.w_date + ' ' + dta.time)}"
                                  :data-date="dwc.w_date + ' ' + dta.time"
                                  @click="selectTimePreferred" 
                                  v-if="dwc.w_date == dta.w_date">{{ dta.time }}</button>
                            </b-col>
                          </b-row>
                        </b-col>
                      </b-row>
                    </div>
                    <button type="button" 
                        class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                        v-on:click="chooseBookingDate">Next</button>
                    <button type="button" 
                        class="btn btn-default float-left btn-dashboard mb-3 font-14 stepper-prev"
                        v-on:click="showStepper1 = !showStepper1; 
                                    showStepper2 = !showStepper2;">Previous</button>
                  </div>
                  <div class="col-lg-8 pl-0" v-if="showStepper3">
                    <div class="stepper-control mb-5">

                      <div v-for="dft in teachersdata" :key="dft.id">
                        <div class="card rounded-11px">
                          <div class="card-body mt-2 ml-2">
                            <div class="row">
                              <div class="col-lg-2 text-center mt-3 pr-1">
                                <img :src="asset + 'images/ellipse-1.png'" alt="">
                              </div>
                              <div class="col-lg-10">
                                <div class="cicle-active"></div>
                                <span class="ml-4" style="font-size: 23px;"> {{ dft.lastname.toUpperCase() }}, {{ dft.firstname.toUpperCase() }}</span><br>
                                <span class="ml-0"><i class="fas fa-map-marker-alt text-warning pl-0 pr-2 text-left"></i><img :src="asset + 'images/flag-1.png'" width="20"></span>
                                <span class="ml-3"><i class="fas fa-star text-warning p-2"></i><strong>4.5</strong></span>
                                <span class="ml-3">43 Reviews <i class="fas fa-heart" style="color: rgb(217, 22, 132);"></i></span>
                                <hr class="mb-1">
                                
                                <label for="" class="w-100 font-14">Date and Time</label>
                                <p class="font-14 mb-0" v-for="fts in sorted_date" :key="fts">
                                  {{ moment(new Date(fts)).format('LLL') }}</p>
                                
                                <hr class="mb-1">
                                <div class="row font-14">
                                  <div class="col-lg-6 text-left">
                                    <label for="">Service Details</label>
                                    <p class="mb-1">{{ lessonOptTitle }} <br> Total Hour/s <br> Transaction Fee</p>
                                  </div>
                                  <div class="col-lg-6 text-right">
                                    <label for="">Service Details</label>
                                    <p class="mb-1" v-if="trialFree">0/hour <br> {{ totalHrs }} <br> {{ 0 }} JPY</p>
                                    <p class="mb-1" v-else>{{ (rate_per_hr || 0) }}/hour <br> {{ totalHrs }} <br> {{ procFee }} JPY</p>
                                  </div>
                                </div>
                                
                                <hr class="mb-1">
                                <div class="row font-14">
                                  <div class="col-lg-6 text-left">
                                    <label for="">TOTAL</label>
                                  </div>
                                  <div class="col-lg-6 text-right">
                                    <label for="" v-if="trialFree">0 JPY</label>
                                    <label for="" v-else>{{ (rate_per_hr || 0) * totalHrs + procFee }} JPY</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                    <button type="button" 
                        class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                        v-on:click="showPaymentSection('next')">Next</button>
                    <button type="button" 
                        class="btn btn-default float-left btn-dashboard mb-3 font-14 stepper-prev"
                        v-on:click="showStepper2 = !showStepper2; 
                                    showStepper3 = !showStepper3;">Previous</button>
                  </div>
                  <div class="col-lg-8 pl-0" v-if="showStepper4">
                    <div class="stepper-control">
                        <h4>Payment Method</h4>
                        <label class="mb-3 font-12">It's safe to pay on Preply All transactions are protected by SSL encryption.</label>
                        <div class="btn-vertical btn-group-toggle mb-5" data-toggle="buttons">
                          <!-- <label v-for="lo in lessonOption" :key="lo.id" v-on:click="getTitleLessonOpt(lo.title)" class="btn btn-light w-100 mb-2 p-3"> -->
                          <!-- <label class="btn btn-light w-100 mb-2 p-3">
                            <input type="radio" name="payment-method" autocomplete="off"> 
                            <span class="sc-title"><img :src="asset + 'images/gpay.png'" alt=""></span>
                            <span class="sc-price"></span>
                          </label>
                          <label class="btn btn-light w-100 mb-2 p-3">
                            <input type="radio" name="payment-method" autocomplete="off"> 
                            <span class="sc-title"><img :src="asset + 'images/apay.png'" alt=""></span>
                            <span class="sc-price"></span>
                          </label> -->
                          <div class="row">
                            <div class="col-lg-12">
                              <label for="">Booking Payment Summary</label>
                              <table class="table w-100 font-12 font-weight-strong">
                                <tr>
                                  <td><strong>BOOKED DETAILS</strong></td>
                                  <td class="text-right">{{ lessonOptTitle }} {{ totalHrs }}/s </td>
                                </tr>
                                <tr>
                                  <td><strong>RATE PER HR</strong></td>
                                  <td class="text-right" v-if="trialFree">0 </td>
                                  <td class="text-right" v-else>{{ rate_per_hr }} </td>
                                </tr>
                                <tr>
                                  <td><strong>SERVICE CHARGE</strong></td>
                                  <td class="text-right" v-if="trialFree">0 JPY</td>
                                  <td class="text-right" v-else>{{ procFee }} JPY</td>
                                </tr>
                                <tr>
                                  <td><strong>TOTAL AMOUNT TO PAY</strong></td>
                                  <td class="text-right" v-if="trialFree">0</td>
                                  <td class="text-right" v-else>{{ (rate_per_hr || 0) * totalHrs + procFee }}</td>
                                </tr>
                              </table>
                            </div>
                          </div>
                          <label class="btn btn-light w-100 mb-2 p-3" v-if="trialFree == false">
                            <input type="radio" name="payment-method" autocomplete="off"> 
                            <span class="sc-title"><span style="font-size: 14px;">Pay Debit/Credit Card with</span> <img :src="asset + 'images/spay.png'" alt=""></span>
                            <span class="sc-price"></span>
                          </label>
                          
                          <form @submit.prevent="submitStudentPayment">
                            <!-- <b-form-group>
                              <b-form-input v-model="formStudentPayment.student_name" placeholder="Student Name"></b-form-input>
                            </b-form-group>
                            <b-form-group>
                              <b-form-input v-model="formStudentPayment.student_email" placeholder="Student Email"></b-form-input>
                            </b-form-group>
                            <b-form-group>
                              <b-form-input v-model="formStudentPayment.amount" placeholder="Amount"></b-form-input>
                            </b-form-group> -->
                            <div ref="card" id="stripe_card"></div>
                            <b-button ref="submitStudPayFrm" class="d-none" type="submit">Submit</b-button>
                          </form>

                        </div>
                    </div>
                    <button type="button" 
                        class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                        v-on:click="destroyStripeCard('next')">Next</button>
                    <button type="button" 
                        class="btn btn-default float-left btn-dashboard mb-3 font-14 stepper-prev"
                        v-on:click="destroyStripeCard('previous')">Previous</button>
                  </div>
                  <div class="col-lg-8 pl-0" v-if="showStepper5">
                    <div class="stepper-control">
                        <h5>These are the communication tools your teacher uses.</h5>
                        <label class="mb-3 font-12">Please choose your preferred communication tool.</label>
                        
                        <div class="row">
                          <div class="col-lg-6 m-auto">
                            <div class="btn-vertical btn-group-toggle" data-toggle="buttons">
                              <!-- <label v-for="lo in lessonOption" :key="lo.id" v-on:click="getTitleLessonOpt(lo.title)" class="btn btn-light w-100 mb-2 p-3"> -->
                              <label class="btn btn-light w-100 mb-2 p-3" v-for="gca in getComApp" :key="gca.id" @click="pickComApp = false">
                                <input type="radio" v-model="formToSave.communication_app_id" :value="gca.id" name="communication-tool" autocomplete="off"> 
                                <span class="sc-title"><img :src="asset + 'images/' + gca.icon" alt=""> {{ gca.app_name }}</span>
                                <span class="sc-price"></span>
                              </label>
                            </div>
                            <input type="text" 
                              class="form-control text-center input-custom font-14 mb-3" 
                              placeholder="Your Email"
                              name="com_id"
                              v-model="formToSave.app_id" :disabled="pickComApp">
                          </div>
                        </div>
                    </div>
                    <button type="button" 
                            class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                            @click="submitBookedSchedule">Finished</button>
                    <!-- <button type="button" 
                        class="btn btn-default float-left btn-dashboard mb-3 font-14 stepper-prev"
                        v-on:click="showPaymentSection('previous')">Previous</button> -->
                        <!-- showStepper4 = !showStepper4; 
                        showStepper5 = !showStepper5; -->
                  </div>
                  
                </transition>

                
              </div>
            <!-- </section> -->
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default btn-dashboard mb-3 font-14">Next</button>
          </div> -->
        </div>
      </div>
    </div>

    <StudentsPref :asset="asset" :csrf="csrf" :fnBookATrial="fnBookATrial" :teachers_id="formToSave.teachers_id" :baseurl="baseurl" :user_id="user_id"/>

    <div class="show_loading" v-if="showLoading">
      <p>
        <i class="fas fa-spinner fa-pulse"></i> Please wait.. <br> <span style="font-size: 14px;">Processing your payment</span>
      </p> 
    </div>

  </div>
</template>

<script>
  import moment from 'moment';
  import StudentsPref from './StudentsPref.vue';
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
    props: {
      findtutor: {
        type: Array,
        default: [],
      },
    },
    name: 'FetchFeeds',
    components: {
      StudentsPref
    },
    data(){
      return {
        dataFetchTutor: '',
        dataWeekCalendar: '',
        dataTimaAvPerDay: '',
        teachersdata: '',
        lessonOption: '',
        rate_per_hr: '',
        getComApp: '',
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
        asset: document.querySelector('meta[name="url-asset"]').getAttribute('content'),
        user_id: document.querySelector('meta[name="user-id"]').getAttribute('content'),
        showStepper1: true,
        showStepper2: false,
        showStepper3: false,
        showStepper4: false,
        showStepper5: false,
        showStepper6: false,
        timeActive: false,
        studentsData: '',
        formStudentPayment: {
          amount: 0,
        },
        formToSave: {
          teachers_id : '',
          lesson_plan_id : '',
          lesson_option_id : '',
          lesson_date: [],
          communication_app_id: '',
          app_id: '',
          student_email: '',
          has_pref: false
        },
        sorted_date: '',
        moment: moment,
        totalHrs: 0,
        lessonOptTitle: '',
        lesson_schedule_id: '',
        pickComApp: true,
        showLoading: false,
        procFee: 0,
        trialFree: false
      }
    },
    methods: {
      getLessonOption(students_id, teachers_id){
        axios.post('/heygo/get-lesson-option', { 'students_id' : students_id, 'teachers_id' : teachers_id }).then((res) => {
						this.lessonOption = res.data;
            //if student have book a trial lesson
            // if (res.data[0].trial_lesson_rate == 0) {
            //   this.trialFree = true;
            //   // this.rate_per_hr = 0;
            // } else {
            //   this.trialFree = false;
            // }
					}).catch((error) => {
						console.log(error);
        });
      },
      getCommunicationApp(){
        axios.get('/heygo/get-com-app').then((res) => {
						this.getComApp = res.data
					}).catch((error) => {
						console.log(error);
        });
      },
      fetchTutor(){
        axios.get('/heygo/api/get-fetch-tutor').then((res) => {
						this.dataFetchTutor = res.data
					}).catch((error) => {
						console.log(error);
        });
      },
      fetchCalendarWeek(tId){
        axios.post('/heygo/get-week-calendar', { teachers_id: tId }).then((res) => {
            this.dataWeekCalendar = res.data;
            // console.log(res.data);
					}).catch((error) => {
						console.log(error);
        });
      },
      fetchTimePerDay(tId){
        axios.post('/heygo/get-time-available-per-day', {teachers_id: tId}).then((res) => {
            this.dataTimaAvPerDay = res.data;
            // console.log(this.dataTimaAvPerDay);
					}).catch((error) => {
						// console.log(error);
        });
      },
      showTeacherProfile(id){
        window.location.href = this.baseurl + '/teachers-profile/' + id
      },
      fnBookATrial(e){
        //get the teachers_id
        Object.assign(this.$data, this.$options.data());
        this.getCommunicationApp();
        this.getStudentsInfo();
        this.formToSave.teachers_id = e;
        axios.get('/heygo/get-teachers-info/'+e).then((res) => {
            this.teachersdata = res.data.data;
            this.formToSave.lesson_plan_id = res.data.data[0].lesson_plan_id;
            this.rate_per_hr = res.data.data[0].rate_per_hr;
            // data from StudentPref Component
            // this.$root.$refs.StudentsPref.formPref
            if (res.data.has_pref) {
              $('#modalBookTrial').modal('show'); 
              this.getLessonOption(this.user_id, this.formToSave.teachers_id);
            } else {
              this.$bvModal.show('modal-students-pref');
            }

            // console.log(res.data.has_pref, this.$root.$refs.StudentsPref.formPref.students_level_id);
            // console.log(res.data.has_pref);
            // console.log(res);
					}).catch((error) => {
						console.log(error);
        });
        this.fetchCalendarWeek(this.formToSave.teachers_id);
        this.fetchTimePerDay(this.formToSave.teachers_id);

      },
      selectTimePreferred(event){
        const sorted_date = event.target.getAttribute('data-date');
        const lesson_option_id = this.formToSave.lesson_option_id;
        switch (lesson_option_id) {
          case 1:
            //trial lesson
            var sd = moment(new Date(sorted_date)).format('L HH:mm');
            var ed = moment(new Date(sorted_date)).add(30, 'minutes');
            var duration = moment.duration(ed.diff(moment(new Date(sorted_date))));
            this.formToSave.lesson_date = [sd, moment(ed).format('L HH:mm')];
            this.totalHrs = duration.asHours();
            break;
          case 2:
            //1 Hour lesson
            var sd = moment(new Date(sorted_date)).format('L HH:mm');
            var ed = moment(new Date(sorted_date)).add(1, 'hours');
            var duration = moment.duration(ed.diff(moment(new Date(sorted_date)))); 
            this.formToSave.lesson_date = [sd, moment(ed).format('L HH:mm')];
            this.totalHrs = duration.asHours();
            break;
          default:
            //30 Minute Lesson (For Elementary Level)
            var sd = moment(new Date(sorted_date)).format('L HH:mm');
            var ed = moment(new Date(sorted_date)).add(30, 'minutes');
            var duration = moment.duration(ed.diff(moment(new Date(sorted_date))));
            this.formToSave.lesson_date = [sd, moment(ed).format('L HH:mm')];
            this.totalHrs = duration.asHours();
            break;
        }
        this.sorted_date = this.formToSave.lesson_date;
        this.procFee = ((this.rate_per_hr || 0) * this.totalHrs) * 0.06
        // console.log(this.sorted_date);
      },
      getTitleLessonOpt(title, trial_lesson_rate, lesson_option_id){
        this.lessonOptTitle = title;
        if (trial_lesson_rate == 0 && lesson_option_id == 1) {
          this.trialFree = true;
        } else {
          this.trialFree = false;
        }
      },
      chooseBookingDate(){
        this.showStepper2 = !this.showStepper2; 
        this.showStepper3 = !this.showStepper3;
      },
      submitBookedSchedule(){
        let data = new FormData();
        // data.append('teachers_id', this.formToSave.teachers_id);
        // data.append('lesson_plan_id', this.formToSave.lesson_plan_id);
        // data.append('lesson_option_id', this.formToSave.lesson_option_id);
        // data.append('lesson_date', this.formToSave.lesson_date);
        data.append('communication_app_id', this.formToSave.communication_app_id);
        data.append('app_id', this.formToSave.app_id);
        // data.append('user_id', this.user_id);
        // data.append('_token', this.csrf);
        data.append('lesson_schedule_id', this.lesson_schedule_id);
        axios.post('/heygo/save-email-communication', data).then((res) => {
          if (typeof res.data.errors === 'undefined') {
            window.location.reload();
            
          }
        }).catch((error) => {
          console.log(error);
          // this.form.errors.record(error.response.data.errors);
        });
      },
      submitStudentPayment: function (e) {
        this.showLoading = true;
        if (this.trialFree == true) {
          this.handleFreeTrialLesson();
        } else {
          stripe.createToken(card).then(result=>{
            if (result.error) {
              console.log('error happend when getting token');
            } else {
              this.handlePaymentToken(result.token);
            }
          });
        }
      },
      handlePaymentToken(token){
        this.showLoading = false;
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this payment!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#fcb017',
          cancelButtonColor: '#212222',
          confirmButtonText: 'Yes',
          cancelButtonText: 'Wait',
        }).then((result) => {
          if (result.isConfirmed) {
            this.showStepper4 = !this.showStepper4; 
            this.showStepper5 = !this.showStepper5;
            this.formStudentPayment.stripeToken = token.id;
            let data = new FormData();
            this.formStudentPayment.teachers_id = this.formToSave.teachers_id;
            this.formStudentPayment.lesson_plan_id = this.formToSave.lesson_plan_id;
            this.formStudentPayment.lesson_option_id = this.formToSave.lesson_option_id;
            this.formStudentPayment.lesson_date = this.formToSave.lesson_date;
            this.formStudentPayment.communication_app_id = this.formToSave.communication_app_id;
            this.formStudentPayment.app_id = this.formToSave.app_id;
            this.formStudentPayment.user_id = this.user_id;
            this.formStudentPayment.amount = this.trialFree == true ? 0 : ((this.rate_per_hr || 0) * this.totalHrs + this.procFee);
            this.formStudentPayment.email = this.studentsData[0].email;
            this.formStudentPayment.book_description = this.totalHrs + ' hr/s Lesson';
            this.formStudentPayment.student_name = this.studentsData[0].lastname + ', ' + this.studentsData[0].firstname;
            this.showLoading = true;
            axios.post('api/student-payment-charge', this.formStudentPayment).then((res)=>{
              console.log("res: ", res.data.stripe_date);
              this.lesson_schedule_id = res.data.lesson_schedule_id;
              this.showLoading = false;
            }).catch((err)=>console.log(err));
          } 
          // else {
          // }
        });
      },
      handleFreeTrialLesson(){
        this.showLoading = false;
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this booking!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#fcb017',
          cancelButtonColor: '#212222',
          confirmButtonText: 'Yes',
          cancelButtonText: 'Wait',
        }).then((result) => {
          if (result.isConfirmed) {
            this.showStepper4 = !this.showStepper4; 
            this.showStepper5 = !this.showStepper5;
            let data = new FormData();
            this.formStudentPayment.teachers_id = this.formToSave.teachers_id;
            this.formStudentPayment.lesson_plan_id = this.formToSave.lesson_plan_id;
            this.formStudentPayment.lesson_option_id = this.formToSave.lesson_option_id;
            this.formStudentPayment.lesson_date = this.formToSave.lesson_date;
            this.formStudentPayment.communication_app_id = this.formToSave.communication_app_id;
            this.formStudentPayment.app_id = this.formToSave.app_id;
            this.formStudentPayment.user_id = this.user_id;
            this.formStudentPayment.amount = this.trialFree == true ? 0 : ((this.rate_per_hr || 0) * this.totalHrs + this.procFee);
            this.formStudentPayment.email = this.studentsData[0].email;
            this.formStudentPayment.book_description = this.totalHrs + ' hr/s Lesson';
            this.formStudentPayment.student_name = this.studentsData[0].lastname + ', ' + this.studentsData[0].firstname;
            this.showLoading = true;
            axios.post('api/student-book-free-trial', this.formStudentPayment).then((res)=>{
              console.log("res: ", res.data.stripe_date);
              this.lesson_schedule_id = res.data.lesson_schedule_id;
              this.showLoading = false;
            }).catch((err)=>console.log(err));
          } 
          // else {
          // }
        });
      },
      showPaymentSection(t){
        if (t == 'next') {
          this.showStepper3 = !this.showStepper3; 
          this.showStepper4 = !this.showStepper4;
        } else {
          this.showStepper4 = !this.showStepper4; 
          this.showStepper5 = !this.showStepper5;
        }
        if (this.trialFree == false) {
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
        }
      },
      destroyStripeCard(t){
        if (t == 'next') {

          this.$refs.submitStudPayFrm.click();
        
        } else {
          //previous
          setTimeout(function(){
            card.destroy("#stripe_card");
          }, 500);
          this.showStepper3 = !this.showStepper3;
          this.showStepper4 = !this.showStepper4;
        }
      },
      getStudentsInfo(){
        axios.get('/heygo/get-students-info/'+this.user_id).then((res) => {
            this.studentsData = res.data
          }).catch((error) => {
            console.log(error);
        });
      },
      hasTrial(lesson_option_id){
        if (lesson_option_id === null) {
          return false;
        } else {
          var e_loi = lesson_option_id.split(',');
          if (e_loi.includes('1')) {
            return true;
          }else{
            return false;
          }
        }
      }
    },
    beforeMount: function(){
      this.showLoading = false;
    },
    mounted: function(){
      this.fetchTutor();
      this.getCommunicationApp();
      this.getStudentsInfo();
    },
    destroyed(){
      console.log('destroyed');
    }
  }
</script>

<style>
  body{font-size:21px;font-family:Roboto;margin:30px}*,*:before,*:after{box-sizing:border-box}.step{position:relative;min-height:4.5em;color:gray}.step+.step{margin-top:0em}.step>div:first-child{position:static;height:0}.step>div:not(:first-child){margin-left:1.5em;padding-left:1em}.step.step-active{color:#f7bb17}.step.step-active .circle{background-color:#f7bb17}.circle{background:gray;position:relative;width:1.5em;height:1.5em;line-height:1.5em;border-radius:100%;color:#fff;text-align:center;box-shadow:0 0 0 3px #fff}.circle:after{
    content: ' ';
    position: absolute;
    display: block;
    top: 0px;
    right: 50%;
    bottom: 1px;
    left: 43%;
    height: 100%;
    width: 3px;
    transform: scale(1,2);
    transform-origin: 50% -100%;
    background-color: rgba(15, 14, 14, 0.55);
    z-index: 1;
  }
  .step:last-child .circle:after{
    display:none
  }
  .title{
    line-height:-1em;
    font-weight:700;
    font-size: 16px !important;
  }
  .caption{font-size:.8em}
  .left-stepper-tab{
    padding: 10px;
  }
  .left-stepper-tab {
    padding: 50px;
    background: #eeede6;
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px;
  }
  .stepper-next {
    position: absolute;
    bottom: 17px;
    right: 74px;
  }
  .stepper-prev {
    position: absolute;
    bottom: 17px;
    left: 62px;
  }
  .stepper-control{
    padding: 61px;
  }
  .sc-title {
    width: 100%;
    float: left;
    text-align: left;
    font-size: 19px;
  }
  .sc-sm-silent {
    float: left;
    width: 100%;
    text-align: left;
    font-size: 12px;
    color: #848484;
  }
  .sc-price {
    float: right;
    position: absolute;
    right: 16%;
    width: 100%;
    text-align: right;
    line-height: 3;
  }
  .fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
  }
  .bg-calendar-hdr{
    background: #f3dea2;
  }
  .btn-radio-select{
    font-size: 12px !important;
    padding: 3px !important;
    padding-right: 3px !important;
    padding-left: 3px !important;
    border: 1px solid #e3e2e2 !important;
    padding-left: 12px !important;
    padding-right: 12px !important;
  }
  .active-time{
    background: #f7bb17 !important;
    color: #fff !important;
  }
  .StripeElement{
    border: solid 1px #ddd;
    border-radius: 3px;
    height:40px;

    padding: 10px 12px;
    border-bottom: 1px solid #ddd;
    background-color: #fff;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
  }
  .StripeElement--invalid{
    border-color: #fa755a;
  }
  .StripeElement--webkit-autofill{
    background-color: #fefde5 !important;
  }
  .StripeElement{
    border:solid 1px #ddd;
    border-radius: 3px;
  }
  .show_loading{
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: 50% 50% no-repeat rgba(98, 90, 76, 0.77);
  }
  .show_loading p {
    margin-top: 22%;
    text-align: center;
    color: #fff;
    font-size: 24px;
  }
  .trial_lesson_taked {
    position: absolute;
    font-size: 11px;
    background: #e8e4d9;
    padding: 8px;
    right: 92px;
    border-radius: 4px;
    border: 0.5px solid #b9b9b9;
    z-index: 1;
  }
</style>