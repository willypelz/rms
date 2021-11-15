<?php



return [
    'endpoint' => [
        'localhost' => [
            'host' => env('SOLR_HOST', '35.177.236.214'),
            'port' => env('SOLR_PORT', '8983'),
            'path' => env('SOLR_PATH', '/solr/'),
            'core' => env('SOLR_CORE', 'seamless')
        ]
    ]
];


