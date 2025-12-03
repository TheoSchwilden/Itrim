<?php

// Endpoint pour récupérer les offres d'emploi
add_action('rest_api_init', function() {
    register_rest_route('itrim/v1', '/job-offers', array(
        'methods' => 'GET',
        'callback' => function() {
            $jobs = get_posts(array(
                'post_type' => 'job_offer',
                'numberposts' => -1
            ));

            $data = array_map(function($job) {
                 $taxonomies = [
                    'job_category' => wp_get_post_terms($job->ID, 'job_category', ['fields' => 'names']),
                    'job_location' => wp_get_post_terms($job->ID, 'job_location', ['fields' => 'names']),
                    'job_contract_type' => wp_get_post_terms($job->ID, 'job_contract_type', ['fields' => 'names']),
                    'job_skill' => wp_get_post_terms($job->ID, 'job_skill', ['fields' => 'names']),
                ];

                return [
                    'id' => $job->ID,
                    'title' => get_the_title($job->ID),
                    'content' => get_the_content(null, false, $job),
                    'date' => get_the_date('j F Y', $job),
                    'acf' => function_exists('get_fields') ? get_fields($job->ID) : [],
                    'taxonomies' => $taxonomies
                ];
            }, $jobs);

            return $data;
        }
    ));
});

// Endpoint pour récuperer une offre d'emploi par son id
add_action('rest_api_init', function() {
    register_rest_route('itrim/v1', '/job-offer/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'itrim_get_job_offer_by_id',
        'permission_callback' => '__return_true', // à sécuriser en prod
    ));
});

// Callback pour récuperer une offre d'emploi par son id
function itrim_get_job_offer_by_id($data) {
    $post_id = intval($data['id']);
    $post = get_post($post_id);

    if (!$post || $post->post_type !== 'job_offer') {
        return new WP_Error('not_found', 'Offre d\'emploi introuvable', array('status' => 404));
    }

    $acf_fields = get_fields($post_id);

    $taxonomies = [
        'job_category' => wp_get_post_terms($post_id, 'job_category', ['fields' => 'names']),
        'job_location' => wp_get_post_terms($post_id, 'job_location', ['fields' => 'names']),
        'job_contract_type' => wp_get_post_terms($post_id, 'job_contract_type', ['fields' => 'names']),
        'job_skill' => wp_get_post_terms($post_id, 'job_skill', ['fields' => 'names']),
    ];

    return [
        'id' => $post_id,
        'title' => get_the_title($post_id),
        'content' => apply_filters('the_content', $post->post_content),
        'acf' => $acf_fields,
        'taxonomies' => $taxonomies,
    ];
}

// Endpoint pour récupérer les 6 dernières offres d'emploi
add_action('rest_api_init', function() {
    register_rest_route('itrim/v1', '/job-offers/latest', array(
        'methods' => 'GET',
        'callback' => function() {

            $jobs = get_posts(array(
                'post_type' => 'job_offer',
                'numberposts' => 6,
                'orderby' => 'date',
                'order' => 'DESC'
            ));

            $data = array_map(function($job) {

                $taxonomies = [
                    'job_category' => wp_get_post_terms($job->ID, 'job_category', ['fields' => 'names']),
                    'job_location' => wp_get_post_terms($job->ID, 'job_location', ['fields' => 'names']),
                    'job_contract_type' => wp_get_post_terms($job->ID, 'job_contract_type', ['fields' => 'names']),
                    'job_skill' => wp_get_post_terms($job->ID, 'job_skill', ['fields' => 'names']),
                ];

                return [
                    'id' => $job->ID,
                    'title' => get_the_title($job->ID),
                    'content' => get_the_content(null, false, $job),
                    'date' => get_the_date('j F Y', $job),
                    'acf' => function_exists('get_fields') ? get_fields($job->ID) : [],
                    'taxonomies' => $taxonomies
                ];
            }, $jobs);

            return $data;
        },
        'permission_callback' => '__return_true'
    ));
});


// Endpoint pour soumettre une candidature
add_action('rest_api_init', function() {
    register_rest_route('itrim/v1', '/apply', array(
        'methods' => 'POST',
        'callback' => function($request) {
            $params = $request->get_params();
            $files = $request->get_file_params();

            if(empty($params['job_id']) || 
               empty($params['first_name']) || 
               empty($params['last_name']) || 
               empty($params['email']) || 
               empty($params['phone'])) {
                return new WP_Error('missing_data', 'Informations manquantes (prénom, nom, email, téléphone, job_id requis)', array('status' => 400));
            }

            if(!is_email($params['email'])) {
                return new WP_Error('invalid_email', 'Email invalide', array('status' => 400));
            }

            if(empty($files['cv'])) {
                return new WP_Error('missing_cv', 'Le CV est requis', array('status' => 400));
            }

            $allowed_types = array('application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            if(!in_array($files['cv']['type'], $allowed_types)) {
                return new WP_Error('invalid_file_type', 'Format de fichier non accepté. Formats autorisés : PDF, DOC, DOCX', array('status' => 400));
            }

            $post_id = wp_insert_post([
                'post_type' => 'job_application',
                'post_title' => 'Candidature temporaire',
                'post_status' => 'publish'
            ]);

            if(is_wp_error($post_id)) {
                return new WP_Error('creation_failed', 'Erreur lors de la création de la candidature', array('status' => 500));
            }

            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');

            $cv_id = media_handle_upload('cv', $post_id);

            if(is_wp_error($cv_id)) {
                wp_delete_post($post_id, true);
                return new WP_Error('upload_failed', 'Erreur lors de l\'upload du CV : ' . $cv_id->get_error_message(), array('status' => 500));
            }

            update_field('first_name', sanitize_text_field($params['first_name']), $post_id);
            update_field('last_name', sanitize_text_field($params['last_name']), $post_id);
            update_field('email', sanitize_email($params['email']), $post_id);
            update_field('phone', sanitize_text_field($params['phone']), $post_id);
            update_field('related_job', intval($params['job_id']), $post_id);
            update_field('cv', $cv_id, $post_id);
            
            if(isset($params['message']) && !empty($params['message'])) {
                update_field('message', sanitize_textarea_field($params['message']), $post_id);
            }

            $job_title = get_the_title(intval($params['job_id']));
            
            wp_update_post([
                'ID' => $post_id,
                'post_title' => 'Candidature #' . $post_id . ' (' . $job_title . ')'
            ]);

            return [
                'success' => true,
                'application_id' => $post_id,
                'cv_id' => $cv_id,
                'message' => 'Candidature envoyée avec succès'
            ];
        },
        'permission_callback' => '__return_true'
    ));
});

