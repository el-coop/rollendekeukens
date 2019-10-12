<template>
    <carousel :entries="albums">
        <template #default="{entry, index}">
            <figure class="image album">
                <img class="album-image" :src="entry.thumbnailLink">
            </figure>
            <div class="has-text-centered is-size-7" v-text="entry.title"></div>
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
	}
</script>

<style scoped lang="scss">
    @import "~bulma/sass/utilities/initial-variables";
    @import "~bulma/sass/utilities/functions.sass";
    @import "~bulma/sass/utilities/derived-variables";
    @import "~bulma/sass/utilities/mixins";

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
        padding: 8px;
        height: 90px;
        width: 90px;
        @include from($tablet) {
            height: 120px;
            width: 120px;
        }
    }

</style>
