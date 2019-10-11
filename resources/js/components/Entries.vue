<template>
    <div class="columns is-mobile is-multiline is-gapless">
        <hr>
        <div v-for="entry in entries" class="column is-one-third">
            <figure  class="image ">
                <img class="entry" :src="entry.imageLink">
            </figure>
        </div>
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

</style>