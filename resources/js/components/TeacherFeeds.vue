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
            <vue-dropzone 
              ref="myVueDropzone" 
              id="dropzone" 
              :options="dropzoneOptions"
              @vdropzone-complete="afterUploadComplete"
              @vdropzone-sending-multiple="sendTeacherFeeds"></vue-dropzone>
            <form>
              <div class="form-group mt-3">
                <textarea v-model="post_msg" class="form-control font-14" rows="6" id="message-post" placeholder="Create you post"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <div class="row mr-auto text-light post-feed-icon">
              <div class="col-lg-1 mr-2"><a href="" class="text-light"><i class="fas fa-paperclip"></i></a></div>
              <div class="col-lg-1"><a href="" class="text-light"><i class="fas fa-camera"></i></a></div>
            </div>
            <button type="button" @click="postTeacherFeed" class="btn btn-default mb-3 font-14">Post</button>
          </div>
        </div>
      </div>
    </div>

    <div class="mb-3" v-for="pfd in postedFeedsData" :key="pfd.id">
      <div class="card rounded-11px">
        <div class="card-body mt-1">
          <div class="row">
            <div class="col-lg-2 text-center mt-3 pr-1">
              <img :src="asset + 'images/ellipse-1.png'" alt="">
            </div>
            <div class="col-lg-10">
              <div class="cicle-active"></div>
              <div class="row">
                <div class="col-lg-7">
                  <span class="ml-4" style="font-size: 23px;"> 
                   {{ pfd.lastname.toUpperCase() }}, {{ pfd.firstname.toUpperCase() }}</span>
                </div>
                <div class="col-lg-5">
                  <span class="ml-3" style="float: right;">
                    {{ moment(new Date(pfd.created_at)).format('LLL') }}
                  </span>
                </div>
              </div>
              <hr>
              <!-- <span class="ml-3">
                43 Reviews 
                <i class="fas fa-heart" style="color: rgb(217, 22, 132);"></i></span> -->
              <div class="row">
                <div class="col-lg-9">
                  {{ pfd.feed_body }}
                </div>
              </div>
              <div class="row">
                <div class="col-lg-7">
                  {{ displayAttachments(pfd.attmnts) }}
                  <div class="row">
                    <div class="col-lg-4" v-for="(item, index) in dataAttachments" :key="index">
                      <a :href="baseurl + '/uploads/teachers-feeds/' + item" class="font-12 text-black-50"  download>Attachment {{ index + 1 }}</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="card-footer">
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
          <hr>
          <div class="row">
            <div class="col-lg-1 pl-1 text-right">
              <img :src="asset + 'images/ellipse.png'" alt="">
            </div>
            <div class="col-lg-10 text-right pl-1 pr-1count-feeds-like">
              <input type="text" class="form-control form-control-sm font-12">
            </div>
            <div class="col-lg-1 text-left pr-1 count-feeds-comment">
              <a href="#" class="text-black-50"><i class="fas fa-paper-plane text-warning" style="position: relative;
                                                                                                  right: 56px;
                                                                                                  font-size: 12px;
                                                                                                  top: 2px;"></i></a>
            </div>
            
          </div>
        </div>
      </div>
    </div>

    

  </div>
</template>

<script>
import moment from 'moment';
import vue2Dropzone from 'vue2-dropzone';
export default {
  name: 'TeacherFeeds',
  components: {
    vueDropzone: vue2Dropzone
  },
  // props: [ 'base_url' ],
  // props: {
  //   findtutor: {
  //     type: Array,
  //     default: [],
  //   }
  // },
  data(){ 
    return{
      form: new Form({
        email: '',
        password: '',
      }),
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
      asset: document.querySelector('meta[name="url-asset"]').getAttribute('content'),
      user_id: document.querySelector('meta[name="user-id"]').getAttribute('content'),
      dropzoneOptions: {
        url: document.querySelector('meta[name="base-url"]').getAttribute('content') + '/api/post-teacher-feeds', // 'https://httpbin.org/post',
        thumbnailWidth: 150,
        maxFilesize: 2,
        parallelUploads: 3,
        maxFiles: 10,
        uploadMultiple: true,
        addRemoveLinks: true,
        autoProcessQueue: false,
        thumbnailWidth: "100",
        thumbnailHeight: "100"
      },
      post_msg: '',
      postedFeedsData: '',
      moment: moment,
      dataAttachments: {
        type: Array,
        default: [],
      }
    }
  },
  methods: {
    showModalPost(){
      $('#modalWriteAPost').modal('show')
    },
    searchTeacher(){
      alert('oowa');
    },
    displayTeacherFeeds(){
      axios.post('/heygo/display-teacher-feeds', { 'teachers_id' : this.user_id }).then((res) => {
          this.postedFeedsData = res.data;
          // console.log(this.postedFeedsData);
        }).catch((error) => {
          console.log(error);
      });
    },
    afterUploadComplete: async function(response){
      console.log(response);
      if (response.status =="success") {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Updaload successfully',
          showConfirmButton: false,
          timer: 2000
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
            window.location.reload();
          }
        });
      } else {
        Swal.fire({
          position: 'top-end',
          icon: 'warning',
          title: 'Updaload failure',
          showConfirmButton: false,
          timer: 1500
        });
      }
    },
    sendTeacherFeeds: async function (files, xhr, formData){
      formData.append('feed_body', this.post_msg);
      formData.append('teacher_id', this.user_id);
    },
    postTeacherFeed: async function(){
      this.$refs.myVueDropzone.processQueue();
    },
    displayAttachments(f){
      if (typeof f !== 'object') {
        var arr = f.split('==');
        this.dataAttachments = arr; 
      }
    }
  },
  mounted() {
    this.displayTeacherFeeds();
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