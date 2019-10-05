import Vue from 'vue';
import TurbolinksAdapter from 'vue-turbolinks';

import dragNDrop from "./dragNDrop";

Vue.use(TurbolinksAdapter);

Vue.component('DragNDrop', dragNDrop);

document.addEventListener('turbolinks:load', () => {
    const element = document.getElementsByClassName("vue");
    if (element.length) {
        new Vue({
            el: '.vue',
        });
    }
});

