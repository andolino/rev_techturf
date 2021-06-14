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
              <span class="ml-4" style="font-size: 23px;"> 
                {{ dft.lastname.toUpperCase() }}, {{ dft.firstname.toUpperCase() }}</span>
              <span class="ml-3">
                <i class="fas fa-map-marker-alt text-warning p-2"></i>
                <img :src="asset + 'images/flag-1.png'" width="20"></span>
              <span class="ml-3">
                <i class="fas fa-star text-warning p-2"></i>
                <strong>4.5</strong></span>
              <span class="ml-3">
                43 Reviews 
                <i class="fas fa-heart" style="color: rgb(217, 22, 132);"></i></span>
              <span class="ml-3" style="float: right;">
                {{ dft.currency }} - {{ dft.rate_per_hr }}
              </span><br>
              <div class="row">
                <span class="ml-3" style="float: right;line-height: 1.5;">
                  {{ dft.type }}
                </span>
              </div>
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
                    Book A Trial
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

    <div class="modal fade bd-example-modal-lg" id="modalWriteAPost" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                        <label v-for="lo in lessonOption" :key="lo.id" v-on:click="getTitleLessonOpt(lo.title)" class="btn btn-light w-100 mb-2 p-3">
                          <input type="radio" v-model="formToSave.lesson_option_id" :value="lo.id" name="lesson-option" id="lesson-option" autocomplete="off"> 
                          <span class="sc-title">{{ lo.title }}</span>
                          <span class="sc-sm-silent">{{ lo.lesson_count }} Lessons</span>
                          <span class="sc-price">{{ lo.id == 1 ? '' : lo.currency + ' ' + ( rate_per_hr || 0)}}</span>
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
                      <table class="table table-sm font-12">
                        <thead>
                          <tr>
                            <td class="text-center bg-calendar-hdr" v-for="dwc in dataWeekCalendar" :key="dwc.key">
                              {{ dwc.key }} <strong>{{ dwc.value }}</strong>
                            </td>
                          </tr>
                          <tr v-for="dta in dataTimaAvPerDay" :key="dta.time">
                            <td class="text-center clk-time" v-for="dwc in dataWeekCalendar" :key="dwc.key">
                              <button type="button" 
                                class="btn btn-xs btn-radio-select"
                                :class="{ 'active-time' : formToSave.lesson_date.some(d => d === dwc.w_date + ' ' + dta[0].time)}"
                                :data-date="dwc.w_date + ' ' + dta[0].time"
                                @click="selectTimePreferred" 
                                >{{ dta[0].time }}</button></td>
                                <!-- :class="{ 'active-time' : formToSave.lesson_date.some(d => d === dwc.w_date + ' ' + dta[0].time)}" -->
                          </tr>
                        </thead>
                      </table>
                    </div>
                    <button type="button" 
                        class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                        v-on:click="showStepper2 = !showStepper2; 
                                    showStepper3 = !showStepper3;">Next</button>
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
                                    <p class="mb-1">{{ (rate_per_hr || 0) }}/hour <br> {{ totalHrs }} <br> 500JPY</p>
                                  </div>
                                </div>
                                
                                <hr class="mb-1">
                                <div class="row font-14">
                                  <div class="col-lg-6 text-left">
                                    <label for="">TOTAL</label>
                                  </div>
                                  <div class="col-lg-6 text-right">
                                    <label for="">{{ (rate_per_hr || 0) * totalHrs + 500 }} JPY</label>
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
                        v-on:click="showStepper3 = !showStepper3; 
                                    showStepper4 = !showStepper4;">Next</button>
                    <button type="button" 
                        class="btn btn-default float-left btn-dashboard mb-3 font-14 stepper-prev"
                        v-on:click="showStepper2 = !showStepper2; 
                                    showStepper3 = !showStepper3;">Previous</button>
                  </div>
                  <div class="col-lg-8 pl-0" v-if="showStepper4">
                    <div class="stepper-control">
                        <h4>Payment Method</h4>
                        <label class="mb-3 font-12">It's safe to pay on Preply All transactions are protected by SSL encryption.</label>
                        <div class="btn-vertical btn-group-toggle" data-toggle="buttons">
                          <!-- <label v-for="lo in lessonOption" :key="lo.id" v-on:click="getTitleLessonOpt(lo.title)" class="btn btn-light w-100 mb-2 p-3"> -->
                          <label class="btn btn-light w-100 mb-2 p-3">
                            <input type="radio" name="payment-method" autocomplete="off"> 
                            <span class="sc-title"><img :src="asset + 'images/gpay.png'" alt=""></span>
                            <span class="sc-price"></span>
                          </label>
                          <label class="btn btn-light w-100 mb-2 p-3">
                            <input type="radio" name="payment-method" autocomplete="off"> 
                            <span class="sc-title"><img :src="asset + 'images/apay.png'" alt=""></span>
                            <span class="sc-price"></span>
                          </label>
                          <label class="btn btn-light w-100 mb-2 p-3">
                            <input type="radio" name="payment-method" autocomplete="off"> 
                            <span class="sc-title"><img :src="asset + 'images/ppay.png'" alt=""></span>
                            <span class="sc-price"></span>
                          </label>
                        </div>
                    </div>
                    <button type="button" 
                        class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                        v-on:click="showStepper4 = !showStepper4; 
                                    showStepper5 = !showStepper5;">Next</button>
                    <button type="button" 
                        class="btn btn-default float-left btn-dashboard mb-3 font-14 stepper-prev"
                        v-on:click="showStepper3 = !showStepper3; 
                                    showStepper4 = !showStepper4;">Previous</button>
                  </div>
                  <div class="col-lg-8 pl-0" v-if="showStepper5">
                    <div class="stepper-control">
                        <h5>These are the communication tools your teacher uses.</h5>
                        <label class="mb-3 font-12">Please choose your preferred communication tool.</label>
                        
                        <div class="row">
                          <div class="col-lg-6 m-auto">
                            <div class="btn-vertical btn-group-toggle" data-toggle="buttons">
                              <!-- <label v-for="lo in lessonOption" :key="lo.id" v-on:click="getTitleLessonOpt(lo.title)" class="btn btn-light w-100 mb-2 p-3"> -->
                              <label class="btn btn-light w-100 mb-2 p-3">
                                <input type="radio" name="communication-tool" autocomplete="off"> 
                                <span class="sc-title"><img :src="asset + 'images/zoom.png'" alt=""> Skype</span>
                                <span class="sc-price"></span>
                              </label>
                              <label class="btn btn-light w-100 mb-2 p-3">
                                <input type="radio" name="communication-tool" autocomplete="off"> 
                                <span class="sc-title"><img :src="asset + 'images/skype.png'" alt=""> Zoom</span>
                                <span class="sc-price"></span>
                              </label>
                            </div>
                            <input type="text" 
                              class="form-control text-center input-custom font-14 mb-3" 
                              placeholder="Your ID"
                              name="com_id">
                          </div>
                        </div>
                    </div>
                    <button type="button" 
                            class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                            v-on:click="showStepper4 = !showStepper4; 
                                        showStepper5 = !showStepper5;">Finished</button>
                    <button type="button" 
                        class="btn btn-default float-left btn-dashboard mb-3 font-14 stepper-prev"
                        v-on:click="showStepper4 = !showStepper4; 
                                    showStepper5 = !showStepper5;">Previous</button>
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
  </div>
</template>

<script>
  import moment from 'moment';
  export default {
    props: {
      findtutor: {
        type: Array,
        default: [],
      }
    },
    name: 'FetchFeeds',
    data(){
      return {
        dataFetchTutor: '',
        dataWeekCalendar: '',
        dataTimaAvPerDay: '',
        teachersdata: '',
        lessonOption: '',
        rate_per_hr: '',
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
        asset: document.querySelector('meta[name="url-asset"]').getAttribute('content'),
        showStepper1: true,
        showStepper2: false,
        showStepper3: false,
        showStepper4: false,
        showStepper5: false,
        timeActive: false,
        formToSave: {
          lesson_option_id : '',
          lesson_date: [],
        },
        sorted_date: '',
        moment: moment,
        totalHrs: 0,
        lessonOptTitle: ''
      }
    },
    methods: {
      getLessonOption(){
        axios.get('/heygo/get-lesson-option').then((res) => {
						this.lessonOption = res.data
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
      fetchCalendarWeek(){
        axios.get('/heygo/get-week-calendar').then((res) => {
						// this.dataWeekCalendar = res.data
            this.dataWeekCalendar = res.data;
					}).catch((error) => {
						console.log(error);
        });
      },
      fetchTimePerDay(){
        axios.get('/heygo/get-time-available-per-day').then((res) => {
						// this.dataWeekCalendar = res.data
            this.dataTimaAvPerDay = res.data;
					}).catch((error) => {
						console.log(error);
        });
      },
      showTeacherProfile(id){
        window.location.href = this.baseurl + '/teachers-profile/' + id
      },
      fnBookATrial(e){
        axios.get('/heygo/get-teachers-info/'+e).then((res) => {
						// this.dataWeekCalendar = res.data
            this.teachersdata = res.data;
            this.rate_per_hr = res.data[0].rate_per_hr;
					}).catch((error) => {
						console.log(error);
        });
        $('#modalWriteAPost').modal('show');
      },
      selectTimePreferred(event){
        // this.timeActive = !this.timeActive
        // if (event.target.classList.contains('active-time')) {
        //   event.target.classList.remove("active-time");
        //   this.formToSave.lesson_date.splice(this.formToSave.lesson_date.indexOf(event.target.getAttribute('data-date')), 1);
        // } else {
        //   event.target.classList.add('active-time');
        //   this.formToSave.lesson_date.push(event.target.getAttribute('data-date')); 
        // }
        
        // this.sorted_date = this.formToSave.lesson_date.sort();
        // const sorted_date = this.sorted_date;
        const sorted_date = event.target.getAttribute('data-date');
        const lesson_option_id = this.formToSave.lesson_option_id;
        switch (lesson_option_id) {
          case 1:
            //trial lesson
            var sd = moment(new Date(sorted_date)).format('L LT');
            var ed = moment(new Date(sorted_date)).add(30, 'minutes');
            var duration = moment.duration(ed.diff(moment(new Date(sorted_date))));
            this.formToSave.lesson_date = [sd, moment(ed).format('L LT')];
            this.totalHrs = duration.asHours();
            break;
          case 2:
            //1 Hour lesson
            var sd = moment(new Date(sorted_date)).format('L LT');
            var ed = moment(new Date(sorted_date)).add(1, 'hours');
            var duration = moment.duration(ed.diff(moment(new Date(sorted_date)))); 
            this.formToSave.lesson_date = [sd, moment(ed).format('L LT')];
            this.totalHrs = duration.asHours();
            break;
          default:
            //30 Minute Lesson (For Elementary Level)
            var sd = moment(new Date(sorted_date)).format('L LT');
            var ed = moment(new Date(sorted_date)).add(30, 'minutes');
            var duration = moment.duration(ed.diff(moment(new Date(sorted_date))));
            this.formToSave.lesson_date = [sd, moment(ed).format('L LT')];
            this.totalHrs = duration.asHours();
            break;
        }
        this.sorted_date = this.formToSave.lesson_date;
        console.log(this.formToSave.lesson_date);
      },
      getTitleLessonOpt(title){
        this.lessonOptTitle = title;
      }
      
    },
    mounted(){
      this.fetchTutor();
      this.fetchCalendarWeek();
      this.fetchTimePerDay();
      this.getLessonOption();
      // Get the element with id="defaultOpen" and click on it
      // document.getElementById("defaultOpen").click();
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
</style>