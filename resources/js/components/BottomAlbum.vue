<template>
    <carousel :entries="entries" item-class="entries__entry">
        <template #default="{entry, index}">
            <div @click="open(entry)" style="height: 100%">
                <figure class="image is-square" v-if="entry.image">
                    <img class="entries__entry-image" :src="`storage/${entry.image}`" :alt="entry.type">
                </figure>
                <div class="entries__entry-content" v-html="entry.entry.text" v-else/>
            </div>
        </template>
    </carousel>
</template>

<script>
	import Carousel from './Carousel'

	export default {
		name: "BottomAlbum",
		components: {
			Carousel
		},
		props: {
			entries: {
				type: Array,
				required: true
			}
		},
		methods: {
			open(entry) {
				entry.component = "Album" + entry.type;
				this.$emit('open-entry', entry);
			}
		}
	}
</script>
