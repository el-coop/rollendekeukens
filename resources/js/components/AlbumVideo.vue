<template>
    <figure class="image is-16by9" :class="{'is-loading': loading}">
        <iframe class="has-ratio" :src="data.entry.url" @load="loaded"/>
    </figure>
</template>

<script>
	export default {
		name: "AlbumVideo",
		props: {
			data: {
				type: Object,
				required: true
			}
		},

		data() {
			return {
				loading: true
			}
		},
		methods: {
			loaded() {
				this.loading = false;
			}
		}

	}
</script>
