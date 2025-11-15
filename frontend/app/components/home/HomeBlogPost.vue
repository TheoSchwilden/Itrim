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
    salary: number;
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
  taxonomies: {
    job_category?: string[];
    job_location?: string[];
    job_contract_type?: string[];
    job_skill?: string[];
  };
}

// Déclaration du prop
const props = defineProps<{
  job: JobOffer;
}>();
</script>

<template>
  <UBlogPost
    :image="job.acf.company.logo_entreprise.url"
    :date="job.date"
    :ui="{
      image: 'object-contain object-center p-5 bg-accented dark:bg-white'
    }"
  >
    <template #date>
      <UBadge :label="job.taxonomies.job_contract_type[0]" />
    </template>
    <template #title>
      <h3>{{ job.title }}</h3>
    </template>
    <template #description>
      <div class="flex flex-col gap-1.5 mt-2">
        <div class="flex items-center gap-1 mt-2">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="lucide lucide-map-pin-icon lucide-map-pin"
          >
            <path
              d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"
            />
            <circle cx="12" cy="10" r="3" />
          </svg>
          <span>{{ job.taxonomies.job_location[0] }}</span>
        </div>
        <span class="flex items-center gap-1 mt-2"
          ><svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="lucide lucide-hand-coins-icon lucide-hand-coins"
          >
            <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17" />
            <path d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
            <path d="m2 16 6 6" />
            <circle cx="16" cy="9" r="2.9" />
            <circle cx="6" cy="5" r="3" />
          </svg>
          {{ new Intl.NumberFormat('fr-FR').format(job.acf.salary) }} € par an
        </span>
      </div>
    </template>
    <template #footer>
      <div class="flex items-center justify-between p-4 sm:p-5">
        <div class="flex items-center gap-1">
          <UAvatar :alt="job.acf.company.name.charAt(0)" />
          <h4>{{ job.acf.company.name }}</h4>
        </div>
        <div>Publié le {{ job.date }}</div>
      </div>
    </template>
  </UBlogPost>
</template>
