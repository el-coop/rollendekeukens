<template>
    <div class="box">
        <div class="content" v-html="data.entry.text">
        </div>
    </div>
</template>

<script>
    export default {
        name: "AlbumText",
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