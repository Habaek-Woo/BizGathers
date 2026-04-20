<template>
  <div ref="root" class="grid gap-6">
    <div class="overflow-hidden rounded-3xl border border-[color:var(--border)] bg-[color:var(--card)]" data-hero>
      <div class="h-40 bg-gradient-to-r from-[color:var(--bg)]/30 via-[color:var(--card)] to-[color:var(--bg)]/30"></div>
      <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <div class="text-xs font-semibold text-[color:var(--muted)]">Business profile</div>
          <h1 class="mt-1 text-2xl font-semibold text-[color:var(--fg)]">{{ business.name }}</h1>
          <div class="mt-1 text-sm text-[color:var(--muted)]">
            {{ business.category }} · ⭐ {{ business.rating.toFixed(1) }} · {{ business.location }}
          </div>
        </div>

        <div class="flex flex-wrap gap-2">
          <a
            href="#"
            class="rounded-xl bg-[color:var(--brand)] px-4 py-2 text-sm font-semibold text-black hover:brightness-95"
          >
            Messenger
          </a>
          <RouterLink
            to="/directory"
            class="rounded-xl border border-[color:var(--border)] bg-[color:var(--card)] px-4 py-2 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95"
          >
            Back to directory
          </RouterLink>
        </div>
      </div>
    </div>

    <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-2" data-reveal>
      <div class="flex flex-wrap gap-2">
        <button
          v-for="t in tabs"
          :key="t"
          type="button"
          class="rounded-xl px-4 py-2 text-sm font-semibold"
          :class="tab === t ? 'bg-[color:var(--brand)] text-black' : 'text-[color:var(--muted)] hover:bg-[color:var(--bg)]/18 hover:text-[color:var(--fg)]'"
          @click="tab = t"
        >
          {{ t }}
        </button>
      </div>
    </div>

    <section v-if="tab === 'Overview'" class="grid gap-4 lg:grid-cols-3">
      <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-5 lg:col-span-2" data-reveal>
        <div class="text-sm font-semibold text-[color:var(--fg)]">NAP</div>
        <div class="mt-3 grid gap-3 sm:grid-cols-2">
          <div class="rounded-xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 p-4">
            <div class="text-xs font-semibold text-[color:var(--muted)]">Name</div>
            <div class="mt-1 text-sm text-[color:var(--fg)]">{{ business.name }}</div>
          </div>
          <div class="rounded-xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 p-4">
            <div class="text-xs font-semibold text-[color:var(--muted)]">Phone</div>
            <div class="mt-1 text-sm text-[color:var(--fg)]">{{ business.phone }}</div>
          </div>
          <div class="rounded-xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 p-4 sm:col-span-2">
            <div class="text-xs font-semibold text-[color:var(--muted)]">Address</div>
            <div class="mt-1 text-sm text-[color:var(--fg)]">{{ business.address }}</div>
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 p-5" data-reveal>
        <div class="text-sm font-semibold text-[color:var(--fg)]">Quick actions</div>
        <div class="mt-4 grid gap-2">
          <button class="rounded-xl bg-[color:var(--card)] px-4 py-2 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95" type="button">
            Get directions
          </button>
          <button class="rounded-xl bg-[color:var(--card)] px-4 py-2 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95" type="button">
            Call now
          </button>
          <button class="rounded-xl bg-[color:var(--card)] px-4 py-2 text-sm font-semibold text-[color:var(--fg)] hover:brightness-95" type="button">
            Save
          </button>
        </div>
      </div>
    </section>

    <section v-else-if="tab === 'Story'" class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-6" data-reveal>
      <div class="text-sm font-semibold text-[color:var(--fg)]">The story</div>
      <p class="mt-3 text-sm text-[color:var(--muted)]">
        {{ business.story }}
      </p>
      <div class="mt-5 grid gap-3 sm:grid-cols-3">
        <div v-for="n in 3" :key="n" class="h-28 rounded-2xl border border-dashed border-[color:var(--border)] bg-[color:var(--bg)]/22"></div>
      </div>
    </section>

    <section v-else-if="tab === 'Promotions'" class="grid gap-4 sm:grid-cols-2">
      <div
        v-for="p in promotions"
        :key="p.title"
        class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-5"
        data-reveal
      >
        <div class="text-xs font-semibold text-[color:var(--muted)]">{{ p.tag }}</div>
        <div class="mt-2 text-sm font-semibold text-[color:var(--fg)]">{{ p.title }}</div>
        <div class="mt-1 text-sm text-[color:var(--muted)]">{{ p.desc }}</div>
        <button
          type="button"
          class="mt-4 rounded-xl bg-[color:var(--brand)] px-4 py-2 text-sm font-semibold text-black hover:brightness-95"
        >
          Claim now
        </button>
      </div>
    </section>

    <section v-else class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--card)] p-6" data-reveal>
      <div class="flex items-end justify-between gap-4">
        <div>
          <div class="text-sm font-semibold text-[color:var(--fg)]">Analytics (Owner view)</div>
          <div class="mt-1 text-sm text-[color:var(--muted)]">Mock metrics for the functional prototype.</div>
        </div>
        <span class="rounded-full bg-[color:var(--bg)]/30 px-3 py-1 text-xs text-[color:var(--muted)]">Last 30 days</span>
      </div>

      <div class="mt-5 grid gap-3 sm:grid-cols-3">
        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 p-5">
          <div class="text-xs font-semibold text-[color:var(--muted)]">Get Directions clicks</div>
          <div class="mt-2 text-2xl font-semibold text-[color:var(--fg)]">{{ analytics.directions }}</div>
        </div>
        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 p-5">
          <div class="text-xs font-semibold text-[color:var(--muted)]">Profile visits</div>
          <div class="mt-2 text-2xl font-semibold text-[color:var(--fg)]">{{ analytics.visits }}</div>
        </div>
        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--bg)]/22 p-5">
          <div class="text-xs font-semibold text-[color:var(--muted)]">Promo claims</div>
          <div class="mt-2 text-2xl font-semibold text-[color:var(--fg)]">{{ analytics.claims }}</div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue'
import { RouterLink, useRoute } from 'vue-router'
import { useMajesticMotion } from '../composables/useMajesticMotion'

const { root } = useMajesticMotion()

const route = useRoute()
const id = computed(() => String(route.params.id || 'sunrise-coffee'))

const tab = ref('Overview')
const tabs = ['Overview', 'Story', 'Promotions', 'Analytics']

const business = computed(() => {
  const seed = id.value
  const name =
    seed === 'luna-salon'
      ? 'Luna Salon Studio'
      : seed === 'bayan-gadgets'
        ? 'Bayan Gadgets'
        : seed === 'carewell-clinic'
          ? 'CareWell Clinic'
          : 'Sunrise Coffee'

  return {
    id: seed,
    name,
    category: seed === 'carewell-clinic' ? 'Healthcare' : seed === 'bayan-gadgets' ? 'Retail' : seed === 'luna-salon' ? 'Services' : 'F&B',
    rating: seed === 'luna-salon' ? 4.3 : seed === 'bayan-gadgets' ? 4.8 : seed === 'carewell-clinic' ? 4.7 : 4.6,
    location: 'Cebu City (Mock)',
    phone: '+63 900 000 0000',
    address: '123 Sample Street, Cebu City, PH',
    story:
      'This is where the founder’s journey goes. For the wireframe/mockup we’ll replace this with real copy and photos later.',
  }
})

const promotions = [
  { tag: 'Live offer', title: 'Buy 1 Take 1', desc: 'Valid for dine-in only. Limited slots per day.' },
  { tag: 'Seasonal', title: 'Weekend Bundle', desc: 'Bundle deal for families and groups.' },
]

const analytics = { directions: 214, visits: 1680, claims: 73 }
</script>
