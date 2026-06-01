import { createRouter, createWebHistory } from 'vue-router';
import { authState } from './auth';
import HomePage from './pages/HomePage.vue';
import LoginPage from './pages/LoginPage.vue';
import PasswordRecoveryPage from './pages/PasswordRecoveryPage.vue';
import RegisterPage from './pages/RegisterPage.vue';
import CabinetPage from './pages/CabinetPage.vue';
import PortalSectionPage from './pages/PortalSectionPage.vue';
import NotFoundPage from './pages/NotFoundPage.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomePage
    },
    {
      path: '/login',
      name: 'login',
      component: LoginPage
    },
    {
      path: '/password-recovery',
      name: 'password-recovery',
      component: PasswordRecoveryPage
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterPage
    },
    {
      path: '/cabinet',
      name: 'cabinet',
      component: CabinetPage,
      meta: { requiresAuth: true }
    },
    {
      path: '/pages/:slug',
      name: 'section',
      component: PortalSectionPage
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'not-found',
      component: NotFoundPage
    }
  ],
  scrollBehavior() {
    return { top: 0, behavior: 'smooth' };
  }
});

router.beforeEach((to) => {
  if (to.meta.requiresAuth && !authState.user) {
    return { name: 'login', query: { redirect: to.fullPath } };
  }

  return true;
});

export default router;
