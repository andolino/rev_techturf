<template>
  <div>
    
  </div>
</template>

<script>
  export default {
    data() {
      return {
        slide: 0,
        sliding: null
      }
    },
    methods: {
      onSlideStart(slide) {
        this.sliding = true
      },
      onSlideEnd(slide) {
        this.sliding = false
      }
    }
  }
</script>

<style scoped>
  .bv-example-row{
    position: absolute;
    bottom: 205px;
    color:rgb(37, 37, 37);
  }
  .available-lesson-title{
    margin-bottom: 25px;
  }
  .card{
    border:0;
  }
  .carousel-indicators li {
    background-color: #6f6d6d !important;
  }

</style>