<template>
<div>
  <b-carousel
    id="carousel-1"
    v-model="slide"
    :interval="4000"
    controls
    indicators
    background="#ababab"
    img-width="1024"
    img-height="480"
    style=""
    @sliding-start="onSlideStart"
    @sliding-end="onSlideEnd"
  >
    <!-- Slides with custom text -->
    <b-carousel-slide img-src="https://picsum.photos/1024/480/?image=54">
      <div class="slider-1-cont">
        <h1>Lorem ipsum dolor sit amet consectetur</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident cumque quis repellat officia nesciunt deserunt illum aliquid laboriosam nam itaque perspiciatis perferendis ad iure esse, voluptatibus quas magnam rerum nobis.</p>
        <p>deserunt illum aliquid laboriosam nam itaque perspiciatis perferendis ad iure esse, voluptatibus quas magnam rerum nobis.</p>
        <b-button variant="warning" class="text-light font-12" @click="sampleEvt()">Get Started</b-button>
      </div>
    </b-carousel-slide>
  </b-carousel>
  <!-- <p class="mt-4">
    Slide #: {{ slide }}<br>
    Sliding: {{ sliding }}
  </p> -->

  
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
      },
      sampleEvt(){
      }
    }
  }
</script>

<style scoped>
  .carousel-caption {
    text-align: left !important;
    top: 27% !important;
  }
</style>