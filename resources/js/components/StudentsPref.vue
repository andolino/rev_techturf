<template>
  <div>
    <!-- <div class="card-group mt-1 cursor" v-b-modal.modal-1>
      <div class="card">
        <div class="card-body">
          <p class="card-text">Interecative Worksheet.</p>
        </div>
      </div>
    </div> -->
    <!-- <img :src="asset + 'images/ellipse-1.png'" alt=""> -->

    <b-modal id="modal-students-pref" size="xl" class="m-0 p-0" title="" :hide-header="true" :hide-footer="true">
      <b-container class="bv-example-row p-0">
        <b-row>
          <b-col class="left-stepper-tab-ts h-100 p-0" style="
            border-radius: 0;background-repeat: no-repeat;
            background-size: cover;
            height: auto !important;" v-bind:style="{ backgroundImage: 'url(' + bgImgStepper + ')' }">
            <!-- <b-img :src="asset + '/images/ellipse-1.png'"></b-img> -->
              <h5 for="" class="lft-title-pref mb-3">First Trial Lesson</h5>
          </b-col>
          <b-col class="p-4 pt-5" cols="9" v-if="showStepper1">
            
            <h5 for="" class="text-center mb-5">1. What is the age range of the student? </h5>
            <b-row>
              <b-col cols="6" offset="3" class="d-flex justify-content-center">
                <div class="btn-vertical btn-group-toggle text-center w-100" data-toggle="buttons">
                  <label v-for="sl in studentsLevel" 
                    :key="sl.id" 
                    class="btn btn-light text-left mb-2 p-3 w-100 font-14" 
                    :class="{ 'active' : formPref.students_level_id == sl.id }">
                    <input type="radio" 
                      
                      :value="sl.id" 
                      v-model="formPref.students_level_id" 
                      autocomplete="off">
                    {{ sl.level }} {{ sl.age_range_from }} {{ (sl.age_range_to == 0 ? ' and Above' : '-' + sl.age_range_to) }}
                  </label>
                </div>
              </b-col>
            </b-row>
            <b-row class="pt-5 pr-3">
              <b-col>
                <button type="button" 
                    class="btn btn-default float-right btn-dashboard mb-3 font-14 ml-2"
                    v-on:click="clickStepper('1', 'next')">Next</button>
              </b-col>
            </b-row>
          </b-col>


          <b-col class="p-4 pt-5" cols="9" v-if="showStepper2">
            <h5 for="" class="text-center mb-5">2. Select a type of lesson (Select one or two) </h5>
            <b-row>
              <b-col cols="6" offset="3" class="d-flex justify-content-center">
                <!-- <div class="btn-vertical btn-group-toggle text-center w-100" data-toggle="buttons">
                  <label v-for="slt in studentsLessonTypeDetails" 
                    :key="slt.id" 
                    class="btn btn-light text-left mb-2 p-3 w-100 font-14"
                    :class="{ 'active' : formPref.lesson_type_details_id == slt.id }">
                    <input type="radio"  
                      :value="slt.id" 
                      v-model="formPref.lesson_type_details_id" 
                      autocomplete="off">
                    {{ slt.body }}
                  </label>
                </div> -->
                <b-form-group
                  label=""
                  v-slot="{ ariaDescribedby }"
                  class="w-100 chk-lesson-type"
                >
                  <b-form-checkbox-group
                    v-model="formPref.lesson_type_details_id"
                    :options="optionsLessonType"
                    :aria-describedby="ariaDescribedby"
                    stacked
                    buttons
                    button-variant="light text-left mb-2 p-3 font-14"
                  ></b-form-checkbox-group>
                </b-form-group>
              </b-col>

            </b-row>
            <b-row class="pt-5 pr-3">
              <b-col>
                <button type="button" 
                    class="btn btn-default float-right btn-dashboard mb-3 font-14 ml-2"
                    v-on:click="clickStepper('2', 'next')">Next</button>
                <button type="button" 
                    class="btn btn-default float-right btn-dashboard mb-3 font-14"
                    v-on:click="clickStepper('2', 'back')">Back</button>
              </b-col>
            </b-row>
          </b-col>


          <b-col class="p-4 pt-5" cols="9" v-if="showStepper3">
            <h5 for="" class="text-center mb-5">3. (IF test preparation is selected) </h5>
            <b-row>
              <b-col cols="6" offset="3" class="d-flex justify-content-center">
                <div class="btn-vertical btn-group-toggle text-center w-100" data-toggle="buttons">
                  <label v-for="stp in studentsTestPrep" 
                    :key="stp.id" class="btn btn-light text-left mb-2 p-3 w-50 font-14 border-left"
                    :class="{ 'active' : formPref.students_test_preparation_id == stp.id }">
                    <input type="radio" 
                      :value="stp.id" 
                      v-model="formPref.students_test_preparation_id" 
                      autocomplete="off"
                      @click="showPrefMsg(stp.id)">
                    {{ stp.body }}
                  </label>
                </div>
              </b-col>
            </b-row>

            <b-row class="pt-2" v-if="showStepperPrep">
              <b-col class="d-flex justify-content-center" offset="3" cols="6">
                <b-form-textarea
                    id="textarea"
                    v-model="formPref.test_prep_message"
                    size="sm"
                    placeholder="Your message..."
                    rows="7"
                    max-rows="9"
                  ></b-form-textarea>
              </b-col>
            </b-row>

            <b-row class="pt-5 pr-3">
              <b-col >
                <button type="button" 
                    class="btn btn-default float-right btn-dashboard mb-3 font-14 ml-2"
                    v-on:click="clickStepper('3', 'next')">Next</button>
                <button type="button" 
                    class="btn btn-default float-right btn-dashboard mb-3 font-14"
                    v-on:click="clickStepper('3', 'back')">Back</button>
              </b-col>
            </b-row>
          </b-col>

          <b-col class="p-4 pt-5" cols="9" v-if="showStepper4">
            <h5 for="" class="text-center mb-5">4. Current English Level </h5>
            <b-row> 
              <b-col cols="6" offset="3" class="d-flex justify-content-center">
                <b-form-group
                  label=""
                  v-slot="{ ariaDescribedby }"
                  class="w-100 chk-lesson-type">
                  <b-form-radio-group
                    v-model="formPref.students_english_level_id"
                    :options="optionsEnglishLevel"
                    :aria-describedby="ariaDescribedby"
                    stacked
                    buttons
                    button-variant="light text-left mb-2 p-3 font-14"
                  ></b-form-radio-group>
                </b-form-group>
              </b-col>
            </b-row>

            <b-row class="pt-5 pr-3">
              <b-col >
                <button type="button" 
                    class="btn btn-default float-right btn-dashboard mb-3 font-14 ml-2"
                    v-on:click="clickStepper('4', 'next')">Next</button>
                <button type="button" 
                    class="btn btn-default float-right btn-dashboard mb-3 font-14"
                    v-on:click="clickStepper('4', 'back')">Back</button>
              </b-col>
            </b-row>
          </b-col>
          
          <b-col class="p-4 pt-5" cols="9" v-if="showStepper5">
            <h5 for="" class="text-center mb-5">5. How often do you plan to take lessons? </h5>
            <b-row> 
              <b-col cols="6" offset="3" class="d-flex justify-content-center">
                <b-form-group
                  label=""
                  v-slot="{ ariaDescribedby }"
                  class="w-100 chk-lesson-type">
                  <b-form-radio-group
                    v-model="formPref.students_date_plan_id"
                    :options="optionsStudentsDatePlan"
                    :aria-describedby="ariaDescribedby"
                    stacked
                    buttons
                    button-variant="light text-left mb-2 p-3 font-14"
                  ></b-form-radio-group>
                </b-form-group>
              </b-col>
            </b-row>

            <b-row class="pt-5 pr-3">
              <b-col >
                <button type="button" 
                    class="btn btn-default float-right btn-dashboard mb-3 font-14 ml-2"
                    v-on:click="clickStepper('5', 'next')">Done</button>
                <button type="button" 
                    class="btn btn-default float-right btn-dashboard mb-3 font-14"
                    v-on:click="clickStepper('5', 'back')">Back</button>
              </b-col>
            </b-row>
          </b-col>


        </b-row>
      </b-container>
    </b-modal>
  </div>
</template>

<script>
  export default {
    name: "StudentsPref",
    props: [ 'csrf', 'baseurl', 'asset', 'user_id', 'teachers_id', 'fnBookATrial'],
    data(){
      return {
        showStepper1: true,
        showStepper2: false,
        showStepper3: false,
        showStepper4: false,
        showStepperPrep: false,
        showStepper5: false,
        bgImgStepper: 'public/images/stepper-left.png',
        bgImgStudentView: 'public/images/feedback-1.png',
        studentsLevel: '',
        studentsLessonTypeDetails: '',
        studentsTestPrep: '',
        ariaDescribedby: '',
        formPref: {
          students_level_id: '',
          lesson_type_details_id: [],
          students_test_preparation_id: '',
          test_prep_message: '',
          students_english_level_id: '',
          students_date_plan_id: '',
          students_id: '',
          _token: this.csrf
        },
        selectedLessonType: [], // Must be an array reference!
        optionsLessonType: [],
        optionsEnglishLevel: [],
        optionsStudentsDatePlan: [],
      }
    },
    methods: {
      clickStepper(ord, action){
        if (ord=='1' && action=='next') {
          this.showStepper1 = !this.showStepper1;
          this.showStepper2 = !this.showStepper2;
        }
        if (ord=='2' && action=='next') {
          if (this.formPref.lesson_type_details_id.includes(3)) {
            this.showStepper3 = !this.showStepper3;
            this.showStepper2 = !this.showStepper2;
          } else {
            this.showStepper4 = !this.showStepper4;
            this.showStepper2 = !this.showStepper2;
            this.formPref.students_test_preparation_id = '';
          }
        }
        if (ord=='2' && action=='back') {
          this.showStepper1 = !this.showStepper1;
          this.showStepper2 = !this.showStepper2;
        }
        if (ord=='3' && action=='next') {
            this.showStepper4 = !this.showStepper4;
            this.showStepper3 = !this.showStepper3;
        }
        if (ord=='3' && action=='back') {
          this.showStepper3 = !this.showStepper3;
          this.showStepper2 = !this.showStepper2;
        }
        if (ord=='4' && action=='next') {
          this.showStepper5 = !this.showStepper5;
          this.showStepper4 = !this.showStepper4;
        }
        if (ord=='4' && action=='back') {
          if (this.formPref.lesson_type_details_id.includes(3)) {
            this.showStepper4 = !this.showStepper4;
            this.showStepper3 = !this.showStepper3;
          } else {
            this.showStepper4 = !this.showStepper4;
            this.showStepper2 = !this.showStepper2;
            this.formPref.students_test_preparation_id = '';
          }
        }
        if (ord=='5' && action=='next') {
          // this.showStepper5 = !this.showStepper5;
          // this.showStepper4 = !this.showStepper4;
          //console.log(this.formPref);
          Swal.fire({
            title: 'Are you sure?',
            text: "Note: lorem ipsum",
            icon: 'question',
            showCancelButton: true, 
            confirmButtonColor: '#df9509',
            cancelButtonColor: '#353333',
            cancelButtonText: 'Wait',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.isConfirmed) {
              // this.joinClassPanel = !this.joinClassPanel;
              this.formPref.teachers_id = this.teachers_id;
              axios.post('/heygo/save-student-pref', this.formPref).then((res) => {
                this.$bvModal.hide('modal-students-pref');
                this.fnBookATrial(this.teachers_id);
                console.log(res);
                }).catch((error) => {
                  console.log(error);
              });
            }
          });
          
        }
        if (ord=='5' && action=='back') {
          this.showStepper4 = !this.showStepper4;
          this.showStepper5 = !this.showStepper5;
        }
      },
      fnGetStudentsLevel(){
        //get the teachers_id
        axios.get('/heygo/get-students-level').then((res) => {
          this.studentsLevel = res.data;
					}).catch((error) => {
						console.log(error);
        });
      },
      fnGetLessonTypeDetails(){
        //get the teachers_id
        axios.get('/heygo/get-lesson-type-details').then((res) => {
          this.optionsLessonType = res.data;
					}).catch((error) => {
						console.log(error);
        });
      },
      fnGetStudentsTestPrep(){
        //get the teachers_id
        axios.get('/heygo/get-test-student-preparation').then((res) => {
          this.studentsTestPrep = res.data;
					}).catch((error) => {
						console.log(error);
        });
      },
      fnGetStudentsEnglishLevel(){
        //get the teachers_id
        axios.get('/heygo/get-students-english-level').then((res) => {
          this.optionsEnglishLevel = res.data;
					}).catch((error) => {
						console.log(error);
        });
      },
      fnGetStudentsDatePlan(){
        //get the teachers_id
        axios.get('/heygo/get-students-date-plan').then((res) => {
          this.optionsStudentsDatePlan = res.data;
					}).catch((error) => {
						console.log(error);
        });
      },
      showPrefMsg(v){
        if (v==12) {
          this.showStepperPrep = !this.showStepperPrep;
        }
      }
    },
    mounted(){
      this.fnGetStudentsLevel();
      this.fnGetLessonTypeDetails();
      this.fnGetStudentsTestPrep();
      this.fnGetStudentsEnglishLevel();
      this.fnGetStudentsDatePlan();
      this.formPref.students_id = this.user_id;
      this.$root.$refs.StudentsPref = this;
    }
  }
</script>
<style>
.left-stepper-tab-ts {
  padding: 50px;
  border-top-left-radius: 6px;
  border-bottom-left-radius: 6px;
  background-repeat: no-repeat;
}
#modal-students-pref .modal-body {
  padding-bottom: 0;
  padding-top: 0;
}
.lft-title-pref {
  font-size: 25px !important;
  font-weight: 600;
  color: #fff;
  margin-top: 26px;
  text-align: center;
}
.chk-lesson-type{
  background: none !important;
}
.btn-group-vertical{
  width: 100%;
}
</style>
