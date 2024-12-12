import { createRouter, createWebHistory } from 'vue-router'
import HomePage from "../pages/HomePage.vue";
import AuthorsPage from "../pages/AuthorsPage.vue";
import TopicsPage from '../pages/TopicsPage.vue';
import ReportPage from "../pages/ReportPage.vue";
import BooksPage from "../pages/book/BooksPage.vue";
import BookFormPage from "../pages/book/BookFormPage.vue";

const routes = [
    { path: '/', name: 'home' , component: HomePage, meta: { title: 'Página Inicial' }},
    { path: '/autores', name: 'authors' , component: AuthorsPage, meta: { title: 'Autores' }},
    { path: '/assuntos', name: 'topics' , component: TopicsPage, meta: { title: 'Assuntos' }},
    { path: '/livros', name: 'books' , component: BooksPage, meta: { title: 'Livros' }},
    { path: '/livros/criar', name: 'books.create' , component: BookFormPage, meta: { title: 'Novo Livro' } },
    { path: '/livros/:id/editar', name: 'books.edit' , component: BookFormPage, meta: { title: 'Editar Livro' } },
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
