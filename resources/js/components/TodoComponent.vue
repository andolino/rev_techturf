<template>
	<div class="w-25">
		<form @submit.prevent="saveData">
			<div class="input-group mb-3 w-100">
				<input v-model="form.title" type="text" name="title" class="form-control form-control-lg"/>
				<div class="input-group-append">
					<button class="btn btn-success" type="submit" id="button-addon2">Add this to your list</button>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
    export default {
			data(){
				return{
					form: new Form({
						title: '',
					})
				}
			},
			methods: {
				saveData(){
					let data = new FormData();
					data.append('title', this.form.title)
					axios.post('/api/todo', data)
				},
			},
			mounted() {
			},
	  }
</script>
