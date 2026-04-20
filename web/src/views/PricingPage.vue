<template>
  <div ref="root" class="grid gap-6">
    <div class="rounded-3xl border border-[color:var(--border)] bg-[color:var(--card)] p-6" data-hero>
      <h1 class="text-3xl font-semibold tracking-tight text-[color:var(--fg)]">Pricing & Subscription</h1>
      <p class="mt-2 text-sm text-[color:var(--muted)]">Monetization and business onboarding for BizGathers.</p>
    </div>

    <div class="grid gap-4 lg:grid-cols-3">
      <div class="rounded-3xl border border-[color:var(--border)] bg-[color:var(--card)] p-6" data-reveal>
        <div class="text-sm font-semibold text-[color:var(--fg)]">Free</div>
        <div class="mt-2 text-3xl font-semibold text-[color:var(--fg)]">₱0</div>
        <ul class="mt-4 grid gap-2 text-sm text-[color:var(--muted)]">
          <li>Basic profile listing</li>
          <li>Standard search ranking</li>
          <li>Category + location visibility</li>
        </ul>
        <a class="mt-5 inline-flex rounded-xl bg-[color:var(--bg)]/18 px-5 py-3 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95" href="#">
          Get listed
        </a>
      </div>

      <div class="rounded-3xl border border-[color:var(--brand-2)] bg-[color:var(--brand-2)]/30 p-6 ring-1 ring-[color:var(--brand-2)]" data-reveal>
        <div class="flex items-center justify-between">
          <div class="text-sm font-semibold text-[color:var(--fg)]">Silver</div>
          <span class="rounded-full bg-[color:var(--brand)] px-2 py-1 text-[11px] font-semibold text-black">Popular</span>
        </div>
        <div class="mt-2 text-3xl font-semibold text-[color:var(--fg)]">₱499</div>
        <ul class="mt-4 grid gap-2 text-sm text-[color:var(--fg)]/80">
          <li>Priority ranking</li>
          <li>Featured status</li>
          <li>Basic analytics</li>
        </ul>
        <a class="mt-5 inline-flex rounded-xl bg-[color:var(--brand)] px-5 py-3 text-sm font-semibold text-black hover:brightness-95" href="#">
          Upgrade
        </a>
      </div>

      <div class="rounded-3xl border border-[color:var(--border)] bg-[color:var(--card)] p-6" data-reveal>
        <div class="text-sm font-semibold text-[color:var(--fg)]">Gold</div>
        <div class="mt-2 text-3xl font-semibold text-[color:var(--fg)]">₱999</div>
        <ul class="mt-4 grid gap-2 text-sm text-[color:var(--muted)]">
          <li>Top placement</li>
          <li>Spotlight campaigns</li>
          <li>Social media shoutouts</li>
        </ul>
        <a class="mt-5 inline-flex rounded-xl bg-[color:var(--bg)]/18 px-5 py-3 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95" href="#">
          Contact sales
        </a>
      </div>
    </div>

    <div class="rounded-3xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 p-6" data-reveal>
      <div class="text-sm font-semibold text-[color:var(--fg)]">Upsell packages</div>
      <div class="mt-2 text-sm text-[color:var(--muted)]">
        Storytelling Package: Professional photoshoot + written feature.
      </div>
    </div>
  </div>
</template>

<script setup>
import { useMajesticMotion } from '../composables/useMajesticMotion'

const { root } = useMajesticMotion()
</script>
