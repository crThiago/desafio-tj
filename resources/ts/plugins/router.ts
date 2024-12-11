import { createRouter, createWebHistory } from 'vue-router'
import HomePage from "../pages/HomePage.vue";
import AuthorsPage from "../pages/AuthorsPage.vue";
import TopicsPage from '../pages/TopicsPage.vue';
import BooksPage from "../pages/BooksPage.vue";
import ReportPage from "../pages/ReportPage.vue";

const routes = [
    { path: '/', name: 'home' , component: HomePage, meta: { title: 'Página Inicial' }},
    { path: '/autores', name: 'authors' , component: AuthorsPage, meta: { title: 'Autores' }},
    { path: '/assuntos', name: 'topics' , component: TopicsPage, meta: { title: 'Assuntos' }},
    { path: '/livros', name: 'books' , component: BooksPage, meta: { title: 'Livros' }},
    { path: '/relatorio', name: 'report' , component: ReportPage, meta: { title: 'Relatório' }},
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    // Verifica se a rota atual tem um título definido
    if (to.meta.title) {
        document.title = to.meta.title;
    }
    next();
});

export default router
