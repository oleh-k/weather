
import './bootstrap';
import { createApp } from 'vue';


const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

import Register from './components/Register.vue';
app.component('register', Register);


app.mount('#app');
