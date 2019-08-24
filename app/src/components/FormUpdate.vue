<template>
	<div class="form form--update">
		<form class="form" action="update" @submit.prevent="update">
			<label class="form__label" for="name">Nome do responsável</label>
			<input
				id="name"
				type="text"
				name="name"
				v-validate="'required: true'"
				:class="{ inputErro: errors.has('name') }"
			>

			<label class="form__label" for="email">Email</label>
			<input
				id="email"
				name="email"
				v-validate="'required|email'"
				:class="{ inputErro: errors.has('email') }"
				type="email"
			>
			<!-- <button class="login__button" type="submit">Cadastrar</button> -->
		</form>
	</div>
</template>
<script>

export default {
	$_veeValidate: {
		validator: 'new' // instância de validator isolado neste componente
	},
	name: 'FormUpdate',
	props: {
		formFields: {
			type: Object,
			required: true
		}
	},
	methods: {
		update (event) {
			console.log(event)
		}
	}
}
</script>
