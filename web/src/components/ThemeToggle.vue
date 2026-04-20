<template>
  <button
    type="button"
    class="toggle"
    :aria-label="`Switch to ${isDark ? 'light' : 'dark'} mode`"
    :aria-pressed="isDark ? 'true' : 'false'"
    @click="toggle"
  >
    <span class="track" aria-hidden="true">
      <span class="thumb" :class="isDark ? 'is-dark' : 'is-light'">
        <!-- Simple sun/moon (no big expanding rays) -->
        <span class="icon" :class="isDark ? 'moon' : 'sun'"></span>
      </span>
    </span>
  </button>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue'

const THEME_KEY = 'bizgathers-theme'
const theme = ref('dark')

const isDark = computed(() => theme.value === 'dark')

function apply(t) {
  theme.value = t
  document.documentElement.dataset.theme = t
  try {
    localStorage.setItem(THEME_KEY, t)
  } catch (e) {}
}

function prefersReducedMotion() {
  return window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches
}

function toggle(e) {
  const next = isDark.value ? 'light' : 'dark'

  // Fancy animation when supported.
  const vt = document.startViewTransition
  if (typeof vt === 'function' && !prefersReducedMotion()) {
    const x = e?.clientX ?? window.innerWidth / 2
    const y = e?.clientY ?? window.innerHeight / 2
    const maxRadius = Math.hypot(
      Math.max(x, window.innerWidth - x),
      Math.max(y, window.innerHeight - y),
    )

    const transition = document.startViewTransition(() => {
      apply(next)
    })

    transition.ready.then(() => {
      // Reveal the NEW theme from the click point.
      document.documentElement.animate(
        {
          clipPath: [
            `circle(0px at ${x}px ${y}px)`,
            `circle(${maxRadius}px at ${x}px ${y}px)`,
          ],
        },
        {
          duration: 520,
          easing: 'cubic-bezier(0.2, 0.9, 0.2, 1)',
          pseudoElement: '::view-transition-new(root)',
        },
      )
    })

    return
  }

  // Fallback
  apply(next)
}

onMounted(() => {
  const current = document.documentElement.dataset.theme
  if (current === 'light' || current === 'dark') {
    theme.value = current
    return
  }
  // fallback (should not happen because index.html sets it)
  const systemDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
  apply(systemDark ? 'dark' : 'light')
})
</script>

<style scoped>
.toggle {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border: 1px solid color-mix(in oklab, var(--fg) 16%, transparent);
  background: color-mix(in oklab, var(--bg) 72%, transparent);
  color: var(--fg);
  border-radius: 999px;
  padding: 6px;
  cursor: pointer;
  transition:
    background-color 200ms ease,
    border-color 200ms ease,
    transform 200ms ease;
}

.toggle:hover {
  background: color-mix(in oklab, var(--bg) 60%, transparent);
}

.toggle:active {
  transform: none;
}

.toggle:focus-visible {
  outline: 2px solid var(--brand-2);
  outline-offset: 2px;
}

.track {
  width: 44px;
  height: 26px;
  border-radius: 999px;
  background: color-mix(in oklab, var(--fg) 10%, transparent);
  position: relative;
  display: inline-flex;
  align-items: center;
  padding: 3px;
}

.thumb {
  width: 20px;
  height: 20px;
  border-radius: 999px;
  background: color-mix(in oklab, var(--bg) 10%, var(--fg) 92%);
  box-shadow: 0 6px 14px rgba(0, 0, 0, 0.18);
  position: absolute;
  top: 3px;
  left: 3px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition:
    transform 320ms cubic-bezier(0.2, 0.8, 0.2, 1),
    background-color 200ms ease;
}

.thumb.is-dark {
  transform: translateX(18px);
}

.icon {
  width: 12px;
  height: 12px;
  position: relative;
  display: inline-block;
  transition: transform 280ms ease, opacity 200ms ease;
}

/* Sun */
.icon.sun {
  border-radius: 999px;
  background: var(--brand);
  box-shadow: 0 0 0 2px color-mix(in oklab, var(--brand) 35%, transparent);
}

/* Moon */
.icon.moon {
  border-radius: 999px;
  background: color-mix(in oklab, var(--fg) 78%, var(--bg) 22%);
}

.icon.moon::after {
  content: "";
  position: absolute;
  width: 12px;
  height: 12px;
  border-radius: 999px;
  top: -1px;
  left: 3px;
  background: color-mix(in oklab, var(--bg) 92%, transparent);
}

@media (prefers-reduced-motion: reduce) {
  .toggle,
  .thumb,
  .icon {
    transition: none;
  }
}
</style>
