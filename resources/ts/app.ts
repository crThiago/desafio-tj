import { createApp } from 'vue';
import App from './App.vue';
import vuetify from './plugins/vuetify';
import router from './plugins/router'
import store from './plugins/store'
import TopicGateway from "./infra/gateways/TopicGateway";
import {AxiosAdapter} from "./infra/http/HttpClient";
import AuthorGateway from "./infra/gateways/AuthorGateway";

const httpClient = new AxiosAdapter();
const topicGateway = new TopicGateway(httpClient);
const authorGateway = new AuthorGateway(httpClient);

const app = createApp(App);

app.provide('topicGateway', topicGateway);
app.provide('authorGateway', authorGateway);

app.use(vuetify);
app.use(router);
app.use(store)
app.mount('#app');
