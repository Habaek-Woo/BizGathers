<template>
  <div ref="root" class="grid gap-6">
    <div class="rounded-3xl border border-[color:var(--border)] bg-[color:var(--card)] p-6" data-hero>
      <h1 class="text-3xl font-semibold tracking-tight text-[color:var(--fg)]">About BizGathers</h1>
      <p class="mt-2 text-sm text-[color:var(--muted)]">Humanizing the directory and building trust for SMEs.</p>
    </div>

    <div class="grid gap-4 lg:grid-cols-3">
      <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-5 lg:col-span-2" data-reveal>
        <div class="text-sm font-semibold text-[color:var(--fg)]">Mission & Vision</div>
        <p class="mt-2 text-sm text-[color:var(--muted)]">
          Empowering SMEs through digital visibility and community support—bridging discovery from social media into
          professional listings.
        </p>
      </div>

      <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 p-5" data-reveal>
        <div class="text-sm font-semibold text-[color:var(--fg)]">Partnerships</div>
        <p class="mt-2 text-sm text-[color:var(--muted)]">Local orgs, communities, and programs (logos later).</p>
      </div>
    </div>

    <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-6" data-reveal>
      <div class="text-sm font-semibold text-[color:var(--fg)]">Story of BizGathers</div>
      <p class="mt-2 text-sm text-[color:var(--muted)]">
        Originating from the Facebook community—BizGathers helps great local businesses become easy to find, compare,
        and contact.
      </p>
    </div>

    <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-6" data-reveal>
      <div class="text-sm font-semibold text-[color:var(--fg)]">Team</div>
      <div class="mt-4 grid gap-3 sm:grid-cols-3">
        <div v-for="n in 3" :key="n" class="h-24 rounded-2xl border border-dashed border-[color:var(--border)] bg-[color:var(--bg)]/22"></div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useMajesticMotion } from '../composables/useMajesticMotion'

const { root } = useMajesticMotion()
</script>
