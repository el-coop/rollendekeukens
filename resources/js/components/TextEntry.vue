<template>
    <figure class="image column is-one-third">
        <p v-text="entry.text"></p>
    </figure>
</template>

<script>
    export default {
        name: "TextEntry",
        props: {
            type: Object,
            required: true
        }
    }
</script>

<style scoped>

</style>