import './bootstrap';
import { createApp, defineAsyncComponent } from 'vue';
import axios from 'axios';
import store from './store'; // Importa o Vuex store
import { mask } from 'vue-the-mask';
import $ from 'jquery';
import 'admin-lte';
import FloatingWidget from './components/FloatingWidget.vue';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

axios.defaults.baseURL = 'http://localhost:8000/';
axios.defaults.headers.common['Content-Type'] = 'application/json';
window.axios = axios;

const tenant = window.tenant || null;

window.$ = window.jQuery = $;

const app = createApp({});
app.directive('mask', mask);

app.component('FloatingWidget', FloatingWidget);

const floatingWidgetInstance = createApp(FloatingWidget).mount(document.createElement('div'));
document.body.appendChild(floatingWidgetInstance.$el);

app.config.globalProperties.$showWidget = function (message, isSuccess) {
    floatingWidgetInstance.show(message, isSuccess);
};

const components = import.meta.glob('./components/**/*.vue');
Object.entries(components).forEach(([path, importFunction]) => {
    const componentName = path.split('/').pop().replace(/\.\w+$/, '');
    app.component(componentName, defineAsyncComponent(importFunction));
});

app.use(store);
app.mount('#app');