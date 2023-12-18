
import './bootstrap';
import { createApp } from 'vue';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';


const app = createApp({});
app.use(ElementPlus);


import Register from './components/Register.vue';
app.component('register', Register);


app.mount('#app');
