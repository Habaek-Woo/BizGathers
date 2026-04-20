<template>
  <div class="min-h-full bg-[color:var(--bg)] text-[color:var(--fg)]">
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

const onScroll = rafThrottle(() => {
  // Throttled scroll hook for QA/perf (safe baseline for future scroll work).
  document.documentElement.dataset.scrolling = 'true'
  clearTimeout(window.__bgScrollT)
  window.__bgScrollT = setTimeout(() => {
    delete document.documentElement.dataset.scrolling
  }, 120)
})

onMounted(() => {
  window.addEventListener('scroll', onScroll, { passive: true })
})

onBeforeUnmount(() => {
  window.removeEventListener('scroll', onScroll)
})
</script>
