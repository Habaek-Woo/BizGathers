import { onBeforeUnmount } from 'vue'
import { prefersReducedMotion } from '../utils/motion'

/**
 * Lazy-load GSAP (keeps initial bundle lighter).
 * Returns helpers for timeline creation and cleanup.
 */
export async function useGsap() {
  if (prefersReducedMotion()) {
    return {
      gsap: null,
      ScrollTrigger: null,
      createContext: () => ({ revert() {} }),
      reducedMotion: true,
    }
  }

  const { gsap } = await import('gsap')
  const { ScrollTrigger } = await import('gsap/ScrollTrigger')
  gsap.registerPlugin(ScrollTrigger)

  return {
    gsap,
    ScrollTrigger,
    createContext: (fn, scope) => gsap.context(fn, scope),
    reducedMotion: false,
  }
}

export function useGsapCleanup(ctxRef) {
  onBeforeUnmount(() => {
    try {
      ctxRef.value?.revert?.()
    } catch {}
  })
}

