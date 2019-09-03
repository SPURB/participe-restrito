<template>
	<div class="mapa" id="mapa">
	</div>
</template>

<script>
import { Map, View } 	from 'ol'
import TileLayer 		from 'ol/layer/Tile'
import VectorLayer 		from 'ol/layer/Vector'
import Style 			from 'ol/style/Style'
import Stroke 			from 'ol/style/Stroke'
import Fill 			from 'ol/style/Fill'
import KML 				from 'ol/format/KML'
import VectorSource 	from 'ol/source/Vector'
import OSM				from 'ol/source/OSM'

export default {
	name: 'Mapa',
	data () {
		return {}
	},
	mounted () {
		var map = new ol.Map({
		  target: 'mapa',
		  layers: [
		    new ol.layer.Tile({
		      source: new ol.source.OSM()
		    })
		  ],
		  view: new ol.View({
		    center: ol.proj.fromLonLat([37.41, 8.82]),
		    zoom: 4
		  })
		});
	}
}
</script>

<style lang="scss" scoped>
@import '@/assets/_variables.scss';
.mapa {}
</style>
