<template>
	<div class="user-forbidden">
		<p>404</p>
		<p v-if="user.message !=''">{{user.message}}</p>
		<button class="user-forbidden__button" @click.prevent="goBack">Tentar novamente</button>

		<LoginError :log="error"></LoginError>

	</div>
</template>
<script>
import { mapState } from 'vuex'
import LoginError from '@/components/LoginError'

export default {
	name: 'UserForbidden',
	components: {
		LoginError
	},
	computed: {
		...mapState(['user']),
		error () { return new Error('404') }
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
	.user-forbidden__button {
		margin-bottom: 2rem
	}
</style>
