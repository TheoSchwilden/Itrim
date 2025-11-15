<script setup lang="ts">
const links = ref([
  {
    label: 'Voir les offres maintenant',
    color: 'neutral'
  }
]);
</script>

<template>
  <UPageSection>
    <UPageCTA
      title="Prêt à trouver votre prochaine mission IT ?"
      description="We've built a strong, lasting partnership. Their trust is our driving force, propelling us towards shared success."
      variant="soft"
      :links="links"
    />
  </UPageSection>
</template>
