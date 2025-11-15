<?php
// Vérifie si ACF est actif
if( !function_exists('acf_add_local_field_group') ) return;


 // Champs pour les offres d'emploi
acf_add_local_field_group(array(
    'key' => 'group_job_offer',
    'title' => 'Offre d\'emploi',
    'fields' => array(
        array(
            'key' => 'field_skills',
            'label' => 'Compétences requises',
            'name' => 'skills',
            'type' => 'repeater',
            'sub_fields' => array(
                array(
                    'key' => 'field_skill_name',
                    'label' => 'Compétence',
                    'name' => 'skill',
                    'type' => 'text',
                ),
            ),
            'min' => 0,
            'max' => 20,
            'layout' => 'table',
        ),
        array(
            'key' => 'field_contract_duration',
            'label' => 'Durée du contrat',
            'name' => 'contract_duration',
            'type' => 'select',
            'choices' => array(
                '1 mois' => '1 mois',
                '3 mois' => '3 mois',
                '6 mois' => '6 mois',
                '12 mois' => '12 mois',
            ),
        ),
        array(
            'key' => 'field_salary',
            'label' => 'Salaire annuel brut (€)',
            'name' => 'salary',
            'type' => 'number',
            'prepend' => '€',
            'instructions' => 'Indiquez un montant annuel brut (ex : 35000)',
            'required' => 0,
        ),
                array(
            'key' => 'field_company_group',
            'label' => 'Informations entreprise',
            'name' => 'company',
            'type' => 'group',
            'sub_fields' => array(
                array(
                    'key' => 'field_company_name',
                    'label' => 'Nom de l’entreprise',
                    'name' => 'name',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_company_size',
                    'label' => 'Nombre de collaborateurs',
                    'name' => 'size',
                    'type' => 'number',
                ),
                array(
                    'key' => 'field_company_creation',
                    'label' => 'Date de création',
                    'name' => 'creation_date',
                    'type' => 'date_picker',
                    'display_format' => 'd/m/Y',
                    'return_format' => 'Y-m-d',
                ),
                array(
                    'key' => 'field_company_logo',
                    'label' => 'Logo de l\'entreprise',
                    'name' => 'logo_entreprise',
                    'type' => 'image',
                ),
            ),
        ),
        array(
            'key' => 'field_remote',
            'label' => 'Télétravail',
            'name' => 'remote',
            'type' => 'select',
            'choices' => array(
                'Oui' => 'Oui',
                'Non' => 'Non',
                'Partiel' => 'Partiel',
            ),
        ),
        array(
            'key' => 'field_experience_required',
            'label' => 'Expérience requise',
            'name' => 'experience_required',
            'type' => 'select',
            'choices' => array(
                '0-1 an' => '0-1 an',
                '1-3 ans' => '1-3 ans',
                '3-5 ans' => '3-5 ans',
                '5 ans et +' => '5 ans et +',
            ),
        ),
        array(
            'key' => 'field_education_level',
            'label' => 'Niveau d’études',
            'name' => 'education_level',
            'type' => 'select',
            'choices' => array(
                'Bac' => 'Bac',
                'Bac+2' => 'Bac+2',
                'Bac+3' => 'Bac+3',
                'Bac+5' => 'Bac+5',
                'Master+' => 'Master+',
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'job_offer',
            ),
        ),
    ),
));


// Champs pour les candidatures
acf_add_local_field_group(array(
    'key' => 'group_job_application',
    'title' => 'Candidature',
    'fields' => array(
        array(
            'key' => 'field_applicant_firstname',
            'label' => 'Prénom',
            'name' => 'first_name',
            'type' => 'text',
        ),
        array(
            'key' => 'field_applicant_lastname',
            'label' => 'Nom',
            'name' => 'last_name',
            'type' => 'text',
        ),
        array(
            'key' => 'field_applicant_email',
            'label' => 'Email',
            'name' => 'email',
            'type' => 'email',
        ),
        array(
            'key' => 'field_applicant_phone',
            'label' => 'Téléphone',
            'name' => 'phone',
            'type' => 'text',
        ),
        array(
            'key' => 'field_applicant_cv',
            'label' => 'CV',
            'name' => 'cv',
            'type' => 'file',
            'return_format' => 'url',
        ),
        array(
            'key' => 'field_applicant_message',
            'label' => 'Message / Motivation',
            'name' => 'message',
            'type' => 'textarea',
        ),
        array(
            'key' => 'field_related_job',
            'label' => 'Offre liée',
            'name' => 'related_job',
            'type' => 'post_object',
            'post_type' => array('job_offer'),
            'return_format' => 'id',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'job_application',
            ),
        ),
    ),
));
