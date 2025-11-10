<script setup lang="ts">
import type { NavigationMenuItem } from '@nuxt/ui';

const route = useRoute();

const items: NavigationMenuItem[] = [
  {
    label: "Offres d'emploi",
    to: '/offres',
    active: route.path.startsWith('/')
  },
  {
    label: "Offres d'emploi",
    to: '/offres',
    active: route.path.startsWith('/offres')
  },
  {
    label: 'Contact',
    to: '/contact'
  }
];
</script>

<template>
  <UFooter>
    <template #left>
      <p class="text-muted text-sm">Copyright © {{ new Date().getFullYear() }}</p>
    </template>

    <UNavigationMenu :items="items" variant="link" />

    <template #right>
      <UButton
        icon="i-simple-icons-linkedin"
        color="neutral"
        variant="ghost"
        to="https://www.linkedin.com/in/th%C3%A9o-schwilden-686008267/"
        target="_blank"
        aria-label="X"
      />
      <UButton
        icon="i-simple-icons-github"
        color="neutral"
        variant="ghost"
        to="https://github.com/TheoSchwilden"
        target="_blank"
        aria-label="GitHub"
      />
    </template>
  </UFooter>
</template>
