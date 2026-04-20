<template>
  <div ref="root" class="grid gap-6">
    <div class="rounded-3xl border border-[color:var(--border)] bg-[color:var(--card)] p-6" data-hero>
      <div class="text-xs font-semibold text-[color:var(--muted)]">Seasonal banner</div>
      <h1 class="mt-2 text-3xl font-semibold tracking-tight text-[color:var(--fg)]">Campaigns</h1>
      <p class="mt-2 text-sm text-[color:var(--muted)]">
        The engine for seasonal growth—run themes like “Christmas Gathers” or “Ramadan Specials.”
      </p>
      <div class="mt-5 rounded-2xl border border-[color:var(--border)] bg-[linear-gradient(90deg,var(--brand-2),color-mix(in_oklab,var(--card)_80%,transparent),color-mix(in_oklab,var(--bg)_85%,transparent))] p-5" data-reveal>
        <div class="text-sm font-semibold text-[color:var(--fg)]">Current theme (Mock): Weekend Specials</div>
        <div class="mt-1 text-sm text-[color:var(--muted)]">Aggregation of all businesses participating in the theme.</div>
      </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
      <div v-for="c in cards" :key="c.title" class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-5" data-reveal>
        <div class="text-xs font-semibold text-[color:var(--muted)]">{{ c.tag }}</div>
        <div class="mt-2 text-sm font-semibold text-[color:var(--fg)]">{{ c.title }}</div>
        <div class="mt-1 text-sm text-[color:var(--muted)]">{{ c.desc }}</div>
      </div>
    </div>

    <div class="rounded-3xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 p-6" data-reveal>
      <div class="text-sm font-semibold text-[color:var(--fg)]">SME growth CTA</div>
      <p class="mt-2 text-sm text-[color:var(--muted)]">Launch your campaign on BizGathers. Reach 10k+ local users.</p>
      <a
        class="mt-4 inline-flex rounded-xl bg-[color:var(--brand)] px-5 py-3 text-sm font-semibold text-black hover:brightness-95"
        href="#"
      >
        Launch a campaign
      </a>
    </div>
  </div>
</template>

<script setup>
import { useMajesticMotion } from '../composables/useMajesticMotion'

const { root } = useMajesticMotion()

const cards = [
  { tag: 'Theme', title: 'Food & Drink', desc: 'Promos for cafes, restos, and local eats.' },
  { tag: 'Theme', title: 'Retail Finds', desc: 'Spotlight local shops with limited-time offers.' },
  { tag: 'Theme', title: 'Services Week', desc: 'Bundles and deals for trusted service providers.' },
  { tag: 'Theme', title: 'Healthcare', desc: 'Verified clinics and wellness offers.' },
  { tag: 'Theme', title: 'Tech & Repair', desc: 'Device care, repairs, and accessories.' },
  { tag: 'Theme', title: 'Community', desc: 'Neighborhood events and impact projects.' },
]
</script>
