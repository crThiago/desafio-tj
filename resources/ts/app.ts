import { createApp } from 'vue';
import App from './App.vue';
import vuetify from './plugins/vuetify';
import router from './plugins/router'
import store from './plugins/store'

const app = createApp(App);

app.use(vuetify);
app.use(router);
app.use(store)
app.mount('#app');
