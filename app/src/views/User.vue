<template>
	<div class="user login">
		<form class="login__form" action="login" @submit.prevent="checkUser" v-if='!logged'>
			<label class="login__label" for="password">Senha</label>
			<input class="login__input" type="password" id="password" name="password" v-model='password'>
			<button class="login__button" type="submit">login</button>
		</form>

		<p class="login__status" v-if="api.message !== ''">{{api.message}}</p>

		<router-view></router-view>
	</div>
</template>

<script>
import api from '../utils/api'
import md5 from 'js-md5'
import { mapState } from 'vuex'

export default {
	name: 'user',
	data () {
		return {
			password: '',
			api: {
				message: ''
			}
		}
	},
	computed: {
		...mapState(['logged'])
	},
	methods: {
		checkUser (event) {
			const body = new URLSearchParams({ // converte para x-www-form-urlencoded
				'usrk': md5(this.password)
			})

			api.post('/', body)
				.then(res => {
					this.api.message = res.data.message
					console.log(res)
				})
				.catch(err => console.error(err))
		}
	}
}
</script>

<style lang="scss" scoped>
@import '../assets/FORM';
</style>
