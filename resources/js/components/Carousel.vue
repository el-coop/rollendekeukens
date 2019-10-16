<template>
    <div class="is-relative">
        <div class="carousel__scroll carousel__scroll--left" v-if="currentScroll !== 0" @click="scroll(-1)">
            <font-awesome-icon icon="chevron-left"/>
        </div>
        <div class="carousel-wrapper" @scroll.passiv="onScroll" ref="wrapper">
            <div class="carousel" ref="carousel" key="carousel">
                <div v-for="(entry, index) in entries" :class="itemClass">
                    <slot :entry="entry" :index="index"/>
                </div>
            </div>
        </div>
        <div class="carousel__scroll carousel__scroll--right" v-if="currentScroll < maxScroll" @click="scroll(1)">
            <font-awesome-icon icon="chevron-right"/>
        </div>
    </div>
</template>

<script>
	export default {
		name: "Carousel",

		props: {
			entries: {
				type: Array,
				required: true
			},

			itemClass: {
				type: String,
				default: 'carousel-item'
			}
		},

		data() {
			return {
				currentScroll: 0,
				maxScroll: 0
			};
		},

		async mounted() {
			await this.$nextTick();
			this.maxScroll = this.$refs.wrapper.scrollWidth - this.$refs.wrapper.clientWidth;
		},

		methods: {
			onScroll() {
				this.currentScroll = this.$refs.wrapper.scrollLeft;
			},

			scroll(amount) {
				const clientWidth = this.$refs.wrapper.clientWidth;
				const entryWidth = this.$refs.carousel.firstChild.clientWidth;

				const onPage = clientWidth / entryWidth;
				const pageWidth = onPage * entryWidth;
				const pages = Math.ceil(this.maxScroll / pageWidth);
				let currentPage = Math.ceil(this.currentScroll / clientWidth);
				this.maxScroll = this.$refs.wrapper.scrollWidth - clientWidth;

				if (this.currentScroll === this.maxScroll) {
					currentPage = pages;
				}

				const scroll = Math.floor(onPage) * entryWidth * (currentPage + amount);


				this.$refs.wrapper.scroll({
					left: scroll,
					behavior: 'smooth'
				});
			}
		}

	}
</script>

<style scoped lang="scss">
    @import "~bulma/sass/utilities/initial-variables";
    @import "~bulma/sass/utilities/functions.sass";
    @import "~bulma/sass/utilities/derived-variables";
    @import "~bulma/sass/utilities/mixins";

    .carousel-wrapper {
        position: relative;
        overflow: auto;

        @include from($tablet) {
            overflow-x: hidden;
        }
    }

    .carousel {
        display: flex;
        overflow-x: visible;
        padding-bottom: 20px;

        &__scroll {
            display: none;
            width: 20px;
            background-color: $grey-darker;
            position: absolute;
            height: 20%;
            top: 50%;
            transform: translateY(-50%);
            color: $grey-light;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            z-index: 10;
            @include from($tablet) {
                display: flex;
            }

            &:hover {
                color: $white;
            }

            &--left {
                left: 0;
            }

            &--right {
                right: 0;
            }
        }
    }
</style>
