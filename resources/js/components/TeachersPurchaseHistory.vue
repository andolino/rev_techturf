<template>
  <div>
    <h3>Hello</h3>
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
  name: 'TeachersPurchaseHistory',
  data(){
    return{
      form: new Form({
        email: '',
        password: '',
      }),
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      baseurl: document.querySelector('meta[name="base-url"]').getAttribute('content'),
      asset: document.querySelector('meta[name="url-asset"]').getAttribute('content'),
      purchases: {
        
      }
    }
  },
  methods: {
  },
  mounted() {
  }
}
</script>
