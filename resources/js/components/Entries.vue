<template>
    <div class="columns is-multiline">
        <component v-for="entry in entries" :is="entry.type + '-entry'" :key="entry.id" :entry="entry">

        </component>
    </div>
</template>

<script>
    import VideoEntry from "./VideoEntry";
    import TextEntry from "./TextEntry";
    import PhotoEntry from "./PhotoEntry";
    export default {
        name: "Entries",
        components: {
          VideoEntry,
          TextEntry,
          PhotoEntry
        },
        props: {
            entries: {
                type: Array,
            }
        }
    }
</script>

<style scoped>

</style>