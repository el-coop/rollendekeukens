<template>
    <figure class="image is-16by9">
        <iframe class="has-ratio" :src="data.entry.url"></iframe>
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
        }

    }
</script>

<style scoped>

</style>