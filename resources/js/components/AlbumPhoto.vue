<template>
    <figure class="image">
        <img :src="data.imageLink">
    </figure>
</template>

<script>
    export default {
        name: "AlbumPhoto",
        props: {
            data: {
                type: Object,
                required: true
            }
        }
    }
</script>
