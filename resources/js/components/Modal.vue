<template>
    <div class="modal" v-bind:class="{'is-active': isActive}">
        <div class="modal-background" @click="toggleClass()"></div>
        <div class="modal-content">
            <slot></slot>
        </div>
        <button @click="toggleClass()" class="modal-close is-large" aria-label="close"></button>
    </div>
</template>

<script>
    export default {
        name: "Modal",
        data(){
            return {
                isActive: true
            };
        },
        methods: {
            toggleClass(){
                this.$emit('close-modal');
            }
        }
    }
</script>