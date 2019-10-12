<template>
    <div class="entries">
        <hr>
        <div v-for="entry in entries">
            <figure class="image">
                <img @click="open(entry)" class="entry" :src="entry.imageLink">
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
        },
        methods: {
            open(entry){
                entry.component = "album-" + entry.type;
                this.$emit('open-entry', entry);
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