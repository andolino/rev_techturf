<template>
  <div>
    <h5>Add Availability Date</h5>
    <b-card
      title=""
      img-top
      tag="article"
      style="font-size:14px;"
      class="mb-2"
    >
      <b-row class="w-100">
        <b-col>
          <b-row>
            <b-col>
              <label for="" class="font-12">Time Start</label>
              <datetime format="YYYY-MM-DD H:i:s" width="" v-model="form.time_start"></datetime>  
            </b-col>
          </b-row>
          <b-row>
            <b-col>
              <label for="" class="font-12">Time End</label>
              <datetime format="YYYY-MM-DD H:i:s" width="" v-model="form.time_end"></datetime>
            </b-col>
          </b-row>
          <b-row>
            <b-col>
              <label for="" class="font-12" data-tooltip="test">Status</label>
              <b-form-select v-model="form.selected_status" class="rounded-0 font-12" :options="status_options" size="sm"></b-form-select>
            </b-col>
          </b-row>
          <b-row>
            <b-col>
              <b-card-text></b-card-text>
              <div v-if="addAvailDateTime">
                <b-button href="#" @click="saveAddTeacherAvailability" variant="default" class="font-12">Add</b-button>
              </div>
              <div v-else>
                <b-button href="#" variant="default" class="font-12" @click="saveAddTeacherAvailability">Update</b-button>
                <b-button href="#" variant="default" class="font-12" @click="addAvailDateTime = !addAvailDateTime; form.teacher_availability_id = null">Cancel</b-button>
              </div>
            </b-col>
          </b-row>
        </b-col>
        <b-col cols="9">
          <label for=""></label>
          <Fullcalendar ref="calendar" :options="calendarOptions"/>
        </b-col>
      </b-row>
      <!-- <b-row>
        <b-col>
          <label for="" class="font-12">Type of Lesson</label>
          <select 
            class="custom-select custom-select-sm font-12 rounded-0" 
            id="lesson_plan_id"
            v-model="form.lesson_plan_id">
            <optgroup v-for="(group, name) in lessonPlan" :label="name" :key="group.id">
              <option v-for="option in group" :value="option.id" :key="option.id">
                {{ option.body }}
              </option>
            </optgroup>
          </select>
        </b-col>
      </b-row> -->
      <b-row>
        <b-col>
          
        </b-col>
      </b-row>
      

    </b-card>
    
    
  </div>
</template>

<script>
  import moment from 'moment';
  import Fullcalendar from "@fullcalendar/vue";
  import dayGridPlugin from "@fullcalendar/daygrid";
  import interactionPlugin from "@fullcalendar/interaction";
  import timeGridPlugin from "@fullcalendar/timegrid";
  import axios from "axios";
  import datetime from 'vuejs-datetimepicker';

  export default {
    props: {},
    components: {
      Fullcalendar, datetime
    },
    name: 'TeachersCalendar',
    data(){
      return {
        lessonPlan: [],
        form: {
          // lesson_plan_id: '',
          time_start: "",
          time_end: "",
          selected_status: null,
          teacher_availability_id: null,
          user_id: '',
        },
        status_options: [
          { value: 0, text: 'Open' },
          { value: 3, text: 'Closed' }
        ],
        addAvailDateTime: true,
        calendarOptions: {
          plugins: [ dayGridPlugin, interactionPlugin, timeGridPlugin ],
          initialView: 'timeGridWeek',
          navLinks: true, // can click day/week names to navigate views
          // editable: true,
          selectable: true,
          nowIndicator: true,
          dayMaxEvents: true, // allow "more" link when too many events
          expandRows: true,
          contentHeight: '4000px',
          events: [],
          // eventColor: '#fff',
          eventContent: function (arg, createElement){
            let ht = '';
                ht+='<div class="card" style="height:100%;">';
                  ht+='<div class="card-body pt-2 pr-3 pl-3 pb-3">';
                    ht+='<h6 class="card-title">'+arg.timeText+'</h6>';
                    // ht+='<p class="card-subtitle mb-2 text-muted">'+arg.event.title+'</p>';
                    ht+='<small class="text-muted">'+arg.event.extendedProps.status_text+'</small>';
                  ht+='</div>';
              ht+='</div>';
            arg.backgroundColor = 'rgba(0, 0, 0, 0)';
            arg.borderColor = 'rgba(0, 0, 0, 0)';
            arg.textColor = '#000';
            return { html: ht } 
          },
          eventClick: (calEvent, jsEvent, view) => {
            //if status is OPEN or ClOSED you can update your date availability
            if (calEvent.event.extendedProps.status == 0 || calEvent.event.extendedProps.status == 3) {
              this.addAvailDateTime = false;
              this.form.teacher_availability_id = calEvent.event.id;
              this.form.time_start = moment(calEvent.event.start).format('YYYY-MM-DD HH:mm:ss');
              this.form.time_end = moment(calEvent.event.end).format('YYYY-MM-DD HH:mm:ss');
              this.form.selected_status = calEvent.event.extendedProps.status;
              // this.form.lesson_plan_id = calEvent.event.extendedProps.lesson_plan_id;
            }
          },
        },
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
        asset: document.querySelector('meta[name="url-asset"]').getAttribute('content'),
        user_id: document.querySelector('meta[name="user-id"]').getAttribute('content')
      }
    },
    methods: {
      getTeachersAvailability(){
        axios.get('/heygo/get-teachers-availability', { 'teachers_id' : this.user_id }).then((res) => {
            this.calendarOptions.events = res.data[0];
          }).catch((error) => {
            console.log(error);
        });
      },
      getLessonPlan(){
        axios.get('/heygo/get-lesson-plan', { 'user_id': this.user_id }).then((res) => {
          this.lessonPlan = res.data;
        }).catch((error) => {});
      },
      saveAddTeacherAvailability(){
        Swal.fire({
          title: 'Adding this to your availability?',
          text: "",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#fcb017',
          cancelButtonColor: '#212222',
          confirmButtonText: 'Yes'
        }).then((result) => {
          if (result.isConfirmed) {
            axios.post('/heygo/save-teacher-availability', this.form ).then((res) => {
              this.calendarOptions.events = res.data[0];
              // this.$refs.calendar.$emit('rerenderEvents');
              }).catch((error) => {
                console.log(error);
            });
          } else {
            
          }
        });
      }
    },

    mounted(){
      this.form.user_id = this.user_id;
      this.getLessonPlan();
      this.getTeachersAvailability();
    }
  }
</script>


<style>
  .year-month-wrapper {
    background: #fcb017 !important;
  }
  .month-setter > .nav-r, .month-setter > .nav-l {
    background: #fcb017 !important;
  }
  .activePort {
    background: #fcb017 !important;
  }
  .scroll-hider ul {
    width: 62px !important;
  }
  .scroll-hider li.active {
    background: #fcb017 !important;
  }
</style>