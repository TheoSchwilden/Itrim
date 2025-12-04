<script setup lang="ts">
const state = reactive({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
  subject: undefined as string | undefined,
  message: ''
});

const subjectOptions = [
  { label: 'Opportunité professionnelle', value: 'job' },
  { label: 'Collaboration sur un projet', value: 'project' },
  { label: 'Mission freelance', value: 'freelance' },
  { label: 'Question technique', value: 'technical' },
  { label: 'Demande de devis', value: 'quote' },
  { label: 'Autre', value: 'other' }
];

const contactInfo = [
  {
    icon: 'lucide:mail',
    title: 'Email',
    value: 'theo.schwilden@gmail.com',
    link: 'mailto:theo.schwilden@gmail.com'
  },
  {
    icon: 'lucide:map-pin',
    title: 'Localisation',
    value: 'Valence, Drôme, FR'
  },
  {
    icon: 'lucide:briefcase',
    title: 'Disponibilité',
    value: 'Ouvert aux opportunités'
  }
];

const socialLinks = [
  {
    icon: 'lucide:github',
    name: 'GitHub',
    url: 'https://github.com/TheoSchwilden'
  },
  {
    icon: 'lucide:linkedin',
    name: 'LinkedIn',
    url: 'https://www.linkedin.com/in/th%C3%A9o-schwilden-686008267/'
  }
];

const toast = useToast();
const isSubmitting = ref(false);

const onSubmit = async () => {
  if (!state.firstName || !state.lastName || !state.email || !state.subject || !state.message) {
    toast.add({
      title: 'Champs manquants',
      description: 'Veuillez remplir tous les champs obligatoires',
      icon: 'lucide:alert-circle',
      color: 'error'
    });
    return;
  }

  isSubmitting.value = true;

  try {
    await new Promise((resolve) => setTimeout(resolve, 1500));

    toast.add({
      title: 'Message envoyé !',
      description: "J'ai bien reçu votre message et vous répondrai dans les plus brefs délais.",
      icon: 'lucide:check-circle',
      color: 'success'
    });

    state.firstName = '';
    state.lastName = '';
    state.email = '';
    state.phone = '';
    state.subject = undefined;
    state.message = '';
  } catch (error) {
    toast.add({
      title: 'Erreur',
      description: "Une erreur est survenue lors de l'envoi. Veuillez réessayer.",
      icon: 'lucide:alert-circle',
      color: 'error'
    });
  } finally {
    isSubmitting.value = false;
  }
};

const resetForm = () => {
  state.firstName = '';
  state.lastName = '';
  state.email = '';
  state.phone = '';
  state.subject = undefined;
  state.message = '';
};
</script>

<template>
  <div>
    <section class="relative py-16 lg:pt-20 lg:pb-0">
      <UContainer>
        <div class="text-center max-w-3xl mx-auto">
          <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">Me contacter</h1>
          <p class="text-lg text-gray-600 dark:text-gray-400">
            Une question ? Un projet ? N'hésitez pas à me contacter pour en discuter.
          </p>
        </div>
      </UContainer>
    </section>

    <UContainer class="py-16">
      <div class="grid lg:grid-cols-3 gap-12">
        <div class="lg:col-span-1 space-y-6">
          <UCard>
            <div class="space-y-6">
              <div class="space-y-3">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Restons en contact</h2>
                <p class="text-gray-600 dark:text-gray-400">
                  Je suis toujours intéressé par de nouvelles opportunités et collaborations. N'hésitez pas à me
                  contacter pour discuter de vos projets.
                </p>
              </div>

              <USeparator />

              <div class="space-y-4">
                <div v-for="info in contactInfo" :key="info.title" class="flex items-start gap-3">
                  <div
                    class="w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center shrink-0"
                  >
                    <UIcon :name="info.icon" class="text-primary-600 dark:text-primary-400" />
                  </div>
                  <div class="flex-1">
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ info.title }}</p>
                    <a
                      v-if="info.link"
                      :href="info.link"
                      class="font-medium text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 transition-colors"
                    >
                      {{ info.value }}
                    </a>
                    <p v-else class="font-medium text-gray-900 dark:text-white">{{ info.value }}</p>
                  </div>
                </div>
              </div>

              <USeparator />

              <div class="space-y-3">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide">
                  Me suivre
                </h3>
                <div class="flex gap-3">
                  <UButton
                    v-for="social in socialLinks"
                    :key="social.name"
                    :icon="social.icon"
                    color="neutral"
                    variant="outline"
                    size="lg"
                    :aria-label="social.name"
                    :to="social.url"
                  />
                </div>
              </div>
            </div>
          </UCard>

          <UCard>
            <div class="space-y-4">
              <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-green-500 animate-pulse" />
                <span class="font-semibold text-gray-900 dark:text-white">Actuellement disponible</span>
              </div>
              <p class="text-sm text-gray-600 dark:text-gray-400">
                Je suis ouvert aux opportunités de développement web full-stack, en CDI, freelance ou collaboration sur
                projets intéressants.
              </p>
            </div>
          </UCard>
        </div>

        <div class="lg:col-span-2">
          <UCard>
            <template #header>
              <div class="space-y-2">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Envoyez-moi un message</h2>
                <p class="text-gray-600 dark:text-gray-400">
                  Remplissez le formulaire ci-dessous et je vous répondrai dans les plus brefs délais.
                </p>
              </div>
            </template>

            <form @submit.prevent="onSubmit" class="space-y-6">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <UFormField label="Prénom" name="firstName" required class="w-full">
                  <UInput v-model="state.firstName" placeholder="Jean" icon="lucide:user" class="w-full" />
                </UFormField>

                <UFormField label="Nom" name="lastName" required class="w-full">
                  <UInput v-model="state.lastName" placeholder="Dupont" icon="lucide:user" class="w-full" />
                </UFormField>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <UFormField label="Email" name="email" required class="w-full">
                  <UInput
                    v-model="state.email"
                    type="email"
                    placeholder="jean.dupont@email.com"
                    icon="lucide:mail"
                    class="w-full"
                  />
                </UFormField>

                <UFormField label="Téléphone" name="phone" class="w-full">
                  <UInput
                    v-model="state.phone"
                    type="tel"
                    placeholder="06 12 34 56 78"
                    icon="lucide:phone"
                    class="w-full"
                  />
                </UFormField>
              </div>

              <UFormField label="Sujet" name="subject" required class="w-full">
                <USelectMenu
                  v-model="state.subject"
                  :items="subjectOptions"
                  value-key="value"
                  placeholder="Sélectionnez un sujet"
                  icon="lucide:message-square"
                  class="w-full"
                />
              </UFormField>

              <UFormField label="Message" name="message" required class="w-full">
                <UTextarea
                  v-model="state.message"
                  placeholder="Décrivez votre demande en détail..."
                  :rows="6"
                  class="w-full"
                />
              </UFormField>

              <div class="flex items-start gap-3 p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50">
                <UIcon name="lucide:shield-check" class="text-primary-600 dark:text-primary-400 text-xl shrink-0" />
                <p class="text-sm text-gray-600 dark:text-gray-400">
                  Vos informations sont traitées de manière confidentielle conformément au RGPD et ne seront jamais
                  partagées avec des tiers.
                </p>
              </div>

              <div class="flex flex-col sm:flex-row gap-4">
                <UButton
                  type="submit"
                  color="primary"
                  size="lg"
                  icon="lucide:send"
                  class="w-full sm:w-auto justify-center"
                  :loading="isSubmitting"
                  :disabled="isSubmitting"
                >
                  Envoyer le message
                </UButton>
                <UButton
                  type="button"
                  color="neutral"
                  variant="outline"
                  size="lg"
                  icon="lucide:rotate-ccw"
                  class="w-full sm:w-auto justify-center"
                  @click="resetForm"
                >
                  Réinitialiser
                </UButton>
              </div>
            </form>
          </UCard>

          <div class="mt-12">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Questions fréquentes</h3>
            <div class="grid sm:grid-cols-2 gap-6">
              <UCard>
                <div class="space-y-2">
                  <div class="flex items-center gap-2">
                    <UIcon name="lucide:clock" class="text-primary-600 dark:text-primary-400" />
                    <h4 class="font-semibold text-gray-900 dark:text-white">Délai de réponse</h4>
                  </div>
                  <p class="text-sm text-gray-600 dark:text-gray-400">
                    Je réponds généralement sous 24-48 heures ouvrées.
                  </p>
                </div>
              </UCard>

              <UCard>
                <div class="space-y-2">
                  <div class="flex items-center gap-2">
                    <UIcon name="lucide:calendar" class="text-primary-600 dark:text-primary-400" />
                    <h4 class="font-semibold text-gray-900 dark:text-white">Disponibilité</h4>
                  </div>
                  <p class="text-sm text-gray-600 dark:text-gray-400">
                    Ouvert aux projets freelance et opportunités CDI.
                  </p>
                </div>
              </UCard>

              <UCard>
                <div class="space-y-2">
                  <div class="flex items-center gap-2">
                    <UIcon name="lucide:map-pin" class="text-primary-600 dark:text-primary-400" />
                    <h4 class="font-semibold text-gray-900 dark:text-white">Zone géographique</h4>
                  </div>
                  <p class="text-sm text-gray-600 dark:text-gray-400">Valence et région Auvergne-Rhône-Alpes.</p>
                </div>
              </UCard>

              <UCard>
                <div class="space-y-2">
                  <div class="flex items-center gap-2">
                    <UIcon name="lucide:laptop" class="text-primary-600 dark:text-primary-400" />
                    <h4 class="font-semibold text-gray-900 dark:text-white">Télétravail</h4>
                  </div>
                  <p class="text-sm text-gray-600 dark:text-gray-400">Ouvert au remote ou hybride.</p>
                </div>
              </UCard>
            </div>
          </div>
        </div>
      </div>
    </UContainer>
  </div>
</template>
