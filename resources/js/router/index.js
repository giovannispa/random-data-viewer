import { createRouter, createWebHistory } from 'vue-router'
import UserIndex from '../components/user/Index.vue';
import NotFound from "../components/NotFound.vue";

const routes = [
    {
        path: '/',
        component: UserIndex
    },
    {
        path: '/:pathMath(.*)*',
        component: NotFound
    }
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

export default router
