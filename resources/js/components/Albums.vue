<template>
    <carousel :entries="demoEntries">
        <template #default="{entry, index}">
            <figure class="image album">
                <img class="album-image" :src="entry.thumbnailLink">
            </figure>
            <div class="has-text-centered is-size-7" v-text="index"></div>
        </template>
    </carousel>
</template>

<script>
	export default {
		name: "Albums",
		props: {
			albums: {
				type: Array,
				required: true
			}
		},

		data() {
			const demoEntries = [];

			for (let i = 0; i < 20; i++) {
				demoEntries.push(this.albums[0])
			}

			return {
				demoEntries
			}
		}
	}
</script>

<style scoped>
    .album-image {
        border-radius: 50%;
        width: 100%;
        height: 100%;
        padding: 0.18rem;
        border: 1px solid darkred;
        object-fit: cover;
        object-position: center center;
    }

    .album {
        padding: 15px;
        height: 120px;
        width: 120px;
    }

</style>
