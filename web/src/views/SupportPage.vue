<template>
  <div ref="root" class="grid gap-6">
    <div class="rounded-3xl border border-[color:var(--border)] bg-[color:var(--card)] p-6" data-hero>
      <h1 class="text-3xl font-semibold tracking-tight text-[color:var(--fg)]">Support</h1>
      <p class="mt-2 text-sm text-[color:var(--muted)]">Customer success and retention for merchants.</p>
    </div>

    <div class="grid gap-4 lg:grid-cols-3">
      <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-6 lg:col-span-2" data-reveal>
        <div class="text-sm font-semibold text-[color:var(--fg)]">Merchant FAQs</div>
        <div class="mt-4 grid gap-3">
          <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 p-4" data-reveal>
            <div class="text-sm font-semibold text-[color:var(--fg)]">How do I claim my listing?</div>
            <div class="mt-1 text-sm text-[color:var(--muted)]">Mock flow: verify via email/phone + business documents.</div>
          </div>
          <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 p-4" data-reveal>
            <div class="text-sm font-semibold text-[color:var(--fg)]">How do I track analytics?</div>
            <div class="mt-1 text-sm text-[color:var(--muted)]">Owner view shows visits, direction clicks, and promo claims.</div>
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 p-6" data-reveal>
        <div class="text-sm font-semibold text-[color:var(--fg)]">Merchant SOPs</div>
        <p class="mt-2 text-sm text-[color:var(--muted)]">Downloadable PDF guides (placeholder for now).</p>
        <div class="mt-4 grid gap-2">
          <button class="rounded-xl bg-[color:var(--card)] px-4 py-2 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95" type="button">
            Onboarding guide (PDF)
          </button>
          <button class="rounded-xl bg-[color:var(--card)] px-4 py-2 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95" type="button">
            Campaign setup (PDF)
          </button>
          <button class="rounded-xl bg-[color:var(--card)] px-4 py-2 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95" type="button">
            Subscription renewal (PDF)
          </button>
        </div>
      </div>
    </div>

    <div class="rounded-3xl border border-[color:var(--border)] bg-[color:var(--card)] p-6" data-reveal>
      <div class="text-sm font-semibold text-[color:var(--fg)]">Contact form</div>
      <div class="mt-4 grid gap-3 sm:grid-cols-2">
        <input
          class="rounded-xl border border-[color:var(--border)] bg-[color:var(--bg)]/50 px-3 py-3 text-sm text-[color:var(--fg)] placeholder:text-[color:var(--muted)] focus:outline-none focus:ring-2 focus:ring-[color:var(--brand-2)]"
          placeholder="Business name"
        />
        <input
          class="rounded-xl border border-[color:var(--border)] bg-[color:var(--bg)]/50 px-3 py-3 text-sm text-[color:var(--fg)] placeholder:text-[color:var(--muted)] focus:outline-none focus:ring-2 focus:ring-[color:var(--brand-2)]"
          placeholder="Email"
        />
        <textarea
          class="sm:col-span-2 min-h-32 rounded-xl border border-[color:var(--border)] bg-[color:var(--bg)]/50 px-3 py-3 text-sm text-[color:var(--fg)] placeholder:text-[color:var(--muted)] focus:outline-none focus:ring-2 focus:ring-[color:var(--brand-2)]"
          placeholder="How can we help?"
        ></textarea>
        <button
          class="sm:col-span-2 rounded-xl bg-[color:var(--brand)] px-5 py-3 text-sm font-semibold text-black hover:brightness-95"
          type="button"
        >
          Send message
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useMajesticMotion } from '../composables/useMajesticMotion'

const { root } = useMajesticMotion()
</script>
