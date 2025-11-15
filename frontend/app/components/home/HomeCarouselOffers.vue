<script setup lang="ts">
import emblaCarouselVue from 'embla-carousel-vue';

const { data: jobs, pending } = await useFetch('http://localhost:8000/wp-json/itrim/v1/job-offers/latest', {
  key: 'jobs-cache',
  getCachedData: (key) => useNuxtData(key).data.value
});

console.log(jobs.value);

const [emblaRef, emblaApi] = emblaCarouselVue({
  loop: false,
  align: 'start'
});

const scrollPrev = () => emblaApi.value?.scrollPrev();
const scrollNext = () => emblaApi.value?.scrollNext();
</script>

<template>
  <div v-if="pending">Chargement des offres...</div>

  <div v-else class="embla relative">
    <button
      class="embla__prev w-11 h-11 font-medium inline-flex items-center disabled:cursor-not-allowed aria-disabled:cursor-not-allowed disabled:opacity-75 aria-disabled:opacity-75 transition-colors text-sm gap-1.5 ring ring-inset ring-accented text-default bg-default hover:bg-elevated active:bg-elevated disabled:bg-default aria-disabled:bg-default focus:outline-none focus-visible:ring-2 focus-visible:ring-inverted p-1.5 absolute rounded-full start-4 sm:-start-12 top-1/2 -translate-y-1/2"
      @click="scrollPrev"
    >
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
        class="lucide lucide-arrow-left-icon lucide-arrow-left"
      >
        <path d="m12 19-7-7 7-7" />
        <path d="M19 12H5" />
      </svg>
    </button>
    <button
      class="embla__next w-11 h-11 font-medium inline-flex items-center disabled:cursor-not-allowed aria-disabled:cursor-not-allowed disabled:opacity-75 aria-disabled:opacity-75 transition-colors text-sm gap-1.5 ring ring-inset ring-accented text-default bg-default hover:bg-elevated active:bg-elevated disabled:bg-default aria-disabled:bg-default focus:outline-none focus-visible:ring-2 focus-visible:ring-inverted p-1.5 absolute rounded-full end-4 sm:-end-12 top-1/2 -translate-y-1/2"
      @click="scrollNext"
    >
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
        class="lucide lucide-arrow-right-icon lucide-arrow-right"
      >
        <path d="M5 12h14" />
        <path d="m12 5 7 7-7 7" />
      </svg>
    </button>

    <div class="embla__viewport" ref="emblaRef">
      <div class="embla__container">
        <div v-for="job in jobs" :key="job.id" class="embla__slide">
          <div class="slide-inner">
            <HomeBlogPost :job="job" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.embla {
  position: relative;
}

.embla__viewport {
  overflow: hidden;
  padding: 10px;
}

.embla__container {
  display: flex;
  gap: 1.5rem;
  padding: 0rem;
}

.embla__slide {
  min-width: 100%;
}

@media (min-width: 640px) {
  .embla__slide {
    min-width: calc(50% - 0.75rem);
  }
}

@media (min-width: 1024px) {
  .embla__slide {
    min-width: calc(33.3333% - 1rem);
  }
}

.slide-inner {
  height: 100%;
  display: flex;
}

.slide-inner > * {
  width: 100%;
  height: 100%;
}

/* ARROWS */
.embla__prev,
.embla__next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 20;
  background: transparent;
  padding: 10px 14px;
  cursor: pointer;
}

.embla__prev {
  left: -55px;
}

.embla__next {
  right: -55px;
}

@media (max-width: 1024px) {
  .embla__next {
    right: -5px;
    background: #0f172b;
  }
  .embla__prev {
    left: -5px;
    background: #0f172b;
  }
}
</style>
