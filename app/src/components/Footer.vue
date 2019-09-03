<template>
		<footer class="foot">
			<p>Caso surjam dúvidas ou problemas técnicos, envie um e-mail para <a href="mailto:carnavalderua@prefeitura.sp.gov.br">carnavalderua@prefeitura.sp.gov.br</a></p>
			<a href="https://github.com/SPURB/participe-restrito" alt="Acesse o repositório no GitHub"><i class="icon-github icon"><span>github</span></i></a>
		</footer>
</template>

<script>
export default {
	name: 'Footer',
	computed: {}
}
</script>
<style lang="scss" scoped>
@import '@/assets/_variables.scss';

footer.foot {
	font-family: $grotesca;
	color: $preto;
	display: flex;
	flex-flow: row nowrap;
	align-items: center;
	justify-content: space-between;
	width: 100%;
	height: 80px;
	padding: 0 2rem;
	box-sizing: border-box;
	background-color: $cinza-3;
	p {
		line-height: 1.6;
		padding-right: 1rem;
		a {
			text-decoration: none;
			color: $vermelho;
			&:active { background-color: $vermelho-tr; }
		}
	}
	& > a {
		text-decoration: none;
		.icon-github.icon {
			color: $cinza-1;
			&:hover {
				color: $preto;
			}
			&::before {
				font-size: 2.5rem;
				cursor: pointer;
			}
		}
	}
	@media (max-width: 600px) {
		padding: 0 1rem;
		font-size: small;
	}
}
</style>
