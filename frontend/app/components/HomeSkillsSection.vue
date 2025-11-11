<script setup lang="ts">
const cards = ref([
  {
    title: 'Développement Web & Mobile',
    description: 'React, Vue, Angular, iOS, Android',
    icon: 'i-lucide-laptop'
  },
  {
    title: 'Data & Intelligence Artificielle',
    description: 'Data Science, Machine Learning, Big Data',
    icon: 'i-lucide-brain-circuit'
  },
  {
    title: 'Systèmes & Réseaux',
    description: 'DevOps, Cloud, Cybersécurité',
    icon: 'i-lucide-server'
  },
  {
    title: 'Gestion de projet & Product',
    description: 'Scrum, Product Owner, Business Analyst',
    icon: 'i-lucide-clipboard-list'
  }
]);
</script>

<template>
  <UPageSection
    title="Nos domaines d’expertise"
    description="Des profils spécialisés pour chaque besoin de votre entreprise."
    :ui="{
      container: 'gap-8 lg:gap-8',
      title: 'text-left',
      description: 'text-left mt-3'
    }"
  >
    <UPageGrid class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
      <UPageCard v-for="(card, index) in cards" :key="index" v-bind="card" spotlight />
    </UPageGrid>
  </UPageSection>
</template>
