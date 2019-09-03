<template>
	<div class="user-forbidden">
		<main>
			<h1>404</h1>
			<p v-if="user.message !=''">{{ user.message }}</p>
			<p>usuário inválido</p>
		</main>
		<button class="user-forbidden__button login__button" @click.prevent="goBack"><i class="icon-seta_esquerda icon"><span>seta_esquerda</span></i></button>

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
<style lang="scss" scoped>
@import '@/assets/_variables.scss';

.user-forbidden {
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	min-height: calc(100vh - 140px);
	main {
		font-family: $grotesca;
		color: $preto;
		text-align: center;
		border-radius: 4px;
		margin: 0 0 1.5rem;
		h1 {
			margin: 0;
			font-size: 1rem;
		}
		p {
			font-size: small;
			color: $vermelho-tr;
			margin: 0;
		}
	}
}
</style>
