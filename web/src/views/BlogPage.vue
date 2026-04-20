<template>
  <div ref="root" class="grid gap-6">
    <div class="rounded-3xl border border-[color:var(--border)] bg-[color:var(--card)] p-6" data-hero>
      <h1 class="text-3xl font-semibold tracking-tight text-[color:var(--fg)]">Blog / Stories</h1>
      <p class="mt-2 text-sm text-[color:var(--muted)]">SEO + engagement engine: success stories, marketing tips, community impact.</p>
    </div>

    <div class="grid gap-4 lg:grid-cols-3">
      <article
        v-for="p in posts"
        :key="p.title"
        class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-5"
        data-reveal
      >
        <div class="text-xs font-semibold text-[color:var(--muted)]">{{ p.tag }}</div>
        <h2 class="mt-2 text-lg font-semibold text-[color:var(--fg)]">{{ p.title }}</h2>
        <p class="mt-2 text-sm text-[color:var(--muted)]">{{ p.desc }}</p>
        <button class="mt-4 rounded-xl bg-[color:var(--bg)]/18 px-4 py-2 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95" type="button">
          Read more
        </button>
      </article>
    </div>
  </div>
</template>

<script setup>
import { useMajesticMotion } from '../composables/useMajesticMotion'

const { root } = useMajesticMotion()

const posts = [
  { tag: 'SME Success', title: 'How a small cafe doubled foot traffic', desc: 'From Facebook discovery to BizGathers listings.' },
  { tag: 'Marketing Tips', title: 'Using Facebook to drive profile visits', desc: 'Simple tactics to move from likes to customers.' },
  { tag: 'Community Impact', title: 'Neighborhood drives and local giving', desc: 'Highlighting charities and community events.' },
]
</script>
