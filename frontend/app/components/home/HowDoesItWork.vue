<script setup lang="ts">
const steps = [
  {
    title: 'Recherchez une offre',
    description:
      'Utilisez notre moteur de recherche ou explorez les offres par domaine, localisation ou type de contrat.',
    icon: 'i-lucide-search'
  },
  {
    title: 'Consultez les détails',
    description: 'Accédez aux informations complètes : missions, compétences requises, entreprise, avantages.',
    icon: 'i-lucide-file-text'
  },
  {
    title: 'Postulez en ligne',
    description: 'Envoyez votre candidature en quelques clics : CV, infos de contact et message.',
    icon: 'i-lucide-send'
  },
  {
    title: 'Soyez recontacté',
    description: 'Nos recruteurs vous contactent rapidement pour un premier échange.',
    icon: 'i-lucide-message-circle'
  }
];

const links = ref([
  {
    label: 'Voir les offres',
    to: '/offres',
    icon: 'i-lucide-briefcase-business'
  },
  {
    label: 'Nous contacter',
    to: '/contact',
    color: 'neutral',
    variant: 'subtle',
    trailingIcon: 'i-lucide-arrow-right'
  }
]);

const active = ref(0);

onMounted(() => {
  setInterval(() => {
    active.value = (active.value + 1) % steps.length;
  }, 1500);
});
</script>

<template>
  <UPageSection
    title="Comment ça marche ?"
    description="Un processus simple, rapide et moderne pour vous aider à trouver la mission idéale dans l’IT."
    orientation="horizontal"
    reverse
    :links="links"
    :ui="{
      container: 'lg:px-0',
      links: 'lg:mt-12'
    }"
  >
    <template #features>
      <UStepper v-model="active" orientation="vertical" :items="steps" />
    </template>

    <img
      src="http://localhost:8000/wp-content/uploads/2025/11/image-1.png"
      alt="Illustration"
      class="w-full rounded max-h-[700px]"
    />
  </UPageSection>
</template>
