import { createRouter, createWebHashHistory, createWebHistory } from 'vue-router'

import HomePage from '../views/HomePage.vue'
import DirectoryPage from '../views/DirectoryPage.vue'
import BusinessProfilePage from '../views/BusinessProfilePage.vue'
import CampaignsPage from '../views/CampaignsPage.vue'
import AboutPage from '../views/AboutPage.vue'
import PricingPage from '../views/PricingPage.vue'
import SupportPage from '../views/SupportPage.vue'
import BlogPage from '../views/BlogPage.vue'

const router = createRouter({
  // GitHub Pages has no SPA rewrites; hash mode avoids blank pages on refresh.
  history: import.meta.env.VITE_ROUTER_MODE === 'hash' ? createWebHashHistory() : createWebHistory(),
  scrollBehavior() {
    return { top: 0 }
  },
  routes: [
    { path: '/', name: 'home', component: HomePage },
    { path: '/directory', name: 'directory', component: DirectoryPage },
    { path: '/business/:id', name: 'business', component: BusinessProfilePage, props: true },
    { path: '/campaigns', name: 'campaigns', component: CampaignsPage },
    { path: '/about', name: 'about', component: AboutPage },
    { path: '/pricing', name: 'pricing', component: PricingPage },
    { path: '/support', name: 'support', component: SupportPage },
    { path: '/blog', name: 'blog', component: BlogPage },
    { path: '/:pathMatch(.*)*', redirect: '/' },
  ],
})

export default router
