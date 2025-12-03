// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  app: {
    head: {
      title: "iTrim - Recherchez votre prochaine mission IT dès aujourd'hui",
      meta: [
        { name: 'description', content: "iTrim - Recherchez votre prochaine mission IT dès aujourd'hui" },
        { name: 'keywords', content: 'iTrim, recherche, mission, IT, développement, web, agence, freelance' },
        { name: 'author', content: 'Theo Schwilden' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1.0' },
        { name: 'robots', content: 'index, follow' },
        { name: 'googlebot', content: 'index, follow' },
        { name: 'bingbot', content: 'index, follow' }
      ]
    }
  },
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },

  modules: ['@nuxt/ui', '@nuxt/content'],

  css: ['~/assets/css/main.css'],

  ui: {
    viewTransitions: true,
    search: {
      provider: '~/utils/searchProvider'
    }
  }
});
