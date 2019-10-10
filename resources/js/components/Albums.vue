<template>
    <div class="section is-flex">
        <div v-for="album in albums">
            <figure class="image is-87x87">
                <img class="album" :src="album.thumbnailLink">
            </figure>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Albums",
        props: {
            albums: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style scoped>
    .album {
        border-radius: 50%;
        width: 100%;
        height: 100%;
        padding: 0.18rem;
        border: 1px solid darkred;
    }
    .image.is-87x87 {
        height: 140px;
        width: 140px;
        padding: 1rem;
    }
</style>