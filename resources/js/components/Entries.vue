<template>
    <div class="columns is-multiline">
        <figure v-for="entry in entries" class="image column is-one-third">
            <img class="entry" :src="entry.imageLink">
        </figure>
    </div>
</template>

<script>
    export default {
        name: "Entries",
        props: {
            entries: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style scoped>
    .entry {
        width: 293px!important;
        height: 293px!important;
    }
</style>