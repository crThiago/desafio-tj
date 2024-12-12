import { createApp } from 'vue';
import App from './App.vue';
import vuetify from './plugins/vuetify';
import router from './plugins/router'
import store from './plugins/store'
import TopicGateway from "./infra/gateways/TopicGateway";
import {AxiosAdapter} from "./infra/http/HttpClient";
import AuthorGateway from "./infra/gateways/AuthorGateway";
import BookGateway from "./infra/gateways/BookGateway";
import RelatorioGateway from "./infra/gateways/RelatorioGateway";

const httpClient = new AxiosAdapter();
const topicGateway = new TopicGateway(httpClient);
const authorGateway = new AuthorGateway(httpClient);
const bookGateway = new BookGateway(httpClient);
const relatorioGateway = new RelatorioGateway(httpClient);

const app = createApp(App);

app.provide('topicGateway', topicGateway);
app.provide('authorGateway', authorGateway);
app.provide('bookGateway', bookGateway);
app.provide('relatorioGateway', relatorioGateway);

app.use(vuetify);
app.use(router);
app.use(store)
app.mount('#app');
