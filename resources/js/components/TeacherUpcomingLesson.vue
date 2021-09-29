<template>
  <div>

    <div class="card-group b-bot-yellow mb-3 cursor" 
        @click="fnAcceptingLesson(ul.start_date, ul.students_id, ul.lesson_id)" 
        v-for="ul in upcomingLessonData" 
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
          <!-- <small class="float-right text-success">
            {{ timeReminder(ul.start_date, ul.end_date) }}
          </small> -->
          <h6 class="card-title font-weight-bold">{{ ul.title }}</h6>
          <p class="card-text">{{ ul.objective_text }}</p>
        </div>
        <div class="card-footer">
          <img :src="asset + 'images/ellipse.png'" alt="">
          <small class="text-muted">{{ ul.fullname }}</small>
        </div>
      </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalTeacherStartLesson" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                      <h3 for="" class="mb-5 text-light font-weight-bold">A student booked a lesson</h3>
                      
                      <!-- <div class="step" :class="{ 'step-active' : showStepper1 }">
                        <div>
                          <div class="circle">&nbsp;</div>
                        </div>
                        <div>
                          <div class="title mt-0 text-light mr-0">Join the Class</div>
                        </div>
                      </div>
                      
                      <div class="step" style="min-height:0em" :class="{ 'step-active' : showStepper2 }">
                        <div>
                          <div class="circle circle-2">&nbsp;</div>
                        </div>
                        <div>
                          <div class="title mt-0 text-light mr-0">Classroom</div>
                        </div>
                      </div> -->

                      <!-- <div class="student-view-call mb-3">
                      </div>
                      <div class="row">
                        <div class="col-lg-6 pr-1"><button type="button" class="btn btn-secondary font-12 w-100"><i class="fas fa-video text-danger"></i> Video On</button></div>
                        <div class="col-lg-6 pl-1"><button type="button" class="btn btn-secondary font-12 w-100"><i class="fas fa-microphone text-success"></i> Audio Off</button></div>
                      </div> -->

                    </div>
                  </div>

                  <div class="col-lg-8 pl-0 bg-light rounded d-inline-block cont-booked-lesson-modal" v-if="joinClassPanel">
                    <div class="stepper-control mb-3">
                      <div class="btn-vertical btn-group-toggle" data-toggle="buttons">
                        <ul id="list-teacher-info-booked" class="pl-0">
                          <li><label for="">Name of Student : </label><span class="capitalize"> {{ this.studentInfo.name }} 
                            <a href="javascript:void(0)" 
                              class="text-warning font-weight-bold"
                              @click="getStudentData"><small> View Profile</small></a></span></li>
                          <li><label for="">Date : </label><span> {{ this.studentInfo.date }}
                            <a href="javascript:void(0)" 
                              @click="viewCalendarBooked"
                              class="text-warning font-weight-bold"><small> View Calendar</small></a></span></li>
                          <li><label for="">Time : </label><span> {{ this.studentInfo.time }}</span></li>
                          <li><label for="">Type of Lesson : </label><span> {{ this.studentInfo.type_of_lesson }} 
                            (Via {{ this.studentInfo.app_name }})</span></li>
                        </ul>
                      </div>
                    </div>
                    
                    <button type="button" 
                        class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next" 
                        @click="lessonApproval(studentInfo.lesson_schedule_id)" 
                        data-apptype="confirm" v-if="studentInfo.status == 1">Confirm</button>
                    <button type="button" 
                        class="btn btn-default float-right btn-dashboard mb-3 font-14 decline-student-booked" 
                        @click="lessonApproval(studentInfo.lesson_schedule_id)" 
                        data-apptype="decline" v-if="studentInfo.status == 1">Decline</button>
                  </div>

                  <div class="col-lg-8 pl-0 bg-light rounded" v-if="viewStudentCalendarBooked">
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
                                disabled>{{ dta[0].time }}</button></td>
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
                    <div class="row mt-4">
                      <button type="button" 
                              class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                              v-on:click="joinClassPanel = !joinClassPanel;
                                          viewStudentCalendarBooked = !viewStudentCalendarBooked;">Ok</button>
                    </div>
                  </div>

                  <div class="col-lg-8 pl-0 bg-light rounded" v-if="stepperStudentsData">
                    <div class="pt-3 pl-3" v-for="dft in studentsData" :key="dft.id">
                      <div class="card rounded-11px">
                        <div class="card-body mt-2 ml-2">
                          <div class="row">
                            <div class="col-lg-2 text-center mt-3 pr-1">
                              <img :src="asset + 'images/ellipse-1.png'" alt="">
                            </div>
                            <div class="col-lg-10">
                              <div class="cicle-active"></div>
                                <span class="ml-4" style="font-size: 23px;"> 
                                    {{ dft.lastname.toUpperCase() }}, {{ dft.firstname.toUpperCase() }}
                                </span><br>
                                <span class="font-12 text-success"><i class="fas fa-user"></i><strong> 98%</strong></span>
                                <span class="ml-3 font-12 text-danger"><i class="fas fa-user"></i><strong> 5</strong></span>
                                <span class="ml-3 font-12 text-primary"><i class="fas fa-user"></i><strong> 10</strong></span>
                                <hr class="mb-1">
                                
                                <label for="" class="w-100 font-14">About Me</label>
                                <p class="font-14 mb-0">
                                  {{ dft.about_me }}
                                </p>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <button type="button" 
                                class="btn btn-default float-right btn-dashboard mb-3 mt-3 font-14"
                                v-on:click="joinClassPanel = !joinClassPanel
                                            stepperStudentsData = !stepperStudentsData">Okay</button>
                      </div>
                    </div>
                    

                  </div>
                  
              </div>


            <!-- </section> -->
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default btn-dashboard mb-3 font-14">Next</button>
          </div> -->
        </div>
      </div>
    </div>

    <div class="show_loading" v-if="showLoading">
      <p>
        <i class="fas fa-spinner fa-pulse"></i> Please wait..
      </p> 
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
      viewStudentCalendarBooked: false,
      stepperStudentsData: false,
      dataWeekCalendar: '',
      dataTimaAvPerDay: '',
      studentsData: '',
      form: new Form({
        email: '',
        password: '',
      }),
      studentInfo: {
        name: '',
        date: '',
        time: '',
        type_of_lesson: '',
        app_name: '',
        app_id: '',
        lesson_option_id: '',
        students_id: '',
        lesson_schedule_id: '',
        status: ''
      },
      formToSave: {
        lesson_date: [],
      },
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
      asset: document.querySelector('meta[name="url-asset"]').getAttribute('content'),
      user_id: document.querySelector('meta[name="user-id"]').getAttribute('content'),
      upcomingLessonData: '',
      sorted_date: '',
      showLoading: false
    }
  },
  methods: {
    showModalPost(){
      $('#modalWriteAPost').modal('show')
    },
    getUpcomingLesson(){
      axios.post('/heygo/get-student-booked-lesson', { 'teachers_id' : this.user_id }).then((res) => {
          this.upcomingLessonData = res.data;
        }).catch((error) => {
          console.log(error);
      });
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
    selectTimePreferred(event){
      const sorted_date = event.target.getAttribute('data-date');
      const lesson_option_id = this.studentInfo.lesson_option_id;
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
      console.log(this.sorted_date);
    },
    fnAcceptingLesson(e, students_id, lesson_schedule_id){
      axios.post('/heygo/get-booked-student-info', { 
        'lesson_date' : e, 
        'students_id': students_id,
        'lesson_schedule_id': lesson_schedule_id })
          .then((res) => {
            this.studentInfo.name               = res.data[0].fullname;
            this.studentInfo.date               = moment(new Date(res.data[0].start_date)).format('LL');
            this.studentInfo.time               = res.data[0].time_sched;
            this.studentInfo.type_of_lesson     = res.data[0].type + ' - ' + res.data[0].title;
            this.studentInfo.app_name           = res.data[0].app_name;
            this.studentInfo.app_id             = res.data[0].app_id;
            this.studentInfo.lesson_option_id   = res.data[0].lesson_option_id;
            this.studentInfo.students_id        = students_id;
            this.studentInfo.lesson_schedule_id = lesson_schedule_id;
            this.studentInfo.status             = res.data[0].status;
            this.formToSave.lesson_date         = [moment(res.data[0].start_date).format('L HH:mm'),
                                                  moment(res.data[0].end_date).format('L HH:mm')]
        }).catch((error) => {
          console.log(error);
      });
      this.fetchCalendarWeek();
      $('#modalTeacherStartLesson').modal('show');

    },
    lessonApproval(lesson_schedule_id) {
      const approval_type = event.target.getAttribute('data-apptype');
        // Adding an input method from SweetAlert 2 automatically binds an input form.
        // $swal function calls SweetAlert into the application with the specified configuration.
      Swal.fire({
        title: 'You want to ' + approval_type + ' ?',
        text: "You won't be able to revert this transaction!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#fcb017',
        cancelButtonColor: '#212222',
        confirmButtonText: 'Yes, ' + approval_type + ' it!'
      }).then((result) => {
        if (result.isConfirmed) {
          this.showLoading = true;
          axios.post('api/approve-student-booking', { 
            'lesson_schedule_id': lesson_schedule_id, 'approval_type' : approval_type })
              .then((res) => {
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Successfully ' + approval_type + '!',
                  showConfirmButton: false,
                  timer: 1500
                });
                this.showLoading = false;
                setTimeout(function(){
                  window.location.reload();
                }, 1500);
            }).catch((error) => {
              console.log(error);
          });
        } else {
        //   axios.post('/heygo/approve-student-booking', { 
        //     'lesson_schedule_id': lesson_schedule_id, 'approval_type' : approval_type })
        //       .then((res) => {
        //         Swal.fire({
        //           position: 'top-end',
        //           icon: 'success',
        //           title: 'Successfully ' + approval_type + '!',
        //           showConfirmButton: false,
        //           timer: 1500
        //         });
        //     }).catch((error) => {
        //       console.log(error);
        //   });
        }
        // $('#modalTeacherStartLesson').modal('hide');
      });
    },
    fetchTimePerDay(){
      axios.post('/heygo/get-time-available-per-day', { 'teachers_id' : this.user_id }).then((res) => {
        this.dataTimaAvPerDay = res.data;
      }).catch((error) => {
          console.log(error);
      });
    },
    testEmail(){
      axios.post('/heygo/verify-student-email', { 'email': 'dondonpentavia@gmail.com' }).then((res) => {
        // this.dataTimaAvPerDay = res.data;
      }).catch((error) => {
          console.log(error);
      });
    },
    fetchCalendarWeek(){
      axios.post('/heygo/get-week-calendar', { 'teachers_id' : this.user_id }).then((res) => {
        this.dataWeekCalendar = res.data;
      }).catch((error) => {
          console.log(error);
      });
    },
    viewCalendarBooked(){
      this.viewStudentCalendarBooked = !this.viewStudentCalendarBooked
      this.joinClassPanel = !this.joinClassPanel
    },
    getStudentData(e){
      const students_id = this.studentInfo.students_id;
      axios.get('/heygo/get-students-info/'+students_id).then((res) => {
          this.studentsData = res.data
          this.joinClassPanel = !this.joinClassPanel
          this.stepperStudentsData = !this.stepperStudentsData
        }).catch((error) => {
          console.log(error);
      });
    }
  },
  mounted() {
    this.getUpcomingLesson();
    this.fetchTimePerDay();
    
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
.decline-student-booked{
  right: 226px !important;
  position: absolute;
  bottom: 17px;
}
.cont-booked-lesson-modal{
  height: 645px !important;
}
</style>