<template>
    <div class="entries">
        <hr>
        <div v-for="entry in entries" class="entries__entry" @click="open(entry)">
            <figure class="image is-square">
                <img class="entries__entry-image" :src="entry.image ? `storage/${entry.image}` : '#'" :alt="entry.image ? entry.type : ' '">
                <div class="entries__entry-content" v-html="entry.entry.text" v-if="! entry.image"/>
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
			open(entry) {
				entry.component = "Album" + entry.type;
				this.$emit('open-entry', entry);
			}
		}
	}
</script>
