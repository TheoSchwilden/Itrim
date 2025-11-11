<script setup lang="ts">
// Définition du type pour une offre d'emploi
interface JobOffer {
  id: number;
  title: string;
  content: string;
  date: string;
  acf: {
    skills: Array<{ skill: string }>;
    contract_duration: string;
    remote: string;
    experience_required: string;
    education_level: string;
    company: {
      name: string;
      size: string;
      creation_date: string;
      logo_entreprise: {
        url: string;
        alt: string;
        width: number;
        height: number;
      };
    };
  };
}

// Déclaration du prop
const props = defineProps<{
  job: JobOffer;
}>();
</script>

<template>
  <UBlogPost
    :title="job.title"
    :image="job.acf.company.logo_entreprise.url"
    :date="job.date"
    :authors="authors"
    :ui="{
      image: 'object-contain object-center p-5'
    }"
  />
</template>
