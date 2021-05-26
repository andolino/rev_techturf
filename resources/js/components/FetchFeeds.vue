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
              <span class="ml-4" style="font-size: 23px;"> {{ dft.lastname.toUpperCase() }}, {{ dft.firstname.toUpperCase() }}</span>
              <span class="ml-3"><i class="fas fa-map-marker-alt text-warning p-2"></i><img :src="asset + 'images/flag-1.png'" width="20"></span>
              <span class="ml-3"><i class="fas fa-star text-warning p-2"></i><strong>4.5</strong></span>
              <span class="ml-3">43 Reviews <i class="fas fa-heart" style="color: rgb(217, 22, 132);"></i></span>
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
                    @click="fnBookATrial()">
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
                  <div class="left-stepper-tab">
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
                        <label class="btn btn-light w-100 mb-2 p-3 active">
                          <input type="radio" name="options" id="option1" autocomplete="off" checked> 
                          <span class="sc-title">Trial Lesson</span>
                          <span class="sc-sm-silent">300 Lessons</span>
                          <span class="sc-price">JPY500</span>
                        </label>
                        <label class="btn btn-light w-100 mb-2 p-3">
                          <input type="radio" name="options" id="option2" autocomplete="off"> 
                          <span class="sc-title">1 Hour Lesson</span>
                          <span class="sc-sm-silent">300 Lessons</span>
                          <span class="sc-price">JPY1,000</span>
                        </label>
                        <label class="btn btn-light w-100  p-3">
                          <input type="radio" name="options" id="option3" autocomplete="off">
                          <span class="sc-title">30 Minutes Lesson (For Elementary Level)</span>
                          <span class="sc-sm-silent">300 Lessons</span>
                          <span class="sc-price">JPY1,000</span>
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
                      <h4>Schedule</h4>
                    </div>
                    <button type="button" 
                        class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                        v-on:click="showStepper2 = !showStepper2; 
                                    showStepper3 = !showStepper3;">Next</button>
                  </div>
                  <div class="col-lg-8 pl-0" v-if="showStepper3">
                    <div class="stepper-control">
                        <h4>Booking Information</h4>
                    </div>
                    <button type="button" 
                        class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                        v-on:click="showStepper3 = !showStepper3; 
                                    showStepper4 = !showStepper4;">Next</button>
                  </div>
                  <div class="col-lg-8 pl-0" v-if="showStepper4">
                    <div class="stepper-control">
                        <h4>Choose Payment</h4>
                    </div>
                    <button type="button" 
                        class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                        v-on:click="showStepper4 = !showStepper4; 
                                    showStepper5 = !showStepper5;">Next</button>
                  </div>
                  <div class="col-lg-8 pl-0" v-if="showStepper5">
                    <div class="stepper-control">
                        <h4>Done</h4>
                    </div>
                    <button type="button" 
                        class="btn btn-default float-right btn-dashboard mb-3 font-14 stepper-next"
                        v-on:click="showStepper5 = !showStepper5">Next</button>
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
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
        asset: document.querySelector('meta[name="url-asset"]').getAttribute('content'),
        showStepper1: true,
        showStepper2: false,
        showStepper3: false,
        showStepper4: false,
        showStepper5: false
      }
    },
    methods: {
      fetchTutor(){
        axios.get('/heygo/api/get-fetch-tutor').then((res) => {
						this.dataFetchTutor = res.data
					}).catch((error) => {
						console.log(error);
        });
      },
      showTeacherProfile(id){
        window.location.href = this.baseurl + '/teachers-profile/' + id
      },
      fnBookATrial(){
        $('#modalWriteAPost').modal('show');
      },
      
    },
    mounted(){
      this.fetchTutor();
      // Get the element with id="defaultOpen" and click on it
      document.getElementById("defaultOpen").click();
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
    right: 33px;
  }
  .stepper-control{
    padding: 86px;
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
</style>