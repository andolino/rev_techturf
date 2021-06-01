<template>
  <div>
    <div class="w-100 justify-content-center align-items-center">
      <div class="row w-100 pl-2">
          <div class="cont-account-settings col-lg-12 m-auto custom-shadow p-0 background-none">
            <div class="head-upcoming-lesson bg-dark mb-0 pb-2 pt-3 pl-3">
                <h5 class="font-weight-regular">Account Settings </h5>
            </div>
            <div v-for="dft in teachersdata" :key="dft.id">
              <div class="card rounded-11px">
                <div class="card-body mt-2 ml-2">
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
                      <p class="font-14">{{ dft.objective_text  }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </div>
</template>

<script>
export default {
  props: {
    teachersdata: {
      type: Array,
      default: [],
    }
  },
  name: 'TeachersProfile',
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
  },
  mounted() {
  }
}
</script>

<style>

</style>