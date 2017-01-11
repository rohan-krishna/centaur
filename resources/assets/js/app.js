
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('notebooks', require('./components/Notebooks.vue'));
Vue.component('notes', require('./components/Notes.vue'));
Vue.component('note', require('./components/Note.vue'));

Vue.material.theme.register('myTheme', {
  primary: 'blue',
  accent: 'red'
});

var bus =  new Vue({});

const app = new Vue({
    el: '#app',
    data: {
    	bus: bus,
      notebooks: []
    }
});
