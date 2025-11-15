<script setup lang="ts">
const route = useRoute();
const id = route.params.id;
console.log(route.params);
</script>

<template>
  <UContainer>
    <div class="py-12">
      <h1 class="text-4xl font-bold mb-4">Offre {{ id }}</h1>
      <p class="text-gray-600 mb-8">Vous consultez l'offre numéro {{ id }}</p>

      <UButton to="/offres" icon="i-heroicons-arrow-left" color="neutral"> Retour aux offres </UButton>
    </div>
  </UContainer>
</template>
