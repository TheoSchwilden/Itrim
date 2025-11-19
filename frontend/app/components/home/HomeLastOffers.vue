<script setup lang="ts"></script>

<template>
  <UPageSection
    title="Les dernières opportunités IT"
    description="Des profils spécialisés pour chaque besoin de votre entreprise."
    :ui="{
      container: 'gap-8 pb-20 lg:gap-8 lg:pb-8',
      title: 'text-center',
      description: 'text-center mt-3'
    }"
  >
  </UPageSection>
  <ClientOnly>
    <HomeCarouselOffers />
  </ClientOnly>
</template>
