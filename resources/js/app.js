import './bootstrap';
import '../sass/app.scss'
import store from "@/store";
import router from "@/router";
import {createApp} from "vue";
import App from "@/App.vue";

const app = createApp(App)

app.use(store);
app.use(router);

app.mount('#app');
