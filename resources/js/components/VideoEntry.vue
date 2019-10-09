<template>
    <figure class="image column is-one-third">
        <video class="entry">
            <source src="entry.videoLink">
        </video>
    </figure>
</template>

<script>
    export default {
        name: "VideoEntry",
        props: {
            entry: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>