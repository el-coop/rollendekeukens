<template>
    <carousel :entries="entries">
        <template #default="{entry, index}">
            <figure class="image album">
                <img @click="open(entry)" class="album-image" :src="entry.imageLink">
            </figure>
        </template>
    </carousel>
</template>

<script>
    import Carousel from './Carousel'

    export default {
        name: "BottomAlbum",
        components: {
            Carousel
        },
        props: {
            entries: {
                type: Array,
                required: true
            }
        },
        methods: {
            open(entry) {
                entry.component = "album-" + entry.type;
                this.$emit('open-entry', entry);
            }
        }
    }
</script>
<style scoped lang="scss">
    @import "~bulma/sass/utilities/initial-variables";
    @import "~bulma/sass/utilities/functions.sass";
    @import "~bulma/sass/utilities/derived-variables";
    @import "~bulma/sass/utilities/mixins";

    .album-image {
        width: 100%;
        height: 100%;
        padding: 0.18rem;
        object-fit: cover;
        object-position: center center;
    }

    .album {
        height: 156px;
        width: 156px;
        @include from($tablet) {
            height: 293px;
            width: 293px;
        }
    }
</style>