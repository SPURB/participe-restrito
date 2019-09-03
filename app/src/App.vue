<template>
	<div id="app">
		<Header></Header>
		<router-view/>
		<Footer></Footer>
	</div>
</template>
<script>
import Header from '@/components/Header'
import Footer from '@/components/Footer'

export default {
	name: 'app',
	components: {
		Header,
		Footer
	}
}
</script>
<style lang="scss">
@import 'assets/icones/participe.css';
@import 'assets/icones/participe.custom.scss';

body {
	margin: 0;
	padding: 0;
}
</style>
