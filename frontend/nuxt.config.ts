// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    runtimeConfig: {
      public: {
        apiBase: 'http://localhost:8888/api'
      }
    },
    devtools: {enabled: true},
    modules: ['@nuxtjs/tailwindcss'],
    ssr: false,
    app: {
        pageTransition: { name: 'page', mode: 'out-in' }
    },
})
