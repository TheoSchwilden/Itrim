// utils/searchProvider.ts

export interface SearchItem {
  id: string;
  title: string;
  description?: string;
  url: string;
  icon?: string;
  type: 'page' | 'job';
}

export default async function (query: string): Promise<SearchItem[]> {
  const normalizedQuery = query.toLowerCase();

  // 🔹 1. Ta navigation (sources locales)
  const pages: SearchItem[] = [
    {
      id: 'home',
      title: 'Accueil',
      url: '/',
      icon: 'i-lucide-home',
      type: 'page'
    },
    {
      id: 'offres',
      title: "Offres d'emploi",
      url: '/offres',
      icon: 'i-lucide-briefcase-business',
      type: 'page'
    },
    {
      id: 'about',
      title: 'À propos',
      url: '/a-propos',
      icon: 'i-lucide-circle-question-mark',
      type: 'page'
    },
    {
      id: 'contact',
      title: 'Contact',
      url: '/contact',
      icon: 'i-lucide-phone',
      type: 'page'
    }
  ];

  // 🔹 2. Fetch Offres d’emploi depuis WordPress
  let jobs: SearchItem[] = [];
  try {
    const jobRes = await fetch('http://localhost:8000/wp-json/itrim/v1/job-offers');
    const jobData = await jobRes.json();

    jobs = jobData.map((job: any) => ({
      id: `job-${job.id}`,
      title: job.title,
      description: job.description?.slice(0, 120),
      url: `/offres/${job.slug}`,
      icon: 'i-lucide-briefcase',
      type: 'job'
    }));
  } catch (error) {
    console.error('Erreur lors du fetch des offres :', error);
  }

  // 🔹 3. Combine et filtre avec la query
  const allItems = [...pages, ...jobs];

  return allItems.filter(
    (item) =>
      item.title.toLowerCase().includes(normalizedQuery) || item.description?.toLowerCase().includes(normalizedQuery)
  );
}
