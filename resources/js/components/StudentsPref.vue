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

    <b-modal id="modal-students-pref" size="xl" class="m-0" hide-footer="true" title="">
      <b-container class="bv-example-row">
        <b-row>
          <b-col>
            <!-- <b-img :src="asset + '/images/ellipse-1.png'"></b-img> -->
            <div class="h-100" v-bind:style="{ backgroundImage: 'url(' + bgImgStepper + ')' }">
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
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores eaque distinctio quam, et e
          </b-col>
          <b-col cols="9">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores eaque distinctio quam, et excepturi dolorem earum dolorum temporibus. Provident illum ad ex eveniet nemo excepturi quam repudiandae tenetur qui nam.
          </b-col>
        </b-row>
      </b-container>
    </b-modal>
  </div>
</template>

<script>
  export default {
    name: "StudentsPref",
    props: [ 'asset' ],
    data: {
      bgImgStepper: 'public/images/stepper-left.png',
      bgImgStudentView: 'public/images/feedback-1.png',
    },
    methods: {
      
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
</style>
