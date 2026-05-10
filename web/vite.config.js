import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import tailwindcss from '@tailwindcss/vite'

// https://vite.dev/config/
export default defineConfig({
  // GitHub Pages serves this project under /BizGathers/
  base: process.env.GITHUB_PAGES ? '/BizGathers/' : '/',
  plugins: [vue(), tailwindcss()],
})
