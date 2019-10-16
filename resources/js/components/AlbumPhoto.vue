<template>
    <figure class="image">
        <img :src="`storage/${data.image}`">
    </figure>
</template>

<script>
	export default {
		name: "AlbumPhoto",
		props: {
			data: {
				type: Object,
				required: true
			}
		}
	}
</script>
