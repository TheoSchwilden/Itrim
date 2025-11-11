<script setup lang="ts">
const links = ref([
  {
    label: 'Voir les offres',
    to: '/offres',
    icon: 'i-lucide-briefcase-business'
  },
  {
    label: 'En savoir plus',
    to: '/a-propos',
    color: 'neutral',
    variant: 'subtle',
    trailingIcon: 'i-lucide-arrow-right'
  }
]);
</script>

<template>
  <div class="relative">
    <div class="absolute inset-0 top-[-300px] pointer-events-none flex items-start justify-center -z-10">
      <div
        class="absolute -top-20 sm:-top-40 left-1/2 w-full h-[850px] md:h-[1000px] rounded-full opacity-0 blur-3xl bg-linear-to-br from-green-400 to-blue-500 dark:from-green-600 dark:to-blue-700 animate-fade-in"
      ></div>
    </div>

    <UPageHero
      title="Trouvez votre prochaine mission IT dès aujourd'hui"
      description="Développeurs, chefs de projet, ingénieurs systèmes… ITrim vous connecte aux meilleures opportunités du numérique."
      :links="links"
    />
  </div>
</template>

<style scoped>
@keyframes fade-in {
  from {
    opacity: 0;
    transform: translate(-50%, 0) scale(0.8);
  }
  to {
    opacity: 0.3;
    transform: translate(-50%, 0) scale(1);
  }
}

.animate-fade-in {
  animation: fade-in 1.5s ease-out forwards;
}
</style>
