
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Echo from 'laravel-echo'

require('./bootstrap');

window.Vue = require('vue');

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '8cb0e2218a987888e0b8',
    cluster: 'eu',
    encrypted: true
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('test', require('./components/test.vue'));
Vue.component('team', require('./components/member.vue'));
Vue.component('upcoming', require('./components/upcoming.vue'));
Vue.component('announcement', require('./components/announcement.vue'));
Vue.component('gossip', require('./components/gossip.vue'));
Vue.component('scrumy', require('./components/scrumy.vue'));
Vue.component('clock', require('./components/clock.vue'));
Vue.component('bitbucket', require('./components/bitbucket.vue'));
Vue.component('github', require('./components/github.vue'));
Vue.component('music', require('./components/music.vue'));

window.Event = new Vue();

window.app = new Vue({
    el: '#app'
});
