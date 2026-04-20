import { nextTick, onMounted, ref } from 'vue'
import { useGsap, useGsapCleanup } from './useGsap'

/**
 * Majestic motion presets:
 * - page intro reveal (staggered)
 * - scroll reveal for cards/sections
 * Add data attributes in templates:
 *   data-hero, data-reveal, data-reveal-item
 */
export function useMajesticMotion() {
  const root = ref(null)
  const ctxRef = ref(null)
  useGsapCleanup(ctxRef)

  onMounted(async () => {
    await nextTick()
    const { gsap, ScrollTrigger, createContext, reducedMotion } = await useGsap()
    if (reducedMotion || !gsap) return

    ctxRef.value = createContext(() => {
      gsap.defaults({ ease: 'power3.out' })

      const hero = root.value?.querySelector?.('[data-hero]')
      const reveals = root.value?.querySelectorAll?.('[data-reveal]') ?? []
      const revealItems = root.value?.querySelectorAll?.('[data-reveal-item]') ?? []

      if (hero) {
        gsap.fromTo(
          hero,
          { y: 18, opacity: 0 },
          { y: 0, opacity: 1, duration: 0.9, ease: 'power3.out' },
        )
      }

      if (revealItems.length) {
        gsap.fromTo(
          revealItems,
          { y: 14, opacity: 0, filter: 'blur(6px)' },
          {
            y: 0,
            opacity: 1,
            filter: 'blur(0px)',
            duration: 0.85,
            stagger: 0.06,
            delay: 0.05,
          },
        )
      }

      // Scroll reveals
      reveals.forEach((el) => {
        // Important: avoid hiding content before ScrollTrigger is ready.
        // If a page loads with the trigger already past the "start" line,
        // immediateRender can leave it stuck invisible.
        gsap.fromTo(
          el,
          { y: 20, opacity: 0, filter: 'blur(8px)' },
          {
            y: 0,
            opacity: 1,
            filter: 'blur(0px)',
            duration: 0.9,
            immediateRender: false,
            scrollTrigger: {
              trigger: el,
              start: 'top 92%',
              toggleActions: 'play none none reverse',
            },
          },
        )
      })

      // Subtle ambient motion for glows if present
      const glows = root.value?.querySelectorAll?.('[data-glow]') ?? []
      glows.forEach((g, idx) => {
        gsap.to(g, {
          y: idx % 2 ? -10 : 10,
          duration: 3.2,
          repeat: -1,
          yoyo: true,
          ease: 'sine.inOut',
        })
      })

      ScrollTrigger.refresh()
    }, root.value)
  })

  return { root }
}

