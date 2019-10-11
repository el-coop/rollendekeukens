<template>
    <div class="entries">
        <hr>
        <div v-for="entry in entries">
            <figure class="image">
                <img class="entry" :src="entry.imageLink">
            </figure>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AlbumEntries",
        props: {
            entries: {
                type: Array,
                required: true
            }
        }
    }
</script>

<style scoped>
.entries {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
}
</style>