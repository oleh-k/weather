
import './bootstrap';
import { createApp } from 'vue';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';
import store from './store'; // Import your Vuex store


const app = createApp({});
app.use(ElementPlus);


import Register from './components/Register.vue';
app.use(store);

app.component('register', Register);


app.mount('#app');
