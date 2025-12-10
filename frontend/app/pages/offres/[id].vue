<script setup lang="ts">
const title = "Offre d'emploi";
const description = "Découvrez l'offre d'emploi";
useHead({
  title,
  meta: [{ name: 'description', content: description }]
});
interface JobOffer {
  id: number;
  title: string;
  content: string;
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
      };
    };
    salary: string;
  };
  taxonomies: {
    job_category?: string[];
    job_location?: string[];
    job_contract_type?: string[];
    job_skill?: string[];
  };
}

const route = useRoute();
const id = route.params.id;
const config = useRuntimeConfig();

const { data: job, pending } = await useFetch<JobOffer>(`${config.public.apiUrl}/itrim/v1/job-offer/${id}`, {
  key: `job-${id}`,
  getCachedData: (key) => useNuxtData(key).data.value
});

const formatSalary = (salary: string) => {
  return new Intl.NumberFormat('fr-FR', {
    style: 'currency',
    currency: 'EUR',
    maximumFractionDigits: 0
  }).format(Number(salary));
};

const formatDate = (date: string) => {
  return new Date(date).toLocaleDateString('fr-FR', {
    year: 'numeric',
    month: 'long'
  });
};
</script>

<template>
  <UContainer class="py-12">
    <div v-if="pending" class="space-y-6">
      <USkeleton class="h-12 w-3/4" />
      <USkeleton class="h-64" />
    </div>

    <div v-else-if="job" class="space-y-8">
      <UButton to="/offres" icon="lucide:arrow-left" color="gray" variant="ghost" size="sm">
        Retour aux offres
      </UButton>

      <div class="flex items-start gap-6">
        <div
          v-if="job.acf.company.logo_entreprise"
          class="w-24 h-24 rounded-xl border border-gray-200 dark:border-gray-800 flex items-center justify-center bg-white p-4"
        >
          <img
            :src="job.acf.company.logo_entreprise.url"
            :alt="job.acf.company.logo_entreprise.alt || job.acf.company.name"
            class="w-full h-full object-contain"
          />
        </div>
        <div class="flex-1">
          <UBadge
            v-for="category in job.taxonomies.job_category"
            :key="category"
            :label="category"
            color="primary"
            variant="soft"
            size="md"
          />
          <h1 class="text-2xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2 mt-2">
            {{ job.title }}
          </h1>
          <p class="text-lg text-gray-600 dark:text-gray-400">{{ job.acf.company.name }}</p>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
          <UCard>
            <template #header>
              <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Description du poste</h2>
            </template>
            <div class="prose dark:prose-invert max-w-none" v-html="job.content"></div>
          </UCard>

          <UCard v-if="job.acf.skills && job.acf.skills.length > 0">
            <template #header>
              <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Compétences requises</h2>
            </template>
            <div class="flex flex-wrap gap-2">
              <UBadge
                v-for="skill in job.taxonomies.job_skill"
                :key="skill"
                :label="skill"
                color="primary"
                variant="soft"
                size="md"
              />
            </div>
          </UCard>

          <UCard>
            <template #header>
              <h2 class="text-xl font-semibold text-gray-900 dark:text-white">À propos de l'entreprise</h2>
            </template>
            <div class="space-y-4">
              <div class="flex items-center gap-3">
                <UIcon name="lucide:building-2" class="text-gray-400 text-xl" />
                <div>
                  <p class="text-sm text-gray-500 dark:text-gray-400">Nom de l'entreprise</p>
                  <p class="font-medium text-gray-900 dark:text-white">{{ job.acf.company.name }}</p>
                </div>
              </div>
              <div class="flex items-center gap-3">
                <UIcon name="lucide:users" class="text-gray-400 text-xl" />
                <div>
                  <p class="text-sm text-gray-500 dark:text-gray-400">Taille de l'entreprise</p>
                  <p class="font-medium text-gray-900 dark:text-white">{{ job.acf.company.size }} employés</p>
                </div>
              </div>
              <div class="flex items-center gap-3">
                <UIcon name="lucide:calendar" class="text-gray-400 text-xl" />
                <div>
                  <p class="text-sm text-gray-500 dark:text-gray-400">Date de création</p>
                  <p class="font-medium text-gray-900 dark:text-white">
                    {{ formatDate(job.acf.company.creation_date) }}
                  </p>
                </div>
              </div>
            </div>
          </UCard>
        </div>

        <div class="space-y-6">
          <UCard>
            <template #header>
              <h3 class="font-semibold text-gray-900 dark:text-white">Informations clés</h3>
            </template>
            <div class="space-y-4">
              <div class="flex items-start gap-3">
                <UIcon name="lucide:receipt-text" class="text-primary-500 text-xl mt-0.5" />
                <div class="flex-1">
                  <p class="text-sm text-gray-500 dark:text-gray-400">Type de contrat</p>
                  <p class="font-semibold text-gray-900 dark:text-white">
                    {{ job.taxonomies.job_contract_type.join(', ') }}
                  </p>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <UIcon name="lucide:euro" class="text-primary-500 text-xl mt-0.5" />
                <div class="flex-1">
                  <p class="text-sm text-gray-500 dark:text-gray-400">Salaire annuel</p>
                  <p class="font-semibold text-gray-900 dark:text-white">{{ formatSalary(job.acf.salary) }}</p>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <UIcon name="lucide:clock" class="text-primary-500 text-xl mt-0.5" />
                <div class="flex-1">
                  <p class="text-sm text-gray-500 dark:text-gray-400">Durée du contrat</p>
                  <p class="font-semibold text-gray-900 dark:text-white">{{ job.acf.contract_duration }}</p>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <UIcon name="lucide:home" class="text-primary-500 text-xl mt-0.5" />
                <div class="flex-1">
                  <p class="text-sm text-gray-500 dark:text-gray-400">Télétravail</p>
                  <p class="font-semibold text-gray-900 dark:text-white">{{ job.acf.remote }}</p>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <UIcon name="lucide:briefcase" class="text-primary-500 text-xl mt-0.5" />
                <div class="flex-1">
                  <p class="text-sm text-gray-500 dark:text-gray-400">Expérience requise</p>
                  <p class="font-semibold text-gray-900 dark:text-white">{{ job.acf.experience_required }}</p>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <UIcon name="lucide:graduation-cap" class="text-primary-500 text-xl mt-0.5" />
                <div class="flex-1">
                  <p class="text-sm text-gray-500 dark:text-gray-400">Niveau d'études</p>
                  <p class="font-semibold text-gray-900 dark:text-white">{{ job.acf.education_level }}</p>
                </div>
              </div>

              <div class="flex items-start gap-3">
                <UIcon name="lucide:map-pin" class="text-primary-500 text-xl mt-0.5" />
                <div class="flex-1">
                  <p class="text-sm text-gray-500 dark:text-gray-400">Localisation</p>
                  <p class="font-semibold text-gray-900 dark:text-white">
                    {{ job.taxonomies.job_location.join(', ') }}
                  </p>
                </div>
              </div>
            </div>
          </UCard>

          <ModalOffers :job-id="job.id" />
        </div>
      </div>
    </div>

    <div v-else class="text-center py-12">
      <p class="text-gray-500 dark:text-gray-400">Offre non trouvée</p>
    </div>
  </UContainer>
</template>
