<template>
    <carousel :entries="albums">
        <template #default="{entry, index}">
            <figure class="image album" @click="open(entry)">
                <img class="album-image" :src="`/storage/${entry.thumbnail}`" :alt="entry.title">
            </figure>
            <div class="has-text-centered is-size-7" v-text="entry.title"></div>
        </template>
    </carousel>
</template>

<script>
	export default {
		name: "Albums",
		props: {
			albums: {
				type: Array,
				required: true
			}
		},

		methods: {
			open(entry) {
				entry.component = "album-photos";
				this.$emit('open-entry', entry);
			}
		}
	}
</script>
