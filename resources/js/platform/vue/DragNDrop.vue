<template>
    <draggable v-model="entries" draggable=".thumbnail-gallery__draggable">
        <slot :entries="entries"/>
        <div slot="header">
            <slot name="header"/>
        </div>
    </draggable>
</template>

<script>
	import draggable from 'vuedraggable'

	export default {
		name: "dragNDrop",
		components: {
			draggable,
		},
		props: {
			initEntries: {
				type: Array,
				required: true
			},
			url: {
				type: String,
				required: true
			}
		},
		data() {
			return {
				entries: this.initEntries,
			}
		},

		watch: {
			async entries(value) {
				fetch(this.url, {
					method: 'post',
					headers: {
						'X-CSRF-TOKEN': document.head.querySelector('#csrf_token').content,
						'Content-Type': 'application/json'
					},
					body: JSON.stringify({
						order: value.map((item) => {
							return item.id;
						}),

					})
				})
			}
		}
	}
</script>
