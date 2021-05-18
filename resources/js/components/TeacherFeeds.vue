<template>
  <div>
    <div class="row mb-2">
      <div class="col-lg-12 mb-3 inp-right-a-post">
        <div class="bg-light rounded-lg w-100 p-3" @click="showModalPost()">Create Your Post</div>
        <i class="fas fa-paper-plane cursor"></i>
      </div>
      <div class="col-lg-12 float-right">
        <form class="form-inline float-right font-12">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Filter 1</label>
          <select class="custom-select my-1 rounded mr-3 rounded-pill font-14" id="inlineFormCustomSelectPref">
            <option selected>Choose...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Filter 1</label>
          <select class="custom-select my-1 rounded mr-3 rounded-pill font-14" id="inlineFormCustomSelectPref">
            <option selected>Choose...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Filter 1</label>
          <select class="custom-select my-1 rounded rounded-pill font-14" id="inlineFormCustomSelectPref">
            <option selected>Choose...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </form>
      </div>
    </div>

    

    <div class="modal fade bd-example-modal-lg" id="modalWriteAPost" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title text-center w-100 ml-5" id="exampleModalLabel"><strong>Create Your Post!</strong></h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="m-auto">
              <p class="text-center">
                <a href="" class="text-warning font-12">Post a Question</a> &nbsp; <a href="" class="text-dark font-12">Post a Lesson Plan</a>
              </p>
            </div>
            <form>
              <div class="form-group">
                <textarea class="form-control font-14" rows="6" id="message-post" placeholder="Create you post"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <div class="row mr-auto text-light post-feed-icon">
              <div class="col-lg-1 mr-2"><a href="" class="text-light"><i class="fas fa-paperclip"></i></a></div>
              <div class="col-lg-1"><a href="" class="text-light"><i class="fas fa-camera"></i></a></div>
            </div>
            <button type="button" class="btn btn-default mb-3 font-14">Post</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
export default {
  name: 'TeacherFeeds',
  props: [ 'base_url' ],
  data(){
    return{
      form: new Form({
        email: '',
        password: '',
      }),
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
      asset: document.querySelector('meta[name="url-asset"]').getAttribute('content')
    }
  },
  methods: {
    showModalPost(){
      $('#modalWriteAPost').modal('show')
    },
    searchTeacher(){
      alert('oowa');
    }
  },
  mounted() {

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
</style>