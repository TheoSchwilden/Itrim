<script setup lang="ts">
const { data: jobs, pending } = await useFetch('http://localhost:8000/wp-json/itrim/v1/job-offers', {
  key: 'jobs-cache',
  getCachedData: (key) => useNuxtData(key).data.value
});

console.log(jobs.value);
</script>

<template>
  <UContainer>
    <UCarousel
      v-if="!pending && jobs"
      :items="jobs"
      arrows
      :ui="{ item: 'flex-none w-full sm:w-1/2 lg:w-1/3', container: 'p-2 ' }"
    >
      <template #default="{ item }">
        <HomeBlogPost :job="item" />
      </template>
    </UCarousel>
    <div v-else-if="pending">Chargement des offres...</div>
  </UContainer>
</template>
