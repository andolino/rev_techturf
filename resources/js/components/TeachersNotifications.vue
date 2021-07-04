<template>
  <div>
    <div class="card-group card-student-msg pb-1">
      <span class="font-12">Unread <span class="badge badge-danger">1</span></span>
    </div>
    <div class="card-group card-student-msg pb-1" v-for="ul in upcomingLessonData" :key="ul.lesson_id">
      <div class="card">
        <div class="card-body">
          <img :src="asset + 'images/ellipse-2.png'" alt="">
          <small class="text-muted"><strong>{{ ul.fullname }}</strong></small>
          <small class="float-right"><strong>{{ timeFormat(ul.start_date) }}</strong></small>
          <p class="font-12">{{ ul.objective_text }}</p>
        </div>
      </div>
    </div>
    
  </div>
</template>

<script>
import moment from 'moment';
export default {
  name: "TeachersNotifications",
  props: [ 'base_url' ],
  data(){
    return {
      form: new Form({
        email: '',
        password: '',
      }),
      
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
      asset: document.querySelector('meta[name="url-asset"]').getAttribute('content'),
      user_id: document.querySelector('meta[name="user-id"]').getAttribute('content'),
      upcomingLessonData: ''
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
    timeFormat(t){
      return moment(t).format('LT');
    }
  },
  mounted() {
    this.getUpcomingLesson();

    
  }
}
</script>

<style>


</style>