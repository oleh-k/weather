
import './bootstrap';
import { createApp } from 'vue';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';
import store from './store'; // Import your Vuex store


const app = createApp({});
app.use(ElementPlus);


import Register from './components/Register.vue';
import Main from './components/Main.vue';
app.use(store);

app.component('register', Register);
app.component('main', Main);


app.mount('#app');
