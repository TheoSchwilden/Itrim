<script setup lang="ts">
const props = defineProps<{
  jobId: number;
}>();

const emit = defineEmits<{
  close: [];
}>();

const toast = useToast();
const config = useRuntimeConfig();
const isSubmitting = ref(false);

const form = reactive({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
  cv: null as File | null,
  message: ''
});

const cvFileName = computed(() => form.cv?.name || '');

const handleFileChange = (event: Event) => {
  const target = event.target as HTMLInputElement;
  if (target.files && target.files[0]) {
    const file = target.files[0];

    // Validation du type de fichier
    const allowedTypes = [
      'application/pdf',
      'application/msword',
      'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];
    if (!allowedTypes.includes(file.type)) {
      toast.add({
        title: 'Fichier non valide',
        description: 'Veuillez uploader un fichier PDF, DOC ou DOCX',
        icon: 'lucide:alert-circle',
        color: 'error'
      });
      return;
    }

    const maxSize = 5 * 1024 * 1024;
    if (file.size > maxSize) {
      toast.add({
        title: 'Fichier trop volumineux',
        description: 'Le fichier ne doit pas dépasser 5MB',
        icon: 'lucide:alert-circle',
        color: 'error'
      });
      return;
    }

    form.cv = file;
  }
};

const clearFile = () => {
  form.cv = null;
  const fileInput = document.querySelector('input[type="file"]') as HTMLInputElement;
  if (fileInput) fileInput.value = '';
};

const resetForm = () => {
  form.firstName = '';
  form.lastName = '';
  form.email = '';
  form.phone = '';
  form.cv = null;
  form.message = '';
};

const submitForm = async () => {
  if (!form.firstName || !form.lastName || !form.email || !form.phone) {
    toast.add({
      title: 'Champs manquants',
      description: 'Veuillez remplir tous les champs obligatoires',
      icon: 'lucide:alert-circle',
      color: 'error'
    });
    return;
  }

  if (!form.cv) {
    toast.add({
      title: 'CV manquant',
      description: 'Veuillez joindre votre CV',
      icon: 'lucide:alert-circle',
      color: 'error'
    });
    return;
  }

  isSubmitting.value = true;

  try {
    const formData = new FormData();
    formData.append('job_id', String(props.jobId));
    formData.append('first_name', form.firstName);
    formData.append('last_name', form.lastName);
    formData.append('email', form.email);
    formData.append('phone', form.phone);

    if (form.message) {
      formData.append('message', form.message);
    }

    if (form.cv) {
      formData.append('cv', form.cv);
    }

    // Appel à l'API WordPress
    const response = await fetch(`${config.public.apiUrl}/itrim/v1/apply`, {
      method: 'POST',
      body: formData
    });

    const data = await response.json();

    // Gestion des erreurs de l'API
    if (!response.ok || !data.success) {
      throw new Error(data.message || "Erreur lors de l'envoi de la candidature");
    }

    // Succès
    toast.add({
      title: 'Candidature envoyée !',
      description: 'Nous avons bien reçu votre candidature. Vous recevrez une confirmation par email.',
      icon: 'lucide:check-circle',
      color: 'success'
    });

    resetForm();
    emit('close');
  } catch (error: any) {
    console.error('Error submitting application:', error);

    // Gestion des différents types d'erreurs
    let errorMessage = "Une erreur est survenue lors de l'envoi de votre candidature. Veuillez réessayer.";

    if (error.message) {
      errorMessage = error.message;
    }

    toast.add({
      title: 'Erreur',
      description: errorMessage,
      icon: 'lucide:alert-circle',
      color: 'error'
    });
  } finally {
    isSubmitting.value = false;
  }
};
</script>

<template>
  <div class="p-6 overflow-y-auto max-h-[80vh] w-full">
    <form @submit.prevent="submitForm" class="space-y-5 w-full">
      <div class="text-center mb-6">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Postuler à cette offre</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
          Remplissez le formulaire ci-dessous pour envoyer votre candidature
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
        <UFormField label="Prénom" name="firstName" required class="w-full">
          <UInput v-model="form.firstName" placeholder="Jean" icon="lucide:user" required class="w-full" />
        </UFormField>

        <UFormField label="Nom" name="lastName" required class="w-full">
          <UInput v-model="form.lastName" placeholder="Dupont" icon="lucide:user" required class="w-full" />
        </UFormField>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
        <UFormField label="Email" name="email" required class="w-full">
          <UInput
            v-model="form.email"
            type="email"
            placeholder="jean.dupont@email.com"
            icon="lucide:mail"
            required
            class="w-full"
          />
        </UFormField>

        <UFormField label="Téléphone" name="phone" required class="w-full">
          <UInput
            v-model="form.phone"
            type="tel"
            placeholder="06 12 34 56 78"
            icon="lucide:phone"
            required
            class="w-full"
          />
        </UFormField>
      </div>

      <UFormField label="CV (PDF)" name="cv" required class="w-full">
        <div class="relative w-full">
          <input type="file" accept=".pdf,.doc,.docx" class="hidden" id="cv-upload" @change="handleFileChange" />
          <div
            v-if="!form.cv"
            class="w-full border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-lg p-6 text-center hover:border-primary-500 dark:hover:border-primary-500 transition-colors cursor-pointer"
          >
            <label for="cv-upload" class="cursor-pointer block">
              <UIcon name="lucide:upload" class="text-gray-400 text-2xl mb-2" />
              <p class="text-sm text-gray-600 dark:text-gray-400">
                <span class="text-primary-600 dark:text-primary-400 font-medium">Cliquez pour télécharger</span>
                ou glissez-déposez
              </p>
              <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">PDF, DOC, DOCX (max 5MB)</p>
            </label>
          </div>
          <div
            v-else
            class="w-full border border-gray-200 dark:border-gray-700 rounded-lg p-4 flex items-center justify-between bg-gray-50 dark:bg-gray-800/50"
          >
            <div class="flex items-center gap-3 min-w-0">
              <div
                class="shrink-0 w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center"
              >
                <UIcon name="lucide:file-text" class="text-primary-600 dark:text-primary-400" />
              </div>
              <div class="min-w-0">
                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                  {{ cvFileName }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                  {{ form.cv ? (form.cv.size / 1024 / 1024).toFixed(2) + ' MB' : '' }}
                </p>
              </div>
            </div>
            <UButton icon="lucide:x" color="gray" variant="ghost" size="sm" class="shrink-0" @click="clearFile" />
          </div>
        </div>
      </UFormField>

      <UFormField label="Lettre de motivation" name="message" class="w-full">
        <UTextarea
          v-model="form.message"
          placeholder="Présentez-vous et expliquez pourquoi ce poste vous intéresse..."
          :rows="4"
          class="w-full"
        />
      </UFormField>

      <div class="pt-2">
        <UButton
          type="submit"
          label="Envoyer ma candidature"
          icon="lucide:send"
          color="primary"
          size="lg"
          class="w-full justify-center"
          :loading="isSubmitting"
          :disabled="isSubmitting"
        />
      </div>

      <p class="text-xs text-gray-500 dark:text-gray-400 text-center">
        En soumettant ce formulaire, vous acceptez que vos données soient traitées conformément à notre
        <NuxtLink to="/politique-confidentialite" class="text-primary-600 dark:text-primary-400 hover:underline">
          politique de confidentialité </NuxtLink
        >.
      </p>
    </form>
  </div>
</template>
