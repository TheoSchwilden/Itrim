<script setup lang="ts">
const technologies = [
  {
    name: 'WordPress',
    icon: 'i-simple-icons-wordpress',
    color: 'blue',
    description: 'CMS Headless en mode API REST'
  },
  {
    name: 'Vue.js 3',
    icon: 'i-simple-icons-vuedotjs',
    color: 'green',
    description: 'Framework JavaScript progressif'
  },
  {
    name: 'Nuxt 3',
    icon: 'i-simple-icons-nuxtdotjs',
    color: 'emerald',
    description: 'Framework Vue pour le SSR'
  },
  {
    name: 'TypeScript',
    icon: 'i-simple-icons-typescript',
    color: 'blue',
    description: 'JavaScript typé pour plus de robustesse'
  },
  {
    name: 'Nuxt UI',
    icon: 'i-simple-icons-nuxtdotjs',
    color: 'green',
    description: 'Bibliothèque de composants moderne'
  },
  {
    name: 'Tailwind CSS',
    icon: 'i-simple-icons-tailwindcss',
    color: 'cyan',
    description: 'Framework CSS utility-first'
  }
];
const features = [
  {
    icon: 'i-lucide-rocket',
    title: 'Architecture moderne',
    description: 'Découplage complet entre le backend WordPress et le frontend Vue/Nuxt pour une flexibilité maximale'
  },
  {
    icon: 'i-lucide-zap',
    title: 'Performance optimale',
    description: 'SSR avec Nuxt 3 pour un temps de chargement ultra-rapide et un excellent SEO'
  },
  {
    icon: 'i-lucide-shield-check',
    title: 'API REST sécurisée',
    description: 'Endpoints personnalisés WordPress pour une communication frontend-backend optimisée'
  },
  {
    icon: 'i-lucide-smartphone',
    title: 'Responsive design',
    description: 'Interface adaptative sur tous les appareils grâce à Tailwind CSS et Nuxt UI'
  },
  {
    icon: 'i-lucide-code-2',
    title: 'Code maintenable',
    description: 'TypeScript pour la sécurité des types et une meilleure expérience développeur'
  },
  {
    icon: 'i-lucide-sparkles',
    title: 'UX moderne',
    description: 'Composants UI élégants et interactions fluides pour une expérience utilisateur premium'
  }
];

const timeline = [
  {
    period: '2016 - 2017',
    title: 'DAEU A',
    organization: 'Paul Valéry',
    description: "Diplôme d'accès aux études universitaires"
  },
  {
    period: '2017 - 2019',
    title: 'BTS NDRC',
    organization: 'Alternance Languedoc',
    description: 'Négociation et relation client'
  },
  {
    period: '2022 - 2023',
    title: 'Formation Développeur Web & Web Mobile',
    organization: "O'clock",
    description: 'Formation intensive au développement web moderne'
  },
  {
    period: 'Oct 2023 - Présent',
    title: 'Développeur Full-stack',
    organization: 'Logia',
    description: 'Développement de plus de cinquante projets web sur mesure avec WordPress, Laravel, React, Vue.js'
  }
];

const technicalSkills = [
  {
    category: 'Développement Web',
    icon: 'i-lucide-code',
    color: 'primary',
    items: ['WordPress', 'PHP/JS', 'Laravel', 'React', 'Vue/Nuxt']
  },
  {
    category: 'Outils & Méthodes',
    icon: 'i-lucide-wrench',
    color: 'secondary',
    items: ['Git', 'Docker', 'MySQL']
  },

  {
    category: 'Hébergement & Sécurité',
    icon: 'i-lucide-server',
    color: 'warning',
    items: ['Linux', 'Nginx', 'SSL', 'Cloudflare']
  }
];

const softSkills = [
  {
    name: "Travail d'équipe",
    icon: 'i-lucide-users',
    color: 'primary'
  },
  {
    name: 'Communication',
    icon: 'i-lucide-message-circle',
    color: 'primary'
  },
  {
    name: "Ouverture d'esprit",
    icon: 'i-lucide-lightbulb',
    color: 'primary'
  }
];

const interests = [
  {
    name: 'Jeux vidéos compétitifs',
    icon: 'i-lucide-gamepad-2'
  },
  {
    name: 'Musique',
    icon: 'i-lucide-music'
  },
  {
    name: 'Voyage',
    icon: 'i-lucide-plane'
  },
  {
    name: 'Informatique',
    icon: 'i-lucide-laptop'
  }
];
</script>

<template>
  <div>
    <!-- Hero Section -->
    <UPageHero
      title="À propos d'iTrim"
      description="Un projet portfolio démontrant la puissance du WordPress Headless moderne"
      :ui="{
        container: 'lg:pt-24 lg:pb-16'
      }"
    />

    <UContainer class="py-16 space-y-32">
      <!-- Section Introduction -->
      <section class="py-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <div class="space-y-6">
            <div>
              <UBadge color="primary" variant="subtle" size="lg" class="mb-4"> Projet Portfolio </UBadge>
              <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                WordPress réinventé pour l'ère moderne
              </h2>
              <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                iTrim est un projet fictif conçu pour démontrer qu'il est possible de créer des applications web
                modernes et performantes en utilisant WordPress comme backend headless, couplé à Vue.js 3 et Nuxt 3 pour
                le frontend.
              </p>
            </div>

            <div class="space-y-4">
              <p class="text-gray-600 dark:text-gray-400">
                Ce projet illustre une approche architecturale qui combine le meilleur des deux mondes : la puissance et
                la flexibilité de WordPress pour la gestion de contenu, et la modernité de Vue.js/Nuxt pour créer une
                expérience utilisateur exceptionnelle.
              </p>
              <p class="text-gray-600 dark:text-gray-400">
                L'objectif est de prouver que WordPress n'est pas qu'un simple CMS traditionnel, mais peut servir de
                base solide pour des applications web modernes, scalables et performantes.
              </p>
            </div>
          </div>

          <UCard>
            <div class="space-y-6 p-6">
              <div class="space-y-2">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Objectifs du projet</h3>
              </div>
              <ul class="space-y-4">
                <li class="flex items-start gap-3">
                  <UIcon
                    name="i-lucide-check-circle-2"
                    class="text-primary-600 dark:text-primary-400 text-xl mt-0.5 shrink-0"
                  />
                  <span class="text-gray-700 dark:text-gray-300">Démontrer mes compétences techniques actuelles</span>
                </li>
                <li class="flex items-start gap-3">
                  <UIcon
                    name="i-lucide-check-circle-2"
                    class="text-primary-600 dark:text-primary-400 text-xl mt-0.5 shrink-0"
                  />
                  <span class="text-gray-700 dark:text-gray-300">Expérimenter avec l'architecture headless</span>
                </li>
                <li class="flex items-start gap-3">
                  <UIcon
                    name="i-lucide-check-circle-2"
                    class="text-primary-600 dark:text-primary-400 text-xl mt-0.5 shrink-0"
                  />
                  <span class="text-gray-700 dark:text-gray-300"
                    >Créer une base réutilisable pour de futurs projets</span
                  >
                </li>
                <li class="flex items-start gap-3">
                  <UIcon
                    name="i-lucide-check-circle-2"
                    class="text-primary-600 dark:text-primary-400 text-xl mt-0.5 shrink-0"
                  />
                  <span class="text-gray-700 dark:text-gray-300"
                    >Explorer les meilleures pratiques du développement moderne</span
                  >
                </li>
              </ul>
            </div>
          </UCard>
        </div>
      </section>

      <!-- Section Technologies -->
      <section class="py-8">
        <div class="text-center mb-12">
          <UBadge color="primary" variant="subtle" size="lg" class="mb-4"> Stack Technique </UBadge>
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Technologies utilisées</h2>
          <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            Un stack moderne et performant pour une expérience développeur optimale
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          <UCard v-for="tech in technologies" :key="tech.name" class="hover:shadow-lg transition-shadow">
            <div class="flex items-start gap-4">
              <div
                :class="`p-3 flex items-center justify-center rounded-lg bg-${tech.color}-100 dark:bg-${tech.color}-900/30`"
              >
                <UIcon :name="tech.icon" :class="`text-2xl text-${tech.color}-600 dark:text-${tech.color}-400`" />
              </div>
              <div class="flex-1">
                <h3 class="font-semibold text-gray-900 dark:text-white mb-1">{{ tech.name }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ tech.description }}</p>
              </div>
            </div>
          </UCard>
        </div>
      </section>

      <!-- Section Features -->
      <section class="py-8">
        <div class="text-center mb-12">
          <UBadge color="primary" variant="subtle" size="lg" class="mb-4"> Fonctionnalités </UBadge>
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Points clés du projet</h2>
          <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            Ce qui rend ce projet unique et techniquement intéressant
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="feature in features" :key="feature.title" class="space-y-3">
            <div class="w-12 h-12 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
              <UIcon :name="feature.icon" class="text-2xl text-primary-600 dark:text-primary-400" />
            </div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ feature.title }}</h3>
            <p class="text-gray-600 dark:text-gray-400">{{ feature.description }}</p>
          </div>
        </div>
      </section>

      <!-- Section Architecture -->
      <section>
        <div class="text-center mb-12">
          <UBadge color="primary" variant="subtle" size="lg" class="mb-4"> Architecture </UBadge>
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Comment ça fonctionne ?</h2>
        </div>

        <UCard>
          <div class="space-y-8 p-6">
            <div class="grid lg:grid-cols-3 gap-8">
              <!-- Backend -->
              <div class="text-center space-y-4">
                <div
                  class="w-20 h-20 rounded-2xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center mx-auto"
                >
                  <UIcon name="i-lucide-database" class="text-4xl text-primary-600 dark:text-primary-400" />
                </div>
                <div>
                  <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Backend</h3>
                  <p class="text-sm text-gray-600 dark:text-gray-400">
                    WordPress en mode Headless avec des endpoints API REST personnalisés pour exposer les données
                    (offres d'emploi, taxonomies, ACF)
                  </p>
                </div>
              </div>

              <!-- Flèche -->
              <div class="flex items-center justify-center">
                <UIcon name="i-lucide-arrow-right" class="text-4xl text-gray-400 hidden lg:block" />
                <UIcon name="i-lucide-arrow-down" class="text-4xl text-gray-400 lg:hidden" />
              </div>

              <!-- Frontend -->
              <div class="text-center space-y-4">
                <div
                  class="w-20 h-20 rounded-2xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center mx-auto"
                >
                  <UIcon name="i-lucide-monitor" class="text-4xl text-green-600 dark:text-green-400" />
                </div>
                <div>
                  <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Frontend</h3>
                  <p class="text-sm text-gray-600 dark:text-gray-400">
                    Application Nuxt 3 qui consomme l'API WordPress, avec SSR pour les performances et le SEO, et des
                    composants Nuxt UI pour l'interface
                  </p>
                </div>
              </div>
            </div>

            <UDivider />

            <div class="space-y-4 pt-8">
              <h4 class="font-semibold text-gray-900 dark:text-white">Avantages de cette approche :</h4>
              <div class="grid md:grid-cols-2 gap-4">
                <div class="flex items-start gap-3">
                  <UBadge color="primary" variant="soft">1</UBadge>
                  <p class="text-sm text-gray-600 dark:text-gray-400">
                    <strong>Séparation des préoccupations :</strong> Le contenu et la présentation sont découplés
                  </p>
                </div>
                <div class="flex items-start gap-3">
                  <UBadge color="primary" variant="soft">2</UBadge>
                  <p class="text-sm text-gray-600 dark:text-gray-400">
                    <strong>Flexibilité :</strong> Le frontend peut évoluer indépendamment du backend
                  </p>
                </div>
                <div class="flex items-start gap-3">
                  <UBadge color="primary" variant="soft">3</UBadge>
                  <p class="text-sm text-gray-600 dark:text-gray-400">
                    <strong>Performance :</strong> SSR Nuxt pour un chargement ultra-rapide
                  </p>
                </div>
                <div class="flex items-start gap-3">
                  <UBadge color="primary" variant="soft">4</UBadge>
                  <p class="text-sm text-gray-600 dark:text-gray-400">
                    <strong>Évolutivité :</strong> Possibilité d'ajouter facilement d'autres clients (mobile app, etc.)
                  </p>
                </div>
              </div>
            </div>
          </div>
        </UCard>
      </section>

      <!-- Section Mon Parcours -->
      <section>
        <div class="text-center mb-12">
          <UBadge color="primary" variant="subtle" size="lg" class="mb-4"> Mon Parcours </UBadge>
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Mon histoire de reconversion</h2>
          <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            De la reconversion au développement web moderne
          </p>
        </div>

        <!-- Timeline -->
        <div class="mb-16">
          <div class="space-y-6">
            <div v-for="(item, index) in timeline" :key="index" class="flex gap-4">
              <div class="flex flex-col items-center">
                <div
                  class="w-12 h-12 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center shrink-0"
                >
                  <UIcon name="i-lucide-calendar" class="text-primary-600 dark:text-primary-400" />
                </div>
                <div v-if="index < timeline.length - 1" class="w-0.5 h-full bg-gray-200 dark:bg-gray-800 mt-2" />
              </div>
              <div class="pb-8 flex-1">
                <div class="flex items-start justify-between gap-4 mb-2">
                  <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ item.title }}</h3>
                    <p class="text-sm text-primary-600 dark:text-primary-400 font-medium">{{ item.organization }}</p>
                  </div>
                  <UBadge color="primary" variant="soft">{{ item.period }}</UBadge>
                </div>
                <p class="text-gray-600 dark:text-gray-400">{{ item.description }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Compétences -->
        <div class="grid lg:grid-cols-2 gap-8">
          <!-- Compétences techniques -->
          <UCard>
            <template #header>
              <div class="flex items-center gap-3">
                <UIcon name="i-lucide-code-2" class="text-2xl text-primary-600 dark:text-primary-400" />
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Compétences Techniques</h3>
              </div>
            </template>
            <div class="space-y-6">
              <div v-for="skillGroup in technicalSkills" :key="skillGroup.category">
                <div class="flex items-center gap-2 mb-3">
                  <UIcon
                    :name="skillGroup.icon"
                    :class="`text-${skillGroup.color}-600 dark:text-${skillGroup.color}-400`"
                  />
                  <h4 class="font-semibold text-gray-700 dark:text-gray-300">{{ skillGroup.category }}</h4>
                </div>
                <div class="flex flex-wrap gap-2">
                  <UBadge
                    v-for="item in skillGroup.items"
                    :key="item"
                    :label="item"
                    :color="skillGroup.color"
                    variant="soft"
                    size="lg"
                  />
                </div>
              </div>
            </div>
          </UCard>

          <!-- Soft Skills & Centres d'intérêts -->
          <div class="space-y-8">
            <!-- Soft Skills -->
            <UCard>
              <template #header>
                <div class="flex items-center gap-3">
                  <UIcon name="i-lucide-heart-handshake" class="text-2xl text-primary-600 dark:text-primary-400" />
                  <h3 class="text-xl font-bold text-gray-900 dark:text-white">Soft Skills</h3>
                </div>
              </template>
              <div class="grid grid-cols-1 gap-4">
                <div
                  v-for="skill in softSkills"
                  :key="skill.name"
                  class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 dark:bg-gray-800/50"
                >
                  <div
                    :class="`w-10 h-10 rounded-lg bg-${skill.color}-100 dark:bg-${skill.color}-900/30 flex items-center justify-center shrink-0`"
                  >
                    <UIcon :name="skill.icon" :class="`text-${skill.color}-600 dark:text-${skill.color}-400`" />
                  </div>
                  <span class="font-medium text-gray-900 dark:text-white">{{ skill.name }}</span>
                </div>
              </div>
            </UCard>

            <!-- Centres d'intérêts -->
            <UCard>
              <template #header>
                <div class="flex items-center gap-3">
                  <UIcon name="i-lucide-star" class="text-2xl text-primary-600 dark:text-primary-400" />
                  <h3 class="text-xl font-bold text-gray-900 dark:text-white">Centres d'intérêts</h3>
                </div>
              </template>
              <div class="grid grid-cols-2 gap-3">
                <div
                  v-for="interest in interests"
                  :key="interest.name"
                  class="flex items-center gap-2 p-3 rounded-lg bg-gray-50 dark:bg-gray-800/50"
                >
                  <UIcon :name="interest.icon" class="text-gray-600 dark:text-gray-400" />
                  <span class="text-sm text-gray-700 dark:text-gray-300">{{ interest.name }}</span>
                </div>
              </div>
            </UCard>
          </div>
        </div>
      </section>

      <!-- Section Objectifs futurs -->
      <section>
        <div class="text-center mb-12">
          <UBadge color="primary" variant="subtle" size="lg" class="mb-4"> Vision </UBadge>
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Mes objectifs pour la suite</h2>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
          <UCard>
            <div class="space-y-4">
              <UIcon name="i-lucide-graduation-cap" class="text-4xl text-primary-600 dark:text-primary-400" />
              <h3 class="text-xl font-bold text-gray-900 dark:text-white">Élargir mes compétences</h3>
              <p class="text-gray-700 dark:text-gray-300">
                Continuer à explorer de nouvelles approches, outils et bonnes pratiques afin de rester à jour dans un
                domaine en constante évolution. Je souhaite approfondir mes compétences en développement web de manière
                globale, au-delà des langages et frameworks spécifiques.
              </p>
            </div>
          </UCard>

          <UCard>
            <div class="space-y-4">
              <UIcon name="i-lucide-rocket" class="text-4xl text-primary-600 dark:text-primary-400" />
              <h3 class="text-xl font-bold text-gray-900 dark:text-white">Contribuer à des projets innovants</h3>
              <p class="text-gray-700 dark:text-gray-300">
                Rejoindre une équipe dynamique où je pourrai mettre à profit mes compétences tout en continuant à
                apprendre. Je cherche des opportunités qui me permettront de travailler sur des projets challengeants.
              </p>
            </div>
          </UCard>
        </div>
      </section>

      <!-- Section Contact CTA -->
      <section>
        <UCard>
          <div class="text-center space-y-6 py-8">
            <div class="space-y-3">
              <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Intéressé par mon profil ?</h2>
              <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                N'hésitez pas à me contacter si vous souhaitez en savoir plus sur mon parcours, mes compétences, ou
                discuter d'opportunités professionnelles.
              </p>
            </div>
            <div class="flex flex-wrap gap-4 justify-center">
              <UButton size="xl" color="primary" variant="solid" icon="i-lucide-mail"> Me contacter </UButton>
              <UButton size="xl" color="gray" variant="outline" icon="i-lucide-github"> Voir mes projets </UButton>
            </div>
          </div>
        </UCard>
      </section>
    </UContainer>
  </div>
</template>
