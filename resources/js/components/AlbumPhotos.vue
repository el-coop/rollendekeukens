<template>
    <div class="modal-carousel">
        <component :is="type" :data="selected"/>
        <carousel :entries="entries">
            <template #default="{entry, index}">
                <div class="modal-carousel__thumbnail" @click="show(entry)">
                    <figure class="image modal-carousel__thumbnail-image-wrapper" v-if="entry.image">
                        <img class="modal-carousel__thumbnail-image" :src="`storage/${entry.image}`">
                    </figure>
                    <div v-html="entry.entry.text" v-else/>
                </div>
            </template>
        </carousel>
    </div>
</template>

<script>
	export default {
		name: "AlbumPhotos",
		props: {
			data: {
				type: Object,
				required: true
			}
		},

		data() {
			return {
				entries: this.data.entries,
				selected: this.data.entries[0],
			}
		},

		computed: {
			type() {
				return "Album" + this.selected.type;
			}
		},

		methods: {
			show(entry) {
				this.selected = entry;
			}
		}
	}
</script>
