<template>
	<h1>{{ test }}</h1>
</template>

<script>
	export default {
		data() {
			return {
				test: ''
			}
		},

		mounted() {
			axios.get('/api/test')
				.then(response => console.log(response.data))
		}
	}
</script>