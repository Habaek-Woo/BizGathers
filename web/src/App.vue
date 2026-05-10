<template>
  <div class="min-h-dvh bg-[color:var(--bg)] text-[color:var(--fg)]">
    <div class="bg-grid">
      <SiteNavbar />
      <main class="mx-auto w-full max-w-6xl px-4 pb-16 pt-28 sm:px-6 sm:pt-32">
        <RouterView />
      </main>
      <SiteFooter />
    </div>
  </div>
</template>

<script setup>
import { onBeforeUnmount, onMounted } from 'vue'
import { RouterView } from 'vue-router'
import SiteNavbar from './components/SiteNavbar.vue'
import SiteFooter from './components/SiteFooter.vue'
import { rafThrottle } from './utils/rafThrottle'

let scrollEndT = 0
const onScroll = rafThrottle(() => {
  const y = window.scrollY || document.documentElement.scrollTop || 0
  document.documentElement.style.setProperty('--scroll-y', String(y))

  // Lightweight "is scrolling" signal for future UI tweaks.
  document.documentElement.dataset.scrolling = 'true'
  window.clearTimeout(scrollEndT)
  scrollEndT = window.setTimeout(() => {
    delete document.documentElement.dataset.scrolling
  }, 140)
})

onMounted(() => {
  // Initialize once so CSS consumers have a value.
  onScroll()
  window.addEventListener('scroll', onScroll, { passive: true })
})

onBeforeUnmount(() => {
  window.removeEventListener('scroll', onScroll)
  window.clearTimeout(scrollEndT)
})
</script>
