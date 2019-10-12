<template>
    <div class="carousel-wrapper">
        <div class="carousel__scroll carousel__scroll--left" v-if="currentScroll !== 0" @click="scroll(-1)">
            <font-awesome-icon icon="chevron-left"/>
        </div>
        <div class="carousel" ref="carousel">
            <div v-for="(entry, index) in entries" class="carousel-item">
                <slot :entry="entry" :index="index"/>
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
			}
		},

		data() {
			return {
				currentScroll: 0,
				maxScroll: 0
			};
		},

		mounted() {
			this.maxScroll = this.$refs.carousel.scrollWidth - this.$refs.carousel.clientWidth;
		},

		methods: {
			scroll(amount) {
				const clientWidth = this.$refs.carousel.clientWidth;

				this.maxScroll = this.$refs.carousel.scrollWidth - clientWidth;

				const entryWidth = this.$refs.carousel.firstChild.clientWidth;
				const onPage = clientWidth / entryWidth;
				const pageWidth = onPage * entryWidth;
				const pages = Math.ceil(this.maxScroll / pageWidth);
				let currentPage = Math.ceil(this.currentScroll / clientWidth);

				if (this.currentScroll === this.maxScroll) {
					currentPage = pages;
				}

				this.currentScroll = Math.floor(onPage) * entryWidth * (currentPage + amount);

				if (this.currentScroll < 0) {
					this.currentScroll = 0;
				} else if (this.currentScroll > this.maxScroll) {
					this.currentScroll = this.maxScroll;
				}

				this.$refs.carousel.scroll({
					left: this.currentScroll,
					behavior: "smooth"
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
    }

    .carousel {
        display: flex;
        max-width: 100%;
        overflow-x: auto;
        padding-bottom: 20px;

        @include from($tablet) {
            overflow-x: hidden;
        }

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
            z-index: 100;
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
