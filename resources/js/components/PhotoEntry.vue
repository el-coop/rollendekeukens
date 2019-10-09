<template>
    <figure class="image column is-one-third">
        <img class="entry" :src="entry.imageLink">
    </figure>
</template>

<script>
    export default {
        name: "PhotoEntry",
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