require('./bootstrap');

window.Vue = require('vue').default;
// Vue.use(Quasar);
Vue.component('creator', require('./components/Creator.vue').default);

const app = new Vue({
    el: '#app',
});
