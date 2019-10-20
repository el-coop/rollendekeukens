import Vue from 'vue';
import TurbolinksAdapter from 'vue-turbolinks';

import DragNDrop from "./DragNDrop";

Vue.use(TurbolinksAdapter);

Vue.component('DragNDrop', DragNDrop);

document.addEventListener('turbolinks:load', (event) => {
    const element = document.getElementsByClassName("vue");
    if (element.length) {
        new Vue({
            el: '.vue',
        });
    }
});

