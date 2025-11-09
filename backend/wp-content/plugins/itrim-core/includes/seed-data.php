<?php
// Route pour seed
add_action('rest_api_init', function() {
    register_rest_route('itrim/v1', '/seed-job-offers', array(
        'methods' => 'GET',
        'callback' => 'itrim_seed_job_offers',
        'permission_callback' => '__return_true',
    ));
});

// Gestion du seeders
function itrim_seed_job_offers($request) {
    if (!function_exists('acf_add_local_field_group') || !function_exists('update_field')) {
        return new WP_Error('acf_missing', 'ACF must be active.');
    }

    $titles = [
        'Développeur Front-End React',
        'Développeur Back-End PHP/Laravel',
        'Fullstack JavaScript (Node + React)',
        'Ingénieur DevOps',
        'Data Analyst',
        'Product Owner',
        'UX/UI Designer',
        'Administrateur Systèmes',
        'Ingénieur QA',
        'Lead Front-End Vue.js'
    ];

    $categories = ['Frontend', 'Backend', 'DevOps', 'Data', 'Product', 'Design', 'SysAdmin', 'QA'];
    $locations = ['Paris', 'Lyon', 'Marseille', 'Remote', 'Bordeaux', 'Toulouse', 'Lille'];
    $contract_types = ['CDI', 'CDD', 'Freelance', 'Stage', 'Alternance', 'Intérim'];
    $skills_pool = [
        'React', 'Vue.js', 'Angular', 'JavaScript', 'TypeScript',
        'Node.js', 'PHP', 'Laravel', 'Symfony', 'Python',
        'Docker', 'Kubernetes', 'SQL', 'NoSQL', 'Git',
        'AWS', 'GCP', 'Azure', 'Testing', 'CI/CD'
    ];
    $contract_durations = ['1 mois', '3 mois', '6 mois', '12 mois'];
    $remote_options = ['Oui', 'Non', 'Partiel'];
    $experience_levels = ['0-1 an', '1-3 ans', '3-5 ans', '5 ans et +'];
    $education_levels = ['Bac', 'Bac+2', 'Bac+3', 'Bac+5', 'Master+'];

    $ensure_terms = function($taxonomy, $terms) {
        foreach ($terms as $term) {
            if (!term_exists($term, $taxonomy)) {
                wp_insert_term($term, $taxonomy);
            }
        }
    };

    $ensure_terms('job_category', $categories);
    $ensure_terms('job_location', $locations);
    $ensure_terms('job_contract_type', $contract_types);
    $ensure_terms('job_skill', $skills_pool);

    $count = 10;
    $created = 0;
    $results = [];

    for ($i = 0; $i < $count; $i++) {
        $title = $titles[$i % count($titles)];
        $post_content = "Description du poste : $title. Vous intégrerez une équipe dynamique pour travailler sur des projets innovants dans le secteur IT.";

        $post_id = wp_insert_post([
            'post_title'   => $title,
            'post_content' => $post_content,
            'post_status'  => 'publish',
            'post_type'    => 'job_offer',
        ]);

        if (is_wp_error($post_id) || !$post_id) continue;

        $num_skills = rand(3, 6);
        $shuffled = $skills_pool;
        shuffle($shuffled);
        $skill_rows = [];
        $skills_for_tax = [];

        for ($s = 0; $s < $num_skills; $s++) {
            $skill_name = $shuffled[$s];
            $skill_rows[] = ['skill' => $skill_name];
            $skills_for_tax[] = $skill_name;
        }

        update_field('skills', $skill_rows, $post_id);
        update_field('contract_duration', $contract_durations[array_rand($contract_durations)], $post_id);
        update_field('remote', $remote_options[array_rand($remote_options)], $post_id);
        update_field('experience_required', $experience_levels[array_rand($experience_levels)], $post_id);
        update_field('education_level', $education_levels[array_rand($education_levels)], $post_id);

        $company = [
            'name' => 'TechCorp ' . chr(65 + ($i % 26)),
            'size' => rand(5, 1000),
            'creation_date' => date('Y-m-d', strtotime('-' . rand(1, 20) . ' years')),
        ];
        update_field('company', $company, $post_id);

        // Taxonomies
        $cat = $categories[array_rand($categories)];
        $loc = $locations[array_rand($locations)];
        $contract_choice = $contract_types[array_rand($contract_types)];

        wp_set_object_terms($post_id, $cat, 'job_category', true);
        wp_set_object_terms($post_id, $loc, 'job_location', true);
        wp_set_object_terms($post_id, $contract_choice, 'job_contract_type', true);
        wp_set_object_terms($post_id, $skills_for_tax, 'job_skill', true);

        $created++;
        $results[] = [
            'post_id' => $post_id,
            'title' => $title,
            'category' => $cat,
            'location' => $loc,
            'contract_type' => $contract_choice,
            'skills' => $skills_for_tax,
        ];
    }

    return [
        'success' => true,
        'created' => $created,
        'details' => $results,
    ];
}
