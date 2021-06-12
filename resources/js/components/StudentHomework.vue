<template>
  <div>
    <div class="head-upcoming-lesson bg-dark mb-0 pb-2 pt-3 pl-3">
        <h5 class="font-weight-regular">Homework 
          <span class="float-right pr-2 cursor" @click="openPurchBook" style="line-height: 1.5">
            <i class="fas fa-chevron-right"></i></span></h5></div>
    <div class="upcoming-lesson-list custom-scrollbar-css p-2 mCustomScrollbar" data-mcs-theme="minimal-dark">
      <div class="card-group b-bot-red">
        <div class="card">
          <div class="card-body">
              <label class="card-title">8:00 - 9:30am</label>
              <small class="float-right text-success">Class starts in 20mins</small>
              <h6 class="card-title font-weight-bold">Language 1</h6>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
          <div class="card-footer">
              <img :src="asset + 'images/ellipse.png'" alt="">
              <small class="text-muted">Mr. James Cameron</small>
          </div>
        </div>
      </div>
      <div class="card-group b-bot-yellow mt-2">
        <div class="card">
            <div class="card-body">
                <label class="card-title">8:00 - 9:30am</label>
                <small class="float-right text-success">Class starts in 20mins</small>
                <h6 class="card-title font-weight-bold">Language 1</h6>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
            <div class="card-footer">
                <img :src="asset + 'images/ellipse.png'" alt="">
                <small class="text-muted">Mr. James Cameron</small>
            </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade bd-example-modal-lg" id="modalBookReader" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                <div class="left-homework-tab h-100">
                  <button type="button" class="btn btn-default btn-sm w-100">Dashboard</button>
                  <hr/>
                  <div class="row thumb-w-sheet custom-scrollbar-css mCustomScrollbar" data-mcs-theme="minimal-dark">
                    <div class="col-lg-12">
                      <img :src="asset + 'images/worksheet1.png'" class="img-thumbnail cursor">
                    </div>
                    <div class="col-lg-12 mt-3">
                      <img :src="asset + 'images/worksheet1.png'" class="img-thumbnail cursor">
                    </div>
                  </div>
                </div>
                
              </div>   
              <div class="col-lg-8 pl-0">
                <div class="row m-2">
                  <div class="col-lg-12 pl-3 pt-3">
                    <button type="button" class="btn btn-default font-14"><i class="fas fa-check font-30"></i> <br> Check Answers</button>
                    <button type="button" class="btn btn-warning font-14 text-light"><i class="fas fa-save font-30"></i> <br> Check Answers</button>
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


  </div>
</template>

<script>
export default {
  props: {
    
  },
  name: 'StudentHomework',
  data(){
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
      asset: document.querySelector('meta[name="url-asset"]').getAttribute('content')
    }
  },
  methods: { 
    openPurchBook(){
      $('#modalBookReader').modal('show');
    }
  },
  mounted(){
  }
}
</script>

<style>
.left-homework-tab {
  padding: 25px;
  background: #eeede6;
  border-top-left-radius: 6px;
  border-bottom-left-radius: 6px;
}
.thumb-w-sheet{
  max-height: 700px;
  height: 600px;
}
</style>