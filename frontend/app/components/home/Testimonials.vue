<script setup lang="ts">
import type { UserProps } from '@nuxt/ui';

const testimonials: { user: UserProps; quote: string }[] = [
  {
    user: {
      name: 'Laura Mendes',
      description: 'Responsable RH chez Novacode',
      avatar: {
        src: 'https://randomuser.me/api/portraits/women/45.jpg',
        loading: 'lazy'
      }
    },
    quote:
      'Avec Itrim, on a enfin une plateforme où publier une offre ne prend que quelques minutes. On reçoit des candidatures vraiment qualifiées et beaucoup mieux ciblées que sur les jobboards classiques.'
  },
  {
    user: {
      name: 'Julien Caron',
      description: 'Développeur Full-Stack',
      avatar: {
        src: 'https://randomuser.me/api/portraits/men/33.jpg',
        loading: 'lazy'
      }
    },
    quote:
      'J’ai trouvé mon poste actuel en moins de deux semaines grâce à Itrim. La présentation des entreprises est claire, les infos sont fiables, et la candidature en un clic m’a fait gagner un temps fou.'
  },
  {
    user: {
      name: 'Élodie Perrot',
      description: 'Chargée de recrutement',
      avatar: {
        src: 'https://randomuser.me/api/portraits/women/67.jpg',
        loading: 'lazy'
      }
    },
    quote:
      'Ce que j’aime sur Itrim, c’est la qualité des profils. Le système de mise en avant automatique selon les compétences fonctionne super bien. On a réduit notre temps de recrutement de 30%.'
  },
  {
    user: {
      name: 'Thomas Béranger',
      description: 'UX/UI Designer',
      avatar: {
        src: 'https://randomuser.me/api/portraits/men/52.jpg',
        loading: 'lazy'
      }
    },
    quote:
      'Itrim met vraiment en valeur les candidats. Le profil est propre, personnalisé, et les recommandations automatiques d’offres m’ont permis de viser exactement les bons postes.'
  },
  {
    user: {
      name: 'Mélina Dubreuil',
      description: 'Fondatrice d’une startup SaaS',
      avatar: {
        src: 'https://randomuser.me/api/portraits/women/14.jpg',
        loading: 'lazy'
      }
    },
    quote:
      'Pour une jeune startup comme la nôtre, Itrim a été un outil clé : on a trouvé nos premiers développeurs via la plateforme. L’expérience est simple, moderne et vraiment pensée pour les petites structures.'
  }
];
</script>

<template>
  <div class="flex flex-col gap-4 w-full">
    <UMarquee pause-on-hover :overlay="true" :ui="{ root: '[--gap:--spacing(4)]', content: 'w-auto py-1' }">
      <UPageCard
        v-for="(testimonial, index) in testimonials"
        :key="index"
        variant="subtle"
        :description="testimonial.quote"
        :ui="{
          description: 'before:content-[open-quote] after:content-[close-quote] line-clamp-5'
        }"
        class="w-124 h-64 shrink-0"
      >
        <template #footer>
          <UUser v-bind="testimonial.user" size="xl" :ui="{ description: 'line-clamp-1' }" />
        </template>
      </UPageCard>
    </UMarquee>
    <UMarquee pause-on-hover reverse :overlay="true" :ui="{ root: '[--gap:--spacing(4)]', content: 'w-auto py-1' }">
      <UPageCard
        v-for="(testimonial, index) in testimonials"
        :key="index"
        variant="subtle"
        :description="testimonial.quote"
        :ui="{
          description: 'before:content-[open-quote] after:content-[close-quote] line-clamp-5'
        }"
        class="w-124 h-64 shrink-0"
      >
        <template #footer>
          <UUser v-bind="testimonial.user" size="xl" :ui="{ description: 'line-clamp-1' }" />
        </template>
      </UPageCard>
    </UMarquee>
  </div>
</template>
