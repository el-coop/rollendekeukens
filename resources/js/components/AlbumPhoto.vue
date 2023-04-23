<template>
    <figure class="image">
        <img :src="entrySrc(data)">
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
		},

        methods: {
            entrySrc(entry) {
                if (entry.image.indexOf('http') === 0) {
                    return entry.image;
                }

                return `storage/${entry.image}`;
            }
        }

    }
</script>
