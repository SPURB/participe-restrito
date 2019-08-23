<template>
		<div class="login__error">
			<h4>Erro!</h4>
			<p class="login__error--message">Solicite o acesso para <a href="mailto:...@email.com?subject=Cadastro%20de%20Blocos%20Carnaval%202020">...@prefeitura.sp.gov.br</a> ou tente mais tarde</p>
			<p class="login__error--log">{{ log }}</p>
		</div>
</template>

<script>
export default {
	name: 'LoginError',
	props: {
		log: {
			required: true,
			type: Error
		}
	}
}
</script>
<style lang="scss" scoped>
.login__error {
	border: solid 1px red;
	padding: 1rem;
}
</style>
