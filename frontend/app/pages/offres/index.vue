<script setup lang="ts">
interface JobOffer {
  id: number;
  title: string;
  content: string;
  date: string;
  acf: any;
  taxonomies: {
    job_category?: string[];
    job_location?: string[];
    job_contract_type?: string[];
    job_skill?: string[];
  };
}

const { data: jobs, pending } = await useFetch<JobOffer[]>('http://localhost:8000/wp-json/itrim/v1/job-offers', {
  key: 'jobs-cache',
  getCachedData: (key) => useNuxtData(key).data.value
});

const selectedCategories = ref<string[]>([]);
const selectedLocations = ref<string[]>([]);
const selectedContractTypes = ref<string[]>([]);
const selectedSkills = ref<string[]>([]);
const isSlideoverOpen = ref(false);

const taxonomyCounts = computed(() => {
  if (!jobs.value) return { categories: [], locations: [], contractTypes: [], skills: [] };

  const counts = {
    categories: new Map<string, number>(),
    locations: new Map<string, number>(),
    contractTypes: new Map<string, number>(),
    skills: new Map<string, number>()
  };

  jobs.value.forEach((job) => {
    job.taxonomies.job_category?.forEach((cat) => {
      counts.categories.set(cat, (counts.categories.get(cat) || 0) + 1);
    });

    job.taxonomies.job_location?.forEach((loc) => {
      counts.locations.set(loc, (counts.locations.get(loc) || 0) + 1);
    });

    job.taxonomies.job_contract_type?.forEach((type) => {
      counts.contractTypes.set(type, (counts.contractTypes.get(type) || 0) + 1);
    });

    job.taxonomies.job_skill?.forEach((skill) => {
      counts.skills.set(skill, (counts.skills.get(skill) || 0) + 1);
    });
  });

  return {
    categories: Array.from(counts.categories.entries()).map(([name, count]) => ({ name, count })),
    locations: Array.from(counts.locations.entries()).map(([name, count]) => ({ name, count })),
    contractTypes: Array.from(counts.contractTypes.entries()).map(([name, count]) => ({ name, count })),
    skills: Array.from(counts.skills.entries()).map(([name, count]) => ({ name, count }))
  };
});

const filteredJobs = computed(() => {
  if (!jobs.value) return [];

  return jobs.value.filter((job) => {
    if (selectedCategories.value.length > 0) {
      const hasCategory = job.taxonomies.job_category?.some((cat) => selectedCategories.value.includes(cat));
      if (!hasCategory) return false;
    }

    if (selectedLocations.value.length > 0) {
      const hasLocation = job.taxonomies.job_location?.some((loc) => selectedLocations.value.includes(loc));
      if (!hasLocation) return false;
    }

    if (selectedContractTypes.value.length > 0) {
      const hasContractType = job.taxonomies.job_contract_type?.some((type) =>
        selectedContractTypes.value.includes(type)
      );
      if (!hasContractType) return false;
    }

    if (selectedSkills.value.length > 0) {
      const hasSkill = job.taxonomies.job_skill?.some((skill) => selectedSkills.value.includes(skill));
      if (!hasSkill) return false;
    }

    return true;
  });
});

const toggleCategory = (value: string) => {
  const index = selectedCategories.value.indexOf(value);
  if (index > -1) {
    selectedCategories.value.splice(index, 1);
  } else {
    selectedCategories.value.push(value);
  }
};

const toggleLocation = (value: string) => {
  const index = selectedLocations.value.indexOf(value);
  if (index > -1) {
    selectedLocations.value.splice(index, 1);
  } else {
    selectedLocations.value.push(value);
  }
};

const toggleContractType = (value: string) => {
  const index = selectedContractTypes.value.indexOf(value);
  if (index > -1) {
    selectedContractTypes.value.splice(index, 1);
  } else {
    selectedContractTypes.value.push(value);
  }
};

const toggleSkill = (value: string) => {
  const index = selectedSkills.value.indexOf(value);
  if (index > -1) {
    selectedSkills.value.splice(index, 1);
  } else {
    selectedSkills.value.push(value);
  }
};

const resetFilters = () => {
  selectedCategories.value = [];
  selectedLocations.value = [];
  selectedContractTypes.value = [];
  selectedSkills.value = [];
};

const hasActiveFilters = computed(() => {
  return (
    selectedCategories.value.length > 0 ||
    selectedLocations.value.length > 0 ||
    selectedContractTypes.value.length > 0 ||
    selectedSkills.value.length > 0
  );
});

const isListView = ref(false);
const toggleView = () => {
  isListView.value = !isListView.value;
};
</script>

<template>
  <UPageHero
    title="Offres d'emploi"
    description="Trouvez votre prochaine mission IT dès aujourd'hui"
    :ui="{
      container: 'lg:pt-20 lg:pb-0'
    }"
  />

  <UContainer class="py-12">
    <div class="lg:hidden mb-6 flex items-center justify-between">
      <p class="text-sm text-gray-600 dark:text-gray-400">
        <span class="font-semibold text-lg text-gray-900 dark:text-white">{{ filteredJobs.length }}</span>
        {{ filteredJobs.length > 1 ? 'offres trouvées' : 'offre trouvée' }}
      </p>

      <USlideover v-model:open="isSlideoverOpen">
        <UButton
          icon="i-heroicons-adjustments-horizontal"
          label="Filtres"
          color="primary"
          variant="outline"
          @click="isSlideoverOpen = true"
        >
          <template #trailing>
            <UBadge v-if="hasActiveFilters" color="primary" variant="solid" size="xs" class="ml-2">
              {{
                selectedCategories.length +
                selectedLocations.length +
                selectedContractTypes.length +
                selectedSkills.length
              }}
            </UBadge>
          </template>
        </UButton>

        <template #content>
          <div class="flex flex-col h-full">
            <!-- En-tête avec titre et bouton reset -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-800">
              <h2 class="text-lg font-bold text-gray-900 dark:text-white">Filtres</h2>
              <UButton
                v-if="hasActiveFilters"
                color="gray"
                variant="ghost"
                icon="i-heroicons-x-mark"
                size="xs"
                @click="resetFilters"
              >
                Réinitialiser
              </UButton>
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-6">
              <div class="space-y-3">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide">
                  Catégories
                </h3>
                <div class="flex flex-wrap gap-2">
                  <UBadge
                    v-for="category in taxonomyCounts.categories"
                    :key="category.name"
                    :label="`${category.name} (${category.count})`"
                    :color="selectedCategories.includes(category.name) ? 'primary' : 'gray'"
                    :variant="selectedCategories.includes(category.name) ? 'solid' : 'soft'"
                    size="lg"
                    class="cursor-pointer hover:scale-105 transition-transform"
                    @click="toggleCategory(category.name)"
                  />
                  <UBadge
                    v-if="taxonomyCounts.categories.length === 0"
                    label="Aucune catégorie disponible"
                    color="gray"
                    variant="soft"
                  />
                </div>
              </div>

              <div class="space-y-3">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide">
                  Localisation
                </h3>
                <div class="flex flex-wrap gap-2">
                  <UBadge
                    v-for="location in taxonomyCounts.locations"
                    :key="location.name"
                    :label="`${location.name} (${location.count})`"
                    :color="selectedLocations.includes(location.name) ? 'primary' : 'gray'"
                    :variant="selectedLocations.includes(location.name) ? 'solid' : 'soft'"
                    size="lg"
                    class="cursor-pointer hover:scale-105 transition-transform"
                    @click="toggleLocation(location.name)"
                  />
                  <UBadge
                    v-if="taxonomyCounts.locations.length === 0"
                    label="Aucune localisation disponible"
                    color="gray"
                    variant="soft"
                  />
                </div>
              </div>

              <div class="space-y-3">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide">
                  Type de contrat
                </h3>
                <div class="flex flex-wrap gap-2">
                  <UBadge
                    v-for="contractType in taxonomyCounts.contractTypes"
                    :key="contractType.name"
                    :label="`${contractType.name} (${contractType.count})`"
                    :color="selectedContractTypes.includes(contractType.name) ? 'primary' : 'gray'"
                    :variant="selectedContractTypes.includes(contractType.name) ? 'solid' : 'soft'"
                    size="lg"
                    class="cursor-pointer hover:scale-105 transition-transform"
                    @click="toggleContractType(contractType.name)"
                  />
                  <UBadge
                    v-if="taxonomyCounts.contractTypes.length === 0"
                    label="Aucun type de contrat disponible"
                    color="gray"
                    variant="soft"
                  />
                </div>
              </div>

              <div class="space-y-3">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide">
                  Compétences
                </h3>
                <div class="flex flex-wrap gap-2">
                  <UBadge
                    v-for="skill in taxonomyCounts.skills"
                    :key="skill.name"
                    :label="`${skill.name} (${skill.count})`"
                    :color="selectedSkills.includes(skill.name) ? 'primary' : 'gray'"
                    :variant="selectedSkills.includes(skill.name) ? 'solid' : 'soft'"
                    size="lg"
                    class="cursor-pointer hover:scale-105 transition-transform"
                    @click="toggleSkill(skill.name)"
                  />
                  <UBadge
                    v-if="taxonomyCounts.skills.length === 0"
                    label="Aucune compétence disponible"
                    color="gray"
                    variant="soft"
                  />
                </div>
              </div>
            </div>

            <div class="p-6 border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
              <UButton block size="xl" color="primary" @click="isSlideoverOpen = false">
                Voir {{ filteredJobs.length }} {{ filteredJobs.length > 1 ? 'résultats' : 'résultat' }}
              </UButton>
            </div>
          </div>
        </template>
      </USlideover>
    </div>

    <div class="flex gap-8">
      <aside class="hidden lg:block w-80 shrink-0">
        <div class="sticky top-6 space-y-6">
          <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Filtres</h2>
            <UButton
              v-if="hasActiveFilters"
              color="gray"
              variant="ghost"
              icon="i-heroicons-x-mark"
              size="xs"
              @click="resetFilters"
            >
              Réinitialiser
            </UButton>
          </div>

          <div class="space-y-3">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Catégories</h3>
            <div class="flex flex-wrap gap-2">
              <UBadge
                v-for="category in taxonomyCounts.categories"
                :key="category.name"
                :label="`${category.name} (${category.count})`"
                :color="selectedCategories.includes(category.name) ? 'primary' : 'gray'"
                :variant="selectedCategories.includes(category.name) ? 'solid' : 'soft'"
                size="lg"
                class="cursor-pointer hover:scale-105 transition-transform"
                @click="toggleCategory(category.name)"
              />
              <UBadge
                v-if="taxonomyCounts.categories.length === 0"
                label="Aucune catégorie disponible"
                color="gray"
                variant="soft"
              />
            </div>
          </div>

          <div class="space-y-3">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Localisation</h3>
            <div class="flex flex-wrap gap-2">
              <UBadge
                v-for="location in taxonomyCounts.locations"
                :key="location.name"
                :label="`${location.name} (${location.count})`"
                :color="selectedLocations.includes(location.name) ? 'primary' : 'gray'"
                :variant="selectedLocations.includes(location.name) ? 'solid' : 'soft'"
                size="lg"
                class="cursor-pointer hover:scale-105 transition-transform"
                @click="toggleLocation(location.name)"
              />
              <UBadge
                v-if="taxonomyCounts.locations.length === 0"
                label="Aucune localisation disponible"
                color="gray"
                variant="soft"
              />
            </div>
          </div>

          <div class="space-y-3">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide">
              Type de contrat
            </h3>
            <div class="flex flex-wrap gap-2">
              <UBadge
                v-for="contractType in taxonomyCounts.contractTypes"
                :key="contractType.name"
                :label="`${contractType.name} (${contractType.count})`"
                :color="selectedContractTypes.includes(contractType.name) ? 'primary' : 'gray'"
                :variant="selectedContractTypes.includes(contractType.name) ? 'solid' : 'soft'"
                size="lg"
                class="cursor-pointer hover:scale-105 transition-transform"
                @click="toggleContractType(contractType.name)"
              />
              <UBadge
                v-if="taxonomyCounts.contractTypes.length === 0"
                label="Aucun type de contrat disponible"
                color="gray"
                variant="soft"
              />
            </div>
          </div>

          <div class="space-y-3">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Compétences</h3>
            <div class="flex flex-wrap gap-2">
              <UBadge
                v-for="skill in taxonomyCounts.skills"
                :key="skill.name"
                :label="`${skill.name} (${skill.count})`"
                :color="selectedSkills.includes(skill.name) ? 'primary' : 'gray'"
                :variant="selectedSkills.includes(skill.name) ? 'solid' : 'soft'"
                size="lg"
                class="cursor-pointer hover:scale-105 transition-transform"
                @click="toggleSkill(skill.name)"
              />
              <UBadge
                v-if="taxonomyCounts.skills.length === 0"
                label="Aucune compétence disponible"
                color="gray"
                variant="soft"
              />
            </div>
          </div>
        </div>
      </aside>

      <div class="flex-1 min-w-0">
        <div class="hidden lg:block pb-4 dark:border-gray-800">
          <p class="text-sm text-right text-gray-600 dark:text-gray-400">
            <span class="font-semibold text-lg text-gray-900 dark:text-white">{{ filteredJobs.length }}</span>
            {{ filteredJobs.length > 1 ? 'offres trouvées' : 'offre trouvée' }}
          </p>
          <div class="flex items-center justify-end gap-2 mt-2">
            <UButton
              :icon="isListView ? 'i-lucide-list' : 'i-lucide-grid'"
              color="neutral"
              variant="outline"
              @click="toggleView"
              :aria-label="isListView ? 'Grille' : 'Liste'"
            />
          </div>
        </div>

        <div v-if="pending" class="grid grid-cols-1 sm:grid-cols-2 gap-8">
          <USkeleton class="h-64" v-for="i in 6" :key="i" />
        </div>

        <div
          v-else-if="filteredJobs.length > 0"
          class="grid grid-cols-1 sm:grid-cols-2 gap-8"
          :class="isListView ? 'lg:grid-cols-2' : 'lg:grid-cols-1'"
        >
          <HomeBlogPost
            :orientation="isListView ? 'vertical' : 'horizontal'"
            v-for="job in filteredJobs"
            :key="job.id"
            :job="job"
          />
        </div>

        <div v-else class="text-center py-12">
          <div class="text-gray-400 mb-4">
            <svg class="w-20 h-20 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
              />
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Aucune offre trouvée</h3>
          <p class="text-gray-500 dark:text-gray-400 mb-4">Aucune offre ne correspond aux filtres sélectionnés</p>
          <UButton @click="resetFilters" v-if="hasActiveFilters"> Voir toutes les offres </UButton>
        </div>
      </div>
    </div>
  </UContainer>
</template>
