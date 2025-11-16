<script setup lang="ts">
import { fr } from '@nuxt/ui/locale';

const pages = [
  {
    id: 'home',
    label: 'Accueil',
    to: '/',
    icon: 'i-lucide-home'
  },
  {
    id: 'offres',
    label: "Offres d'emploi",
    to: '/offres',
    icon: 'i-lucide-briefcase-business'
  },
  {
    id: 'about',
    label: 'À propos',
    to: '/a-propos',
    icon: 'i-lucide-circle-question-mark'
  },
  {
    id: 'contact',
    label: 'Contact',
    to: '/contact',
    icon: 'i-lucide-phone'
  }
];
</script>

<template>
  <UApp :locale="fr">
    <NuxtLoadingIndicator />
    <NuxtLayout />
    <UContentSearch :loading="pending" :links="pages" />
  </UApp>
</template>
