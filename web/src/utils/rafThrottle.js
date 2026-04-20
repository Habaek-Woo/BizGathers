export function rafThrottle(fn) {
  let raf = 0
  let lastArgs

  return function throttled(...args) {
    lastArgs = args
    if (raf) return
    raf = requestAnimationFrame(() => {
      raf = 0
      fn(...lastArgs)
    })
  }
}

