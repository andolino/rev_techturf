<template>
  <div>

    <div class="card-group b-bot-yellow mb-3 cursor" 
        v-for="ul in upcomingLessonData" 
        @click="fnAcceptingLesson(ul.start_date, ul.lesson_id)"
        :key="ul.lesson_id">
      <div class="card">
        <div class="card-body">
          <label class="card-title">{{ ul.time_sched }}</label>
          <small class="float-right text-success" v-if="ul.status == 3">
            {{ timeReminder(ul.start_date, ul.end_date) }}
          </small>
          <small class="float-right text-success" v-else-if="ul.status == 2">
            {{ timeReminder(ul.start_date, ul.end_date) }}
          </small>
          <small class="float-right text-success" v-else-if="ul.status == 1">
            For Approval
          </small>
          <small class="float-right text-danger" v-else>
            Declined
          </small>
          <h6 class="card-title font-weight-bold">{{ ul.title }}</h6>
          <p class="card-text">{{ ul.objective_text }}</p>
        </div>
        <div class="card-footer">
          <img :src="asset + 'images/ellipse.png'" alt="">
          <small class="text-muted">{{ ul.fullname }}</small>
        </div>
      </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="modalStudentStartLesson" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                <div class="col-lg-4 pr-0 rounded">
                  <div class="left-stepper-tab-ts h-100" 
                      v-bind:style="{ backgroundImage: 'url(' + bgImgStepper + ')' }">
                    <h2 for="" class="mb-5 text-light font-weight-bold">Start Your Lesson</h2>
                    <div class="step" :class="{ 'step-active' : showStepper1 }">
                      <div>
                        <div class="circle">&nbsp;</div>
                      </div>
                      <div>
                        <div class="title mt-0 text-light mr-0">Join the Class</div>
                        <!-- <div class="caption">Optional</div> -->
                      </div>
                    </div>
                    <div class="step" style="min-height:0em" :class="{ 'step-active' : showStepper2 }">
                      <div>
                        <div class="circle circle-2">&nbsp;</div>
                      </div>
                      <div>
                        <div class="title mt-0 text-light mr-0">Classroom</div>
                      </div>
                    </div>
                    <div class="student-view-call mb-3">
                      
                    </div>
                    <div class="row">
                        <div class="col-lg-6 pr-1"><button type="button" class="btn btn-secondary font-12 w-100"><i class="fas fa-video text-danger"></i> Video On</button></div>
                        <div class="col-lg-6 pl-1"><button type="button" class="btn btn-secondary font-12 w-100"><i class="fas fa-microphone text-success"></i> Audio Off</button></div>
                      </div>
                  </div>
                </div>
                <transition name="fade">
                  <div class="col-lg-8 pl-0 bg-light rounded" v-if="joinClassPanel">
                    <div class="stepper-control">
                      <div class="btn-vertical btn-group-toggle" data-toggle="buttons">
                        <ul id="list-teacher-info-booked" class="pl-0">
                          <li><label for="">Name of Teacher : </label><span class="capitalize"> {{ this.teacherInfo.name }}</span></li>
                          <li><label for="">Date : </label><span> {{ this.teacherInfo.date }}</span></li>
                          <li><label for="">Time : </label><span> {{ this.teacherInfo.time }}</span></li>
                          <li><label for="">Type of Lesson : </label><span> {{ this.teacherInfo.type_of_lesson }} 
                            (Via {{ this.teacherInfo.app_name }})</span></li>
                        </ul>
                      </div>
                       <div class="row mb-3">
                          <div class="col-lg-3">
                            <button 
                            type="button" 
                              class="btn btn-md btn-yellow w-100 font-12"> Go to Profile</button>
                          </div>
                        </div>
                        <div class="row" v-if="this.teacherInfo.lesson_status == 3">
                          <div class="col-lg-4">
                            <label for="" class="mb-0">Class Status</label>
                            <select class="form-control form-control-sm" id="class_status">
                              <option hidden selected>----</option>
                              <option value="0">Attend</option>
                              <option value="1">Reschedule</option>
                              <option value="2">Cancel Lesson</option>
                            </select>
                          </div>
                          
                        </div>
                        <div v-else-if="this.teacherInfo.lesson_status == 0">
                          <b-alert show variant="danger">This Schedule is Decline</b-alert>
                        </div>
                        <div v-else>
                          <b-alert show variant="warning">This Schedule is for Approval</b-alert>
                        </div>
                    </div>
                    <button type="button" 
                        class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                        v-on:click="chooseClassStatus(teacherInfo.app_id)" v-if="this.teacherInfo.lesson_status == 3">Next</button>
                    <button type="button" v-if="this.teacherInfo.lesson_status != 0"
                        class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                        @click="rescheduleStudentBooked">Reschedule</button>
                  </div>
                  
                  <div class="col-lg-8 pl-0 bg-light rounded" v-if="reschedulePanel">
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
                              <button type="button" 
                                class="btn btn-xs btn-radio-select"
                                :class="{ 'active-time' : formToSave.lesson_date.some(d => d === dwc.w_date + ' ' + dta[0].time)}"
                                :data-date="dwc.w_date + ' ' + dta[0].time"
                                @click="selectTimePreferred" 
                                >{{ dta[0].time }}</button></td>
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
                            v-on:click="updateRescheduleStudent">Confirm</button>
                    <button type="button" 
                            class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-prev"
                            v-on:click="joinClassPanel = !joinClassPanel;
                                        reschedulePanel = !reschedulePanel;">Cancel</button>
                  </div>
                  
                  <div class="col-lg-8 pl-0 bg-light rounded" v-if="showStepper2">
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
                                >{{ dta[0].time }}</button></td>

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
  name: 'TeacherUpcomingLesson',
  props: [ 'base_url' ],
  data(){
    return {
      bgImgStepper: 'public/images/stepper-left.png',
      bgImgStudentView: 'public/images/feedback-1.png',
      showStepper1: true,
      joinClassPanel: true,
      showStepper2: false,
      reschedulePanel: false,
      dataWeekCalendar: '',
      dataTimaAvPerDay: '',
      form: new Form({
        email: '',
        password: '',
      }),
      teacherInfo: {
        name             : '',
        date             : '',
        time             : '',
        type_of_lesson   : '',
        app_name         : '',
        app_id           : '',
        lesson_option_id : '',
        lesson_status    : '',
        teachers_id      : ''
      },
      formToSave: {
        lesson_date: [],
        lesson_schedule_id: '',
        student_email: '',
        teacher_email: '',
        teacher_name: '',
        lesson_type: ''
      },
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
      asset: document.querySelector('meta[name="url-asset"]').getAttribute('content'),
      user_id: document.querySelector('meta[name="user-id"]').getAttribute('content'),
      upcomingLessonData: '',
      sorted_date: ''
    }
  },
  methods: {
    getUpcomingLesson(){
      axios.post('/heygo/get-teacher-booked-lesson', { 'students_id' : this.user_id }).then((res) => {
          this.upcomingLessonData = res.data;
          this.teacherInfo.teachers_id = res.data[0].id;
        }).catch((error) => {
          console.log(error);
      });
    },
    fnAcceptingLesson(e, lesson_schedule_id){
      axios.post('/heygo/get-booked-teacher-info', { 'lesson_date' : e, 'lesson_schedule_id': lesson_schedule_id }).then((res) => {
          this.teacherInfo.name             = res.data[0].fullname;
          this.teacherInfo.date             = moment(new Date(res.data[0].start_date)).format('LL');
          this.teacherInfo.time             = res.data[0].time_sched;
          this.teacherInfo.type_of_lesson   = res.data[0].type + ' - ' + res.data[0].title;
          this.teacherInfo.app_name         = res.data[0].app_name;
          this.teacherInfo.app_id           = res.data[0].app_id;
          this.teacherInfo.lesson_option_id = res.data[0].lesson_option_id;
          this.teacherInfo.lesson_status = res.data[0].status;

          this.formToSave.lesson_schedule_id = lesson_schedule_id;
          this.formToSave.student_email = res.data[0].student_email;
          this.formToSave.teacher_email = res.data[0].teacher_email;
          this.formToSave.teacher_name = this.teacherInfo.name;
          this.formToSave.lesson_type = res.data[0].level + ' - ' + res.data[0].title;
        }).catch((error) => {
          console.log(error);
      });
      $('#modalStudentStartLesson').modal('show');
    },
    timeReminder(sd, ed){
      let now = moment(new Date(sd));
      let expiration = moment();
      // get the difference between the moments
      let diff = now.diff(expiration);
      //express as a duration
      let diffDuration = moment.duration(diff);
      // display
      let d = 0;
      let h = 0;
      let m = 0;
      if (diffDuration.days() > 0) {
        d = diffDuration.days();
      }
      if(diffDuration.hours() > 0){
        h = diffDuration.hours();
      }
      if(diffDuration.minutes() > 0){
        m = diffDuration.minutes();
      }
      let msg = '';
      if (d == 0 && h == 0 && m == 0 ) {
        msg += 'Expired';
      } else {
        if (d > 0 && h > 0) {
          msg += d + ' days ';
        }else if(d == 0 && h > 0){
          msg += h + ' hours ';
        } else {
          msg += m + ' minutes ';
        }
      }
      return 'Class starts in ' + msg;
    },
    chooseClassStatus(e){
      var cs = document.getElementById("class_status").value;
      if(cs == 0){
        Swal.fire({
          title: 'Are you sure?',
          text: "Please ready the passcode.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#df9509',
          cancelButtonColor: '#353333',
          cancelButtonText: 'Wait',
          confirmButtonText: 'Yes, attend it!'
        }).then((result) => {
          if (result.isConfirmed) {
            // this.joinClassPanel = !this.joinClassPanel;
            this.showStepper1 = !this.showStepper1;
            this.showStepper2 = !this.showStepper2;
            window.open('https://us02web.zoom.us/j/' + e);
            
          }
        });
      } else if (cs == 1) {
        this.joinClassPanel = !this.joinClassPanel;
        this.reschedulePanel = !this.reschedulePanel;
      } else {
        Swal.fire({
          title       : 'Opps!',
          html        : 'Please Select Class Status!',
          icon        : 'warning',
          customClass : {
           confirmButton : 'btn btn-yellow'
          }
        });
      }
    },
    selectTimePreferred(event){
      const sorted_date = event.target.getAttribute('data-date');
      const lesson_option_id = this.teacherInfo.lesson_option_id;
      switch (lesson_option_id) {
        case 1:
          //trial lesson
          var sd = moment(new Date(sorted_date)).format('L HH:mm A');
          var ed = moment(new Date(sorted_date)).add(30, 'minutes');
          var duration = moment.duration(ed.diff(moment(new Date(sorted_date))));
          this.formToSave.lesson_date = [sd, moment(ed).format('L HH:mm A')];
          this.totalHrs = duration.asHours();
          break;
        case 2:
          //1 Hour lesson
          var sd = moment(new Date(sorted_date)).format('L HH:mm A');
          var ed = moment(new Date(sorted_date)).add(1, 'hours');
          var duration = moment.duration(ed.diff(moment(new Date(sorted_date)))); 
          this.formToSave.lesson_date = [sd, moment(ed).format('L HH:mm A')];
          this.totalHrs = duration.asHours();
          break;
        default:
          //30 Minute Lesson (For Elementary Level)
          var sd = moment(new Date(sorted_date)).format('L HH:mm A');
          var ed = moment(new Date(sorted_date)).add(30, 'minutes');
          var duration = moment.duration(ed.diff(moment(new Date(sorted_date))));
          this.formToSave.lesson_date = [sd, moment(ed).format('L HH:mm A')];
          this.totalHrs = duration.asHours();
          break;
      }
      this.sorted_date = this.formToSave.lesson_date;
      // console.log(this.sorted_date);
    },
    fnBookATrial(){
      //get the teachers_id
      // this.formToSave.teachers_id = e;
      // axios.get('/heygo/get-teachers-info/'+e).then((res) => {
      //     this.teachersdata = res.data;
      //     this.rate_per_hr = res.data[0].rate_per_hr;
      //     this.formToSave.lesson_plan_id = res.data[0].lesson_plan_id;
      //   }).catch((error) => {
      //     console.log(error);
      // });
    },
    fetchCalendarWeek(){
      axios.post('/heygo/get-week-calendar', { 'teachers_id' : this.teacherInfo.teachers_id }).then((res) => {
        this.dataWeekCalendar = res.data;
        // console.log(this.dataWeekCalendar);
      }).catch((error) => {
          console.log(error);
      });
    },
    fetchTimePerDay(){
      axios.post('/heygo/get-time-available-per-day', { 'teachers_id' : this.teacherInfo.teachers_id }).then((res) => {
        this.dataTimaAvPerDay = res.data;
      }).catch((error) => {
          console.log(error);
      });
    },
    rescheduleStudentBooked(){
      this.joinClassPanel = !this.joinClassPanel;
      this.reschedulePanel = !this.reschedulePanel;
      this.fetchCalendarWeek();
      this.fetchTimePerDay();
    },
    updateRescheduleStudent(){
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this schedule!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#fcb017',
          cancelButtonColor: '#212222',
          confirmButtonText: 'Yes',
          cancelButtonText: 'Wait',
        }).then((result) => {
          if (result.isConfirmed) {
            axios.post('/heygo/update-student-schedule', this.formToSave).then((res) => {
              // console.log(this.formToSave);
              // this.dataWeekCalendar = res.data;
              // console.log(this.dataWeekCalendar);
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Reschedule Successfully',
                showConfirmButton: false,
                timer: 1500
              });
              $('#modalStudentStartLesson').modal('hide');
              setTimeout(function(){
                window.location.reload();
              }, 800);
            }).catch((error) => {
                console.log(error);
            });
          } 
          // else {
          // }
        });

      
    }
  },
  mounted() {
    // this.fetchTimePerDay();
    this.getUpcomingLesson();
    this.fetchCalendarWeek();

  }
}
</script>

<style>
.modal-header {
    border-bottom: 0px !important;
    text-align: center;
}
.modal-footer {
    border-top: 0px !important;
}
.text-muted{
  text-transform: capitalize;
}
body{font-size:21px;font-family:Roboto;margin:30px}*,*:before,*:after{box-sizing:border-box}.step{position:relative;min-height:4.5em;color:gray}.step+.step{margin-top:0em}.step>div:first-child{position:static;height:0}.step>div:not(:first-child){margin-left:1.5em;padding-left:1em}.step.step-active{color:#f7bb17}.step.step-active .circle{background-color: #353333;}.circle{background:gray;position:relative;width:1.5em;height:1.5em;line-height:1.5em;border-radius:100%;color:#fff;text-align:center;box-shadow:0 0 0 3px #fff}.circle:after{
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
.left-stepper-tab-ts {
  padding: 50px;
  border-top-left-radius: 6px;
  border-bottom-left-radius: 6px;
  background-repeat: no-repeat;
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
.capitalize{
  text-transform: capitalize;
}
#list-teacher-info-booked{
  list-style-type: none;
}
#list-teacher-info-booked label{
  font-weight: 700;
}
#modalStudentStartLesson .modal-content {
  background: none !important;
  border: none !important;
}
#modalStudentStartLesson .col-lg-9 {
  border-top-right-radius: 28px;
}
.student-view-call{
  background-color: #f0f0f0;
  height: 90px;
  width: 100%;
  margin-top: 155px;
  position: relative;
}
.circle-2::after{
  height: 0 !important;
}
</style>
