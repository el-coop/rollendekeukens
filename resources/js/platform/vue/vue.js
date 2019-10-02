import Vue from 'vue';
import dragNDrop from "./dragNDrop";
import TurbolinksAdapter from 'vue-turbolinks';

Vue.use(TurbolinksAdapter);


Vue.component('DragNDrop', dragNDrop);

document.addEventListener('turbolinks:load', () => {

    const element = document.getElementById("vue");
    if (element != null) {
        new Vue({
            el: '#vue',
        });
    }
});

