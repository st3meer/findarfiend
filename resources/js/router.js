
/**
 * router/index.ts
 *
 * Automatic routes for `./src/pages/*.vue`
 */

// Composables
import { createRouter, createWebHistory } from 'vue-router/auto'
import { routes } from 'vue-router/auto-routes'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/map',
      name: 'Map',
      component: () => import('./Pages/map.vue')
    },
    {
      path: '/friends',
      name: 'Friends',
      component: () => import('./Pages/friends.vue')
    },
    {
      path: '/new_friends',
      name: 'Search for friends',
      component: () => import('./Pages/searchUsers.vue')
    },
    {
      path: '/freiendship_requests',
      name: 'Freiendship requests',
      component: () => import('./Pages/friendRequests.vue')
    },
    {
      path: '/account',
      name: 'My Account',
      component: () => import('./Pages/myAccount.vue')
    },
  ],
})

// Workaround for https://github.com/vitejs/vite/issues/11804
router.onError((err, to) => {
  if (err?.message?.includes?.('Failed to fetch dynamically imported module')) {
    if (!localStorage.getItem('vuetify:dynamic-reload')) {
      console.log('Reloading page to fix dynamic import error')
      localStorage.setItem('vuetify:dynamic-reload', 'true')
      location.assign(to.fullPath)
    } else {
      console.error('Dynamic import error, reloading page did not fix it', err)
    }
  } else {
    console.error(err)
  }
})

router.isReady().then(() => {
  localStorage.removeItem('vuetify:dynamic-reload')
})

export default router
