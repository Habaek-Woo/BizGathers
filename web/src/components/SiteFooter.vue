<template>
  <footer class="border-t border-white/10 bg-black/20">
    <div class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
      <div class="grid gap-10 md:grid-cols-12">
        <!-- Brand -->
        <div class="md:col-span-5">
          <div class="flex items-center gap-3">
            <img
              :src="icon"
              alt="BizGathers icon"
              class="h-10 w-10 rounded-xl bg-[color:var(--card)] p-1.5 ring-1 ring-[color:var(--border)]"
            />
            <div>
              <div class="text-sm font-semibold text-[color:var(--fg)]">BizGathers</div>
              <div class="text-xs text-[color:var(--muted)]">Where Local Business Grows Together</div>
            </div>
          </div>

          <p class="mt-4 max-w-md text-sm leading-relaxed text-[color:var(--muted)]">
            A centralized online directory that helps SMEs get discovered beyond social feeds—then connect instantly
            with customers.
          </p>

          <div class="mt-5 flex flex-wrap items-center gap-2">
            <a
              class="inline-flex items-center gap-2 rounded-full border border-[color:var(--border)] bg-[color:var(--card)] px-3 py-2 text-xs font-semibold text-[color:var(--fg)]/80 hover:brightness-95 focus:outline-none focus-visible:ring-2 focus-visible:ring-[color:var(--brand-2)]"
              href="https://www.facebook.com/bizgathers"
              target="_blank"
              rel="noreferrer"
              aria-label="Visit BizGathers on Facebook"
            >
              <img :src="facebookIcon" alt="" class="h-4 w-4" />
            </a>
            <span class="text-xs text-[color:var(--muted)]">Socials: @BizGathers</span>
          </div>
        </div>

        <!-- Links -->
        <div class="md:col-span-3">
          <div class="text-xs font-semibold tracking-wide text-[color:var(--fg)]/80">Explore</div>
          <div class="mt-4 grid grid-cols-2 gap-x-6 gap-y-3 text-sm text-[color:var(--muted)]">
            <RouterLink class="hover:text-[color:var(--fg)]" to="/directory">Directory</RouterLink>
            <RouterLink class="hover:text-[color:var(--fg)]" to="/campaigns">Campaigns</RouterLink>
            <RouterLink class="hover:text-[color:var(--fg)]" to="/blog">Blog / Stories</RouterLink>
            <RouterLink class="hover:text-[color:var(--fg)]" to="/pricing">Pricing</RouterLink>
            <RouterLink class="hover:text-[color:var(--fg)]" to="/about">About</RouterLink>
            <RouterLink class="hover:text-[color:var(--fg)]" to="/support">Support</RouterLink>
          </div>
        </div>

        <!-- Newsletter -->
        <div class="md:col-span-4">
          <div class="relative overflow-hidden rounded-3xl border border-[color:var(--border)] bg-[color:var(--card)] p-6">
            <div class="pointer-events-none absolute -right-16 -top-16 h-48 w-48 rounded-full bg-[color:var(--brand-2)] blur-3xl"></div>
            <div class="relative">
              <div class="text-sm font-semibold text-[color:var(--fg)]">Stay updated</div>
              <p class="mt-1 text-sm text-[color:var(--muted)]">Get updates on the next community gather.</p>

              <div class="mt-4 grid gap-2 sm:grid-cols-[1fr_auto]">
                <label class="sr-only" for="newsletter-email">Email address</label>
                <input
                  id="newsletter-email"
                  class="w-full rounded-2xl border border-[color:var(--border)] bg-[color:var(--bg)]/50 px-4 py-3 text-sm text-[color:var(--fg)] placeholder:text-[color:var(--muted)] focus:outline-none focus:ring-2 focus:ring-[color:var(--brand-2)]"
                  placeholder="you@email.com"
                  inputmode="email"
                  autocomplete="email"
                />
                <button
                  class="rounded-2xl bg-[color:var(--brand)] px-5 py-3 text-sm font-semibold text-black hover:brightness-95"
                  type="button"
                >
                  Join
                </button>
              </div>

              <div class="mt-4 text-xs text-[color:var(--muted)]">Contact: Phone/Email</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="border-t border-[color:var(--border)] py-4 text-center text-xs text-[color:var(--muted)]">
      © {{ new Date().getFullYear() }} BizGathers. All rights reserved. · v0.0.1
    </div>
  </footer>
</template>

<script setup>
import { RouterLink } from 'vue-router'
import icon from '../assets/brand/Logo.png'
import facebookIcon from '../assets/facebook.svg'
</script>
