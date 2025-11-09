<?php
/*
Plugin Name: ITrim Core
Description: Gestion des offres d'emploi et candidatures pour ITrim.
Version: 1.0
Author: ThéoSchwilden
*/

// Sécurité : empêche l'accès direct au fichier
if ( ! defined( 'ABSPATH' ) ) exit; 


// Charger les types de post
require_once plugin_dir_path(__FILE__) . 'includes/post-types.php';

// Charger les champs des types de post
require_once plugin_dir_path(__FILE__) . 'includes/acf-fields.php';

// Charger les endpoints API
require_once plugin_dir_path(__FILE__) . 'includes/rest-api.php';

