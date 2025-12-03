<?php

// Register du post type Offres d'emploi
add_action('init', function() {
    $labels = array(
        'name' => 'Offres d\'emploi',
        'singular_name' => 'Offre d\'emploi',
        'add_new' => 'Ajouter une offre',
        'add_new_item' => 'Ajouter une offre d\'emploi',
        'edit_item' => 'Modifier l\'offre d\'emploi',
        'new_item' => 'Nouvelle offre d\'emploi',
        'view_item' => 'Voir l\'offre d\'emploi',
        'search_items' => 'Rechercher des offres d\'emploi',
        'not_found' => 'Aucune offre d\'emploi trouvée',
        'not_found_in_trash' => 'Aucune offre d\'emploi dans la corbeille',
        'all_items' => 'Toutes les offres d\'emploi',
        'menu_name' => 'Offres d\'emploi'
    );

    $args = array(
        'label' => 'Offres d\'emploi',
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-businessman',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'rewrite' => array('slug' => 'offres-emploi'),
    );

    register_post_type('job_offer', $args);
});


// Créer les taxonomies pour les offres d'emploi 
add_action('init', function() {

    register_taxonomy(
        'job_category',
        'job_offer',
        array(
            'label' => 'Catégories de job',
            'hierarchical' => true,
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'job-category'),
        )
    );

    register_taxonomy(
        'job_location',
        'job_offer',
        array(
            'label' => 'Localisation',
            'hierarchical' => true,
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'job-location'),
        )
    );

    register_taxonomy(
        'job_contract_type',
        'job_offer',
        array(
            'label' => 'Type de contrat',
            'hierarchical' => false,
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'job-contract-type'),
        )
    );

    register_taxonomy(
        'job_skill',
        'job_offer',
        array(
            'label' => 'Compétences',
            'hierarchical' => false,
            'show_in_rest' => true,
            'rewrite' => array('slug' => 'job-skill'),
        )
    );
});


// Créer le type de post 'job_application'
add_action('init', function() {
    $labels = array(
        'name' => 'Candidatures',
        'singular_name' => 'Candidature',
        'add_new' => 'Ajouter une candidature',
        'add_new_item' => 'Ajouter une candidature',
        'edit_item' => 'Modifier la candidature',
        'new_item' => 'Nouvelle candidature',
        'view_item' => 'Voir la candidature',
        'search_items' => 'Rechercher des candidatures',
        'not_found' => 'Aucune candidature trouvée',
        'not_found_in_trash' => 'Aucune candidature dans la corbeille',
        'all_items' => 'Toutes les candidatures',
        'menu_name' => 'Candidatures'
    );

    $args = array(
        'label' => 'Candidatures',
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,             
        'show_in_rest' => true,         
        'has_archive' => false,
        'menu_icon' => 'dashicons-email',
        'supports' => array('title', 'custom-fields')
    );

    register_post_type('job_application', $args);
});


