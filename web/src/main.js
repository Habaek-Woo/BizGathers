import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './router'

createApp(App).use(router).mount('#app')

// Fade out the initial loading screen after mount (min display time).
const preloader = document.getElementById('app-preloader')
if (preloader) {
  const startedAt = Number(preloader.getAttribute('data-started-at') || Date.now())
  const minMs = 650
  const elapsed = Date.now() - startedAt
  const wait = Math.max(0, minMs - elapsed)

  window.setTimeout(() => {
    preloader.classList.add('is-hiding')
    window.setTimeout(() => preloader.remove(), 260)
  }, wait)
}
