import { createRouter, createWebHistory } from 'vue-router'
import Top from '@/views/components/Top.vue';
import Welcome from '@/views/components/Welcome.vue';
import NotFound from '@/views/components/NotFound.vue';

const routes = [
  {
    path: "/",
    component: Top,
    name: 'top'
  },
  {
    path: "/welcome",
    component: Welcome,
    name: 'welcom'
  },
  { 
    path: '/:catchAll(.*)',
    component: NotFound,
    name: 'notfound'
  }
];

const router = createRouter({
  routes,
  history: createWebHistory(),
});

export default router;