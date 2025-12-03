<script setup lang="ts">
const props = defineProps<{
  jobId: number;
}>();

const isOpen = ref(false);

const closeModal = () => {
  isOpen.value = false;
};
</script>

<template>
  <UModal v-model:open="isOpen">
    <UButton
      icon="lucide:send"
      label="Postuler à cette offre"
      color="primary"
      variant="solid"
      size="xl"
      class="w-full justify-center"
      @click="isOpen = true"
    />

    <template #content>
      <div class="relative max-h-[90vh] w-full overflow-hidden flex flex-col">
        <UButton
          icon="lucide:x"
          color="gray"
          variant="ghost"
          size="sm"
          class="absolute right-4 top-4 z-10"
          @click="closeModal"
        />
        <ApplyForm :job-id="props.jobId" @close="closeModal" />
      </div>
    </template>
  </UModal>
</template>
