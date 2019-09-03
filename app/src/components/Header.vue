<template>
		<header class="head">
			<div class="logged">
				<i class="icon-pessoa-outline icon"><span>pessoa-outline</span></i>
				<span>{{ userEmail }}</span>
			</div>
			<h1><span>participe</span>.gestaourbanaSP</h1>
			<img class="logo" src="https://participe.gestaourbana.prefeitura.sp.gov.br/arquivos/img/PMSP_horizontal_cor_pos.png" alt="Prefeitura de São Paulo">
		</header>
</template>

<script>
export default {
	name: 'Header',
	computed: {
		userEmail () { return this.$route.params.email }
	}
}
</script>
<style lang="scss" scoped>
@import '@/assets/_variables.scss';

header.head {
	display: grid;
	grid-template-columns: 1fr 2fr 1fr;
	align-items: center;
	width: 100%;
	height: 60px;
	box-sizing: border-box;
	padding: 0 2rem;
	font-family: $grotesca;
	font-size: 16px;
	color: $preto;
	background-color: $cinza-3;
	box-shadow: 0 4px 4px $sombra-3;
	z-index: 1;
	div.logged * {
		color: $cinza-2;
		display: inline-block;
		vertical-align: middle;
		&.icon { margin-right: 0.25rem; }
	}
	h1 {
		display: inline-block;
		text-align: center;
		font-weight: normal;
		font-size: 1.5rem;
		span {
			display: inline;
			font-weight: 700;
		}
	}
	img.logo {
		height: 32px;
		justify-self: end;
	}
	@media (max-width: 600px) {
		padding: 0 1rem;
		div.logged span { display: none; }
		h1 { font-size: 1rem; }
		img.logo { display: none; }
	}
}
</style>