<template>
		<div class="login__error">
			<h1>Ocorrreu um erro ao tentar enviar. Confirme seus dados e tente novamente.</h1>
			<p class="login__error--message">Caso o erro persista, solicite o acesso através do e-mail <a href="mailto:carnavalderua@prefeitura.sp.gov.br?subject=Cadastro%20de%20Blocos%20Carnaval%202020">carnavalderua@prefeitura.sp.gov.br</a> ou tente mais tarde.</p>
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
@import '@/assets/_variables.scss';

.login__error {
	font-family: $grotesca;
	box-sizing: border-box;
	margin: 1rem auto;
	padding: 0 1rem;
	color: $preto;
	width: 100%;
	line-height: 1.6;
	text-align: center;
	h1 {
		font-size: 1rem;
		font-weight: normal;
		margin: 0;
	}
	.login__error--message {
		font-size: small;
		color: $cinza-1;
		margin: 0.5rem 0;
		a {
			text-decoration: none;
			color: $vermelho;
		}
	}
	.login__error--log {
		font-size: small;
		color: $sombra-3;
		margin: 0;
	}
}
</style>
