<template>
  <div ref="root">
    <section class="relative" data-hero>
      <div
        class="pointer-events-none absolute -inset-x-10 -top-24 h-72 bg-[radial-gradient(closest-side,rgba(241,198,23,0.22),transparent)] blur-2xl"
        data-glow
      ></div>

      <div class="relative grid gap-10 lg:grid-cols-12 lg:items-center">
        <div class="lg:col-span-6">
          <div data-reveal-item class="inline-flex items-center gap-2 rounded-full border border-[color:var(--border)] bg-[color:var(--card)] px-3 py-1 text-xs text-[color:var(--muted)]">
          <span class="h-2 w-2 rounded-full bg-[color:var(--brand)]"></span>
          Online directory for local SMEs
        </div>

        <h1 data-reveal-item class="mt-5 text-balance text-4xl font-semibold tracking-tight text-[color:var(--fg)] sm:text-5xl">
          Find trusted local businesses—fast.
        </h1>

        <p data-reveal-item class="mt-4 text-pretty text-base text-[color:var(--muted)] sm:text-lg">
          Search by service and location, filter by trust score, and explore verified listings with clear profiles.
        </p>

        <div data-reveal-item class="mt-7 rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-4">
          <div class="grid gap-3 md:grid-cols-3">
            <input
              v-model="service"
              class="rounded-xl border border-[color:var(--border)] bg-[color:var(--bg)]/50 px-3 py-3 text-sm text-[color:var(--fg)] placeholder:text-[color:var(--muted)] focus:outline-none focus:ring-2 focus:ring-[color:var(--brand-2)]"
              placeholder="Service type (e.g., Coffee, Salon)"
            />
            <input
              v-model="location"
              class="rounded-xl border border-[color:var(--border)] bg-[color:var(--bg)]/50 px-3 py-3 text-sm text-[color:var(--fg)] placeholder:text-[color:var(--muted)] focus:outline-none focus:ring-2 focus:ring-[color:var(--brand-2)]"
              placeholder="Location (e.g., Cebu City)"
            />
            <button
              class="rounded-xl bg-[color:var(--brand)] px-4 py-3 text-sm font-semibold text-black hover:brightness-95"
              type="button"
              @click="goSearch"
            >
              Search
            </button>
          </div>
          <div class="mt-3 flex flex-wrap gap-2 text-xs text-[color:var(--muted)]">
            <span class="rounded-full border border-[color:var(--border)] bg-[color:var(--bg)]/30 px-2 py-1">Map View</span>
            <span class="rounded-full border border-[color:var(--border)] bg-[color:var(--bg)]/30 px-2 py-1">Gallery View</span>
            <span class="rounded-full border border-[color:var(--border)] bg-[color:var(--bg)]/30 px-2 py-1">4+ Trust Score</span>
            <span class="rounded-full border border-[color:var(--border)] bg-[color:var(--bg)]/30 px-2 py-1">Within 5km</span>
          </div>
        </div>

        <div data-reveal-item class="mt-6 flex flex-wrap gap-3">
          <a
            href="#"
            class="rounded-full bg-[color:var(--brand)] px-5 py-3 text-sm font-semibold text-black hover:brightness-95"
          >
            Get Listed — It’s Free
          </a>
          <RouterLink
            to="/directory"
            class="rounded-full border border-[color:var(--border)] bg-[color:var(--card)] px-5 py-3 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95"
          >
            Browse directory
          </RouterLink>
        </div>
      </div>

      <div class="relative lg:col-span-6">
        <div class="absolute -inset-6 rounded-3xl bg-[color:var(--brand-2)] blur-3xl"></div>
        <div data-reveal-item class="relative overflow-hidden rounded-3xl border border-[color:var(--border)] bg-[color:var(--card)] p-6">
          <img
            :src="bigLogo"
            alt="BizGathers Big Logo"
            class="mx-auto max-h-[320px] w-auto object-contain"
            loading="eager"
            decoding="async"
          />
          <div class="mt-6 grid gap-3 sm:grid-cols-3">
            <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--bg)]/30 p-4">
              <div class="text-xs font-semibold text-[color:var(--fg)]">Map / Gallery</div>
              <div class="mt-1 text-sm text-[color:var(--muted)]">Choose the view that fits your search.</div>
            </div>
            <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--bg)]/30 p-4">
              <div class="text-xs font-semibold text-[color:var(--fg)]">Trust score</div>
              <div class="mt-1 text-sm text-[color:var(--muted)]">Filter businesses by 4+ ratings.</div>
            </div>
            <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--bg)]/30 p-4">
              <div class="text-xs font-semibold text-[color:var(--fg)]">Verified</div>
              <div class="mt-1 text-sm text-[color:var(--muted)]">Spotlight listings for premium partners.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>

    <section class="mt-16" data-reveal>
    <div class="flex items-end justify-between gap-4">
      <div>
        <h2 class="text-xl font-semibold text-[color:var(--fg)]">Featured campaigns</h2>
        <p class="mt-1 text-sm text-[color:var(--muted)]">A quick carousel-style grid (mock data for now).</p>
      </div>
      <RouterLink class="text-sm font-semibold text-[color:var(--brand)] hover:brightness-95" to="/campaigns">
        View all
      </RouterLink>
    </div>

    <div class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
      <div
        v-for="c in campaigns"
        :key="c.title"
        class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-4"
        data-reveal
      >
        <div class="flex items-center justify-between">
          <div class="text-xs font-semibold text-[color:var(--fg)]">{{ c.tag }}</div>
          <span class="rounded-full bg-[color:var(--bg)]/30 px-2 py-1 text-[11px] text-[color:var(--muted)]">Trending</span>
        </div>
        <div class="mt-3 text-sm font-semibold text-[color:var(--fg)]">{{ c.title }}</div>
        <div class="mt-1 text-sm text-[color:var(--muted)]">{{ c.desc }}</div>
      </div>
    </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import bigLogo from '../assets/brand/BigLogo.png'
import { useMajesticMotion } from '../composables/useMajesticMotion'

const { root } = useMajesticMotion()

const router = useRouter()
const service = ref('')
const location = ref('')

const campaigns = [
  { tag: 'Seasonal', title: 'Weekend Food Crawl', desc: 'Discover local eats with exclusive offers.' },
  { tag: 'Community', title: 'New Shops Spotlight', desc: 'Fresh openings worth visiting.' },
  { tag: 'SME Boost', title: 'Service Deals Week', desc: 'Top-rated services near you.' },
  { tag: 'Holiday', title: 'Gift & Gather', desc: 'Support local makers and shops.' },
]

function goSearch() {
  router.push({
    name: 'directory',
    query: { service: service.value || undefined, location: location.value || undefined },
  })
}
</script>
