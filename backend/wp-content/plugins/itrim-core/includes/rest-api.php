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
                return [
                    'id' => $job->ID,
                    'title' => get_the_title($job->ID),
                    'content' => get_the_content(null, false, $job),
                    'date' => get_the_date('', $job),
                    'acf' => function_exists('get_fields') ? get_fields($job->ID) : [],
                ];
            }, $jobs);

            return $data;
        }
    ));
});


// Endpoint pour soumettre une candidature
add_action('rest_api_init', function() {
    register_rest_route('itrim/v1', '/apply', array(
        'methods' => 'POST',
        'callback' => function($request) {
            $params = $request->get_json_params();

            if(empty($params['job_id']) || empty($params['name']) || empty($params['email'])) {
                return new WP_Error('missing_data', 'Informations manquantes', array('status' => 400));
            }

            $post_id = wp_insert_post([
                'post_type' => 'job_application',
                'post_title' => sanitize_text_field($params['name']) . ' - ' . sanitize_text_field($params['email']),
                'post_status' => 'publish',
                'meta_input' => [
                    'job_id' => intval($params['job_id']),
                    'email' => sanitize_email($params['email']),
                    'phone' => isset($params['phone']) ? sanitize_text_field($params['phone']) : '',
                    'cv_url' => isset($params['cv_url']) ? esc_url_raw($params['cv_url']) : ''
                ]
            ]);

            return [
                'success' => true,
                'application_id' => $post_id
            ];
        }
    ));
});

