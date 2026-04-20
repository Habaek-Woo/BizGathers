<template>
  <div ref="root" class="flex flex-col gap-6">
    <div class="flex flex-wrap items-end justify-between gap-4" data-hero>
      <div>
        <h1 class="text-3xl font-semibold tracking-tight text-[color:var(--fg)]">Directory</h1>
        <p class="mt-2 text-sm text-[color:var(--muted)]">
          Browse SMEs by category, distance, and trust score. Toggle between gallery and map (mock).
        </p>
      </div>

      <div class="flex items-center gap-2">
        <button
          type="button"
          class="rounded-full border border-[color:var(--border)] bg-[color:var(--card)] px-4 py-2 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95"
          :class="view === 'gallery' ? 'ring-2 ring-[color:var(--brand-2)]' : ''"
          @click="view = 'gallery'"
        >
          Gallery View
        </button>
        <button
          type="button"
          class="rounded-full border border-[color:var(--border)] bg-[color:var(--card)] px-4 py-2 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95"
          :class="view === 'map' ? 'ring-2 ring-[color:var(--brand-2)]' : ''"
          @click="view = 'map'"
        >
          Map View
        </button>
      </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-12" data-reveal>
      <aside class="lg:col-span-4">
        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-5" data-reveal>
          <div class="text-sm font-semibold text-[color:var(--fg)]">Filters</div>

          <div class="mt-4 grid gap-4">
            <label class="grid gap-2">
              <span class="text-xs font-semibold text-[color:var(--muted)]">Service type</span>
              <input
                v-model="service"
                class="rounded-xl border border-[color:var(--border)] bg-[color:var(--bg)]/50 px-3 py-2 text-sm text-[color:var(--fg)] placeholder:text-[color:var(--muted)] focus:outline-none focus:ring-2 focus:ring-[color:var(--brand-2)]"
                placeholder="Coffee, Salon, Repair…"
              />
            </label>

            <label class="grid gap-2">
              <span class="text-xs font-semibold text-[color:var(--muted)]">Location</span>
              <input
                v-model="location"
                class="rounded-xl border border-[color:var(--border)] bg-[color:var(--bg)]/50 px-3 py-2 text-sm text-[color:var(--fg)] placeholder:text-[color:var(--muted)] focus:outline-none focus:ring-2 focus:ring-[color:var(--brand-2)]"
                placeholder="City, neighborhood…"
              />
            </label>

            <div class="grid gap-2">
              <div class="text-xs font-semibold text-[color:var(--muted)]">Categories</div>
              <div class="flex flex-wrap gap-2">
                <button
                  v-for="c in categories"
                  :key="c"
                  type="button"
                  class="rounded-full border border-[color:var(--border)] px-3 py-1.5 text-xs font-semibold"
                  :class="selectedCategories.has(c) ? 'bg-[color:var(--brand)] text-black' : 'bg-[color:var(--card)] text-[color:var(--fg)] hover:brightness-95'"
                  @click="toggleCategory(c)"
                >
                  {{ c }}
                </button>
              </div>
            </div>

            <div class="grid gap-2">
              <div class="text-xs font-semibold text-[color:var(--muted)]">Proximity</div>
              <select
                v-model="proximity"
                class="rounded-xl border border-[color:var(--border)] bg-[color:var(--bg)]/50 px-3 py-2 text-sm text-[color:var(--fg)] focus:outline-none focus:ring-2 focus:ring-[color:var(--brand-2)]"
              >
                <option value="5">Within 5km</option>
                <option value="10">Within 10km</option>
                <option value="25">Within 25km</option>
              </select>
            </div>

            <label class="flex items-center justify-between gap-3 rounded-xl border border-[color:var(--border)] bg-[color:var(--bg)]/30 px-3 py-2">
              <span class="text-sm font-semibold text-[color:var(--fg)]/80">Trust Score 4+</span>
              <input v-model="trust4plus" type="checkbox" class="h-4 w-4 accent-[color:var(--brand)]" />
            </label>
          </div>

          <div class="mt-5 flex gap-2">
            <button
              type="button"
              class="w-full rounded-xl bg-[color:var(--brand)] px-4 py-2 text-sm font-semibold text-black hover:brightness-95"
              @click="applyQuery"
            >
              Apply
            </button>
            <button
              type="button"
              class="w-full rounded-xl border border-[color:var(--border)] bg-[color:var(--card)] px-4 py-2 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95"
              @click="reset"
            >
              Reset
            </button>
          </div>
        </div>
      </aside>

      <section class="lg:col-span-8">
        <div v-if="view === 'map'" class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-6" data-reveal>
          <div class="text-sm font-semibold text-[color:var(--fg)]">Map View (Mock)</div>
          <p class="mt-2 text-sm text-[color:var(--muted)]">
            For the functional mockup we’ll swap this with a real map (Google/Mapbox) later.
          </p>
          <div class="mt-5 h-64 rounded-2xl border border-dashed border-[color:var(--border)] bg-[color:var(--bg)]/30"></div>
        </div>

        <div v-else class="grid gap-4 sm:grid-cols-2">
          <div
            v-for="b in filtered"
            :key="b.id"
            class="relative overflow-hidden rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-5"
            data-reveal
          >
            <div class="absolute right-4 top-4">
              <span
                class="rounded-full px-2 py-1 text-[11px] font-semibold"
                :class="b.badge === 'Premium' ? 'bg-[color:var(--brand)] text-black' : 'bg-[color:var(--bg)]/30 text-[color:var(--muted)]'"
              >
                {{ b.badge }}
              </span>
            </div>

            <div class="text-sm font-semibold text-[color:var(--fg)]">{{ b.name }}</div>
            <div class="mt-1 text-sm text-[color:var(--muted)]">{{ b.category }} · {{ b.distanceKm }}km away</div>

            <div class="mt-3 flex items-center gap-2 text-xs text-[color:var(--muted)]">
              <span class="rounded-full bg-[color:var(--bg)]/30 px-2 py-1">⭐ {{ b.rating.toFixed(1) }}</span>
              <span v-if="b.verified" class="rounded-full bg-[color:var(--brand-2)] px-2 py-1 text-[color:var(--brand)]">
                Verified by BizGathers
              </span>
            </div>

            <div class="mt-4 flex gap-2">
              <RouterLink
                :to="{ name: 'business', params: { id: b.id } }"
                class="rounded-xl bg-[color:var(--bg)]/18 px-4 py-2 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95"
              >
                View profile
              </RouterLink>
              <button
                type="button"
                class="rounded-xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 px-4 py-2 text-sm font-semibold text-[color:var(--fg)]/90 hover:brightness-95"
              >
                Get directions
              </button>
            </div>
          </div>
        </div>

        <div class="mt-6 rounded-2xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 p-5" data-reveal>
          <div class="text-sm font-semibold text-[color:var(--fg)]">Premium highlight</div>
          <p class="mt-1 text-sm text-[color:var(--muted)]">
            Spotlight businesses appear at the top with larger thumbnails and verification.
          </p>
        </div>
      </section>
    </div>
  </div>
</template>

<script setup>
import { computed, reactive, ref, watchEffect } from 'vue'
import { RouterLink, useRoute, useRouter } from 'vue-router'
import { useMajesticMotion } from '../composables/useMajesticMotion'

const { root } = useMajesticMotion()

const router = useRouter()
const route = useRoute()

const view = ref('gallery')
const service = ref('')
const location = ref('')
const proximity = ref('5')
const trust4plus = ref(false)
const selectedCategories = reactive(new Set())

const categories = ['F&B', 'Retail', 'Services', 'Tech', 'Healthcare']

const businesses = [
  { id: 'sunrise-coffee', name: 'Sunrise Coffee', category: 'F&B', distanceKm: 2.1, rating: 4.6, badge: 'Premium', verified: true },
  { id: 'luna-salon', name: 'Luna Salon Studio', category: 'Services', distanceKm: 3.4, rating: 4.3, badge: 'Free', verified: false },
  { id: 'bayan-gadgets', name: 'Bayan Gadgets', category: 'Retail', distanceKm: 4.9, rating: 4.8, badge: 'Premium', verified: true },
  { id: 'swift-repair', name: 'Swift Repair Hub', category: 'Tech', distanceKm: 8.0, rating: 4.1, badge: 'Free', verified: false },
  { id: 'carewell-clinic', name: 'CareWell Clinic', category: 'Healthcare', distanceKm: 6.2, rating: 4.7, badge: 'Premium', verified: true },
  { id: 'neighborhood-bakes', name: 'Neighborhood Bakes', category: 'F&B', distanceKm: 1.7, rating: 4.4, badge: 'Free', verified: false },
]

const filtered = computed(() => {
  const qService = service.value.trim().toLowerCase()
  const qLocation = location.value.trim().toLowerCase()
  const prox = Number(proximity.value)

  return businesses
    .filter((b) => (trust4plus.value ? b.rating >= 4.0 : true))
    .filter((b) => (selectedCategories.size ? selectedCategories.has(b.category) : true))
    .filter((b) => b.distanceKm <= prox)
    .filter((b) => (qService ? b.name.toLowerCase().includes(qService) || b.category.toLowerCase().includes(qService) : true))
    .filter((b) => (qLocation ? 'cebu city'.includes(qLocation) || 'downtown'.includes(qLocation) : true))
})

function toggleCategory(c) {
  if (selectedCategories.has(c)) selectedCategories.delete(c)
  else selectedCategories.add(c)
}

function applyQuery() {
  router.push({
    name: 'directory',
    query: {
      service: service.value || undefined,
      location: location.value || undefined,
      proximity: proximity.value || undefined,
      trust: trust4plus.value ? '4plus' : undefined,
      cats: selectedCategories.size ? Array.from(selectedCategories).join(',') : undefined,
    },
  })
}

function reset() {
  service.value = ''
  location.value = ''
  proximity.value = '5'
  trust4plus.value = false
  selectedCategories.clear()
  router.push({ name: 'directory' })
}

watchEffect(() => {
  const q = route.query
  service.value = typeof q.service === 'string' ? q.service : ''
  location.value = typeof q.location === 'string' ? q.location : ''
  proximity.value = typeof q.proximity === 'string' ? q.proximity : '5'
  trust4plus.value = q.trust === '4plus'

  selectedCategories.clear()
  if (typeof q.cats === 'string' && q.cats.trim()) {
    for (const c of q.cats.split(',').map((x) => x.trim())) selectedCategories.add(c)
  }
})
</script>
