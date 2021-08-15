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

    <b-modal id="modal-students-pref" size="xl" class="m-0 p-0" hide-footer="true" title="" :hide-header="true">
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
                    :class="{ 'active' : form.students_level_id == sl.id }">
                    <input type="radio" 
                      
                      :value="sl.id" 
                      v-model="form.students_level_id" 
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
                <div class="btn-vertical btn-group-toggle text-center w-100" data-toggle="buttons">
                  <label v-for="slt in studentsLessonTypeDetails" 
                    :key="slt.id" 
                    class="btn btn-light text-left mb-2 p-3 w-100 font-14"
                    :class="{ 'active' : form.lesson_type_details_id == slt.id }">
                    <input type="radio"  
                      :value="slt.id" 
                      v-model="form.lesson_type_details_id" 
                      autocomplete="off">
                    {{ slt.body }}
                  </label>
                </div>
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
                    :class="{ 'active' : form.students_test_preparation_id == stp.id }">
                    <input type="radio" 
                      :value="stp.id" 
                      v-model="form.students_test_preparation_id" 
                      autocomplete="off">
                    {{ stp.body }}
                  </label>
                </div>
              </b-col>
            </b-row>

            <b-row class="pt-2" v-if="showStepperPrep">
              <b-col class="d-flex justify-content-center" offset="3" cols="6">
                <b-form-textarea
                    id="textarea"
                    v-model="test_prep_message"
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
        </b-row>
      </b-container>
    </b-modal>
  </div>
</template>

<script>
  export default {
    name: "StudentsPref",
    props: [ 'csrf', 'baseurl', 'asset', 'user_id' ],
    data(){
      return {
        showStepper1: true,
        showStepper2: false,
        showStepper3: false,
        showStepperPrep: false,
        bgImgStepper: 'public/images/stepper-left.png',
        bgImgStudentView: 'public/images/feedback-1.png',
        studentsLevel: '',
        studentsLessonTypeDetails: '',
        studentsEnglishLevel: '',
        studentsTestPrep: '',
        form: {
          students_level_id: '',
          lesson_type_details_id: '',
          students_test_preparation_id: '',
          test_prep_message: '',
        }
      }
    },
    methods: {
      clickStepper(ord, action){
        if (ord=='1' && action=='next') {
          this.showStepper1 = !this.showStepper1;
          this.showStepper2 = !this.showStepper2;
        }
        if (ord=='2' && action=='next') {
          this.showStepper3 = !this.showStepper3;
          this.showStepper2 = !this.showStepper2;
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
          this.studentsLessonTypeDetails = res.data;
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
          this.studentsEnglishLevel = res.data;
					}).catch((error) => {
						console.log(error);
        });
      },
      
    },
    mounted(){
      this.fnGetStudentsLevel();
      this.fnGetLessonTypeDetails();
      this.fnGetStudentsTestPrep();
      this.fnGetStudentsEnglishLevel();
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
</style>
