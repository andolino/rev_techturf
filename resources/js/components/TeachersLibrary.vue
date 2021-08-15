<template>
  <div>
    <div class="head-upcoming-lesson bg-dark mb-0 pb-2 pt-3 pl-3"><h5 class="font-weight-regular">Library <span class="float-right pr-2" style="line-height: 1.5"><i class="fas fa-chevron-right"></i></span></h5></div>
    <div class="homework-list custom-scrollbar-css p-2 mCustomScrollbar" data-mcs-theme="minimal-dark" style="max-height: 153px;height: 153px;">
      <div class="card-group cursor">
        <div class="card">
          <div class="card-body">
            <p class="card-text">Bought Books</p>
          </div>
        </div>
      </div>
      <div class="card-group mt-1 cursor" v-b-modal.modal-1>
        <div class="card">
          <div class="card-body">
            <p class="card-text">Interecative Worksheet.</p>
          </div>
        </div>
      </div>
    </div>
    <b-modal id="modal-1" size="xl" class="m-0" hide-footer="true" title="< Dashboard">
      <b-container class="bv-example-row">
        <b-row>
          <b-col>
            <b-button variant="warning" class="font-12 w-100 mb-2">Create Worksheet</b-button>
            <b-button variant="warning" class="font-12 w-100 mb-2">View Own Worksheet</b-button>
            <b-button variant="warning" class="font-12 w-100 mb-2">Booked Worksheet</b-button>
            <b-button variant="warning" class="font-12 w-100">Check Student's Workshee</b-button>
          </b-col>
          <b-col cols="9">
            <b-row>
              <b-col>
                <b-input-group
                  size="sm"
                  class="mb-3"
                >
                  <b-form-input placeholder="Advance search" class="font-12"></b-form-input>
                  <b-input-group-append>
                    <b-button size="sm" text="Button" class="font-12" variant="default">Search</b-button>
                  </b-input-group-append>
                </b-input-group>
              </b-col>
              <b-col cols="7"></b-col>
            </b-row>
            <b-card
                title=""
                img-src=""
                img-alt="Image"
                img-top
                tag="article"
                style=""
                class="mb-2"
              >
                <div class="flexbox">
                  <Board id="board-1">
                    <Card id="card-1" draggable="true">
                      <p>Card one</p>
                    </Card>
                  </Board>

                  <Board id="board-2">
                    <Card id="card-2" draggable="true">
                      <p>Card two</p>
                    </Card>
                  </Board>
                </div>
                
                <b-card-text>
                  
                </b-card-text>

              </b-card>
          </b-col>
        </b-row>
      </b-container>
    </b-modal>
  </div>
</template>

<script>
import moment from 'moment';
import Board from './Board';
import Card from './Card';
  export default {
    props: {},
    name: 'TeachersLibrary',
    components: {
      Board,
      Card
    },
    data(){
      return {
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
        asset: document.querySelector('meta[name="url-asset"]').getAttribute('content'),
        user_id: document.querySelector('meta[name="user-id"]').getAttribute('content')
      }
    },
    methods: {
      
    },
    mounted(){
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
  .modal-header{
    margin: 0 !important;
    width: 100% !important;
  }
</style>