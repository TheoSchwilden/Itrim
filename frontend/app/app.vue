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

const { data: jobs, pending } = await useFetch('http://localhost:8000/wp-json/itrim/v1/job-offers/', {
  key: 'jobs-cache',
  getCachedData: (key) => useNuxtData(key).data.value
});

const groups = computed(() => {
  if (!jobs.value) return [];

  return [
    {
      id: 'jobs',
      label: "Offres d'emploi",
      items: jobs.value.map((job) => ({
        label: job.title,
        suffix: job.taxonomies?.job_contract_type?.[0] ?? '',
        to: `/offres/${job.id}`
      }))
    }
  ];
});

const value = ref({});
</script>

<template>
  <UApp :locale="fr">
    <NuxtLoadingIndicator />
    <NuxtLayout />
    <UContentSearch v-model="value" :loading="pending" :links="pages" :groups="groups" />
  </UApp>
</template>
