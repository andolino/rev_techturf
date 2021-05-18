<template>
  <div>
    <div v-for="dft in findtutor" :key="dft.id" class="mb-3">
      <div class="card rounded-11px">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-1">
              <img :src="asset + 'images/ellipse-3.png'" alt="">
            </div>
            <div class="col-lg-11 pl-0">
              <div class="cicle-active"></div>
              <h4 class="ml-4"> James Cameron {{ dft.email }}</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis saepe modi, molestiae ad 
                illum nihil at corrupti a, excepturi expedita repellendus quae vel possimus consequuntur rem! Ipsam itaque quis ex.</p>
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
        asset: document.querySelector('meta[name="url-asset"]').getAttribute('content')
      }
    },
    methods: {
      fetchTutor(){
        axios.get('/heygo/api/get-fetch-tutor').then((res) => {
						this.dataFetchTutor = res.data
					}).catch((error) => {
						console.log(error);
        });
      }
    },
    mounted(){
      this.fetchTutor();
    }
  }
</script>

<style>

</style>