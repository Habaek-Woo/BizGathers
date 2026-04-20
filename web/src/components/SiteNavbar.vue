<template>
  <header class="fixed inset-x-0 top-0 z-50">
    <div class="mx-auto max-w-6xl px-4 pt-4 sm:px-6">
      <div
        class="flex items-center justify-between gap-3 rounded-full border border-[color:var(--border)] bg-[color:var(--bg)]/70 px-3 py-2 shadow-[0_12px_40px_rgba(0,0,0,0.18)] backdrop-blur"
      >
        <RouterLink to="/" class="group flex items-center gap-3 rounded-full px-2 py-1 hover:bg-white/5">
          <img
            :src="logo"
            alt="BizGathers logo"
            class="h-9 w-9 rounded-full object-contain ring-1 ring-[color:var(--border)] bg-black/10"
          />
          <div class="leading-tight">
            <div class="text-sm font-semibold tracking-wide text-[color:var(--fg)]">BizGathers</div>
            <div class="text-xs text-[color:var(--muted)]">Online Directory</div>
          </div>
        </RouterLink>

        <nav class="hidden items-center gap-5 text-sm text-[color:var(--muted)] md:flex">
          <RouterLink class="rounded-full px-3 py-2 hover:bg-[color:var(--card)] hover:text-[color:var(--fg)]" to="/directory">Directory</RouterLink>
          <RouterLink class="rounded-full px-3 py-2 hover:bg-[color:var(--card)] hover:text-[color:var(--fg)]" to="/campaigns">Campaigns</RouterLink>
          <RouterLink class="rounded-full px-3 py-2 hover:bg-[color:var(--card)] hover:text-[color:var(--fg)]" to="/blog">Stories</RouterLink>
          <RouterLink class="rounded-full px-3 py-2 hover:bg-[color:var(--card)] hover:text-[color:var(--fg)]" to="/pricing">Pricing</RouterLink>
          <RouterLink class="rounded-full px-3 py-2 hover:bg-[color:var(--card)] hover:text-[color:var(--fg)]" to="/about">About</RouterLink>
          <RouterLink class="rounded-full px-3 py-2 hover:bg-[color:var(--card)] hover:text-[color:var(--fg)]" to="/support">Support</RouterLink>
        </nav>

        <div class="flex items-center gap-2">
          <ThemeToggle class="hidden sm:inline-flex" />
          <RouterLink
            to="/directory"
            class="hidden rounded-full border border-[color:var(--border)] bg-[color:var(--card)] px-4 py-2 text-sm font-medium text-[color:var(--fg)] hover:brightness-95 sm:inline-flex"
          >
            Discover
          </RouterLink>
          <button
            type="button"
            class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-[color:var(--border)] bg-[color:var(--card)] text-[color:var(--fg)] hover:brightness-95 sm:hidden"
            aria-label="Open menu"
            :aria-expanded="mobileOpen ? 'true' : 'false'"
            @click="mobileOpen = !mobileOpen"
          >
            ☰
          </button>
          <a
            href="#"
            class="inline-flex rounded-full bg-[color:var(--brand)] px-4 py-2 text-sm font-semibold text-black hover:brightness-95"
          >
            Get Listed — Free
          </a>
        </div>
      </div>

      <!-- Mobile menu -->
      <div
        v-if="mobileOpen"
        class="mt-3 rounded-3xl border border-[color:var(--border)] bg-[color:var(--bg)]/90 p-3 shadow-[0_18px_60px_rgba(0,0,0,0.22)] backdrop-blur sm:hidden"
      >
        <div class="flex items-center justify-between gap-2 px-2 pb-2">
          <div class="text-xs font-semibold text-[color:var(--muted)]">Menu</div>
          <ThemeToggle />
        </div>
        <nav class="grid gap-1">
          <RouterLink class="rounded-2xl px-4 py-3 text-sm font-semibold text-[color:var(--fg)] hover:bg-[color:var(--card)]" to="/directory" @click="mobileOpen = false">Directory</RouterLink>
          <RouterLink class="rounded-2xl px-4 py-3 text-sm font-semibold text-[color:var(--fg)] hover:bg-[color:var(--card)]" to="/campaigns" @click="mobileOpen = false">Campaigns</RouterLink>
          <RouterLink class="rounded-2xl px-4 py-3 text-sm font-semibold text-[color:var(--fg)] hover:bg-[color:var(--card)]" to="/blog" @click="mobileOpen = false">Stories</RouterLink>
          <RouterLink class="rounded-2xl px-4 py-3 text-sm font-semibold text-[color:var(--fg)] hover:bg-[color:var(--card)]" to="/pricing" @click="mobileOpen = false">Pricing</RouterLink>
          <RouterLink class="rounded-2xl px-4 py-3 text-sm font-semibold text-[color:var(--fg)] hover:bg-[color:var(--card)]" to="/about" @click="mobileOpen = false">About</RouterLink>
          <RouterLink class="rounded-2xl px-4 py-3 text-sm font-semibold text-[color:var(--fg)] hover:bg-[color:var(--card)]" to="/support" @click="mobileOpen = false">Support</RouterLink>
        </nav>
      </div>
    </div>
  </header>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue'
import { RouterLink } from 'vue-router'
import logo from '../assets/brand/Logo.png'
import ThemeToggle from './ThemeToggle.vue'

const mobileOpen = ref(false)

function onDocClick(e) {
  const header = e.target?.closest?.('header')
  if (!header) mobileOpen.value = false
}

onMounted(() => {
  document.addEventListener('click', onDocClick)
})

onBeforeUnmount(() => {
  document.removeEventListener('click', onDocClick)
})
</script>
