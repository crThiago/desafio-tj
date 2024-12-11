import { createRouter, createWebHistory } from 'vue-router'

const routes = [{}]

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
