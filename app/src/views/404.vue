<template>
	<div class="user-forbidden">
		<p>404</p>
		<p v-if="user.message !=''">{{user.message}}</p>
		<button @click.prevent="goBack">Tentar novamente</button>
	</div>
</template>
<script>
import { mapState } from 'vuex'

export default {
	name: 'UserForbidden',
	computed: {
		...mapState(['user'])
	},
	methods: {
		goBack () { this.$router.go(-1) }
	}
}
</script>
<style lang="scss">
	.user-forbidden {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		height: 100vh;
	}
</style>
