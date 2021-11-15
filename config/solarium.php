<?php



return [
    'endpoint' => [
        'localhost' => [
            'host' => getEnvData('SOLR_HOST', '35.177.236.214'),
            'port' => getEnvData('SOLR_PORT', '8983'),
            'path' => getEnvData('SOLR_PATH', '/solr/'),
            'core' => getEnvData('SOLR_CORE', 'seamless')
        ]
    ]
];


