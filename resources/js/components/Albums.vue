<template>
    <carousel :entries="albums">
        <template #default="{entry, index}">
            <a class="image album" @click="! entry.link ? open(entry) : ''" :href="entry.link">
                <img class="album-image" :src="`/storage/${entry.thumbnail}`" :alt="entry.title">
            </a>
            <div class="has-text-centered has-text-weight-bold is-size-7" v-text="entry.title"></div>
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
