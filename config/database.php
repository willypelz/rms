<?php
use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | PDO Fetch Style
    |--------------------------------------------------------------------------
    |
    | By default, database results will be returned as instances of the PHP
    | stdClass object; however, you may desire to retrieve records in an
    | array format for simplicity. Here you can tweak the fetch style.
    |
    */

    'fetch' => PDO::FETCH_CLASS,

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => getEnvData('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => database_path('database.sqlite'),
            'prefix'   => '',
        ],
        
        'mysql' => [
            'driver' => 'mysql',
            'read' => [
		        'host' => [getEnvData('DB_HOST_READ', '127.0.0.1')],
		    ],
		    'write' => [
		        'host' => [getEnvData('DB_HOST_WRITE', '127.0.0.1')],
		    ],
		    'sticky'    => true,
            'port' => getEnvData('DB_PORT', '3306'),
            'database' => getEnvData('DB_DATABASE', 'forge'),
            'username' => getEnvData('DB_USERNAME', 'forge'),
            'password' => getEnvData('DB_PASSWORD', ''),
            'unix_socket' => getEnvData('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
            'sslmode' => getEnvData('DB_SSLMODE', 'prefer'),
		    'options' => (getEnvData('MYSQL_SSL')) ? [
		        PDO::MYSQL_ATTR_SSL_KEY    => getEnvData('MYSQL_ATTR_SSL_KEY'), 
		    ] : [],
        ],

        'pgsql' => [
            'driver'   => 'pgsql',
            'host'     => getEnvData('DB_HOST', 'localhost'),
            'database' => getEnvData('DB_DATABASE', 'forge'),
            'username' => getEnvData('DB_USERNAME', 'forge'),
            'password' => getEnvData('DB_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
        ],

        'sqlsrv' => [
            'driver'   => 'sqlsrv',
            'host'     => getEnvData('DB_HOST', 'localhost'),
            'database' => getEnvData('DB_DATABASE', 'forge'),
            'username' => getEnvData('DB_USERNAME', 'forge'),
            'password' => getEnvData('DB_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */
    
    'redis' => [

        'client' => 'predis',
        'options'=>[
            'cluster' => getEnvData('REDIS_CLUSTER', 'predis'),
            'prefix' => Str::slug(getEnvData('APP_NAME', 'laravel'), '_').'_database_'.getEnvData('DB_DATABASE', 'forge'),
        ],

        'default' => [
            'host' => getEnvData('REDIS_HOST', '127.0.0.1'),
            'password' => getEnvData('REDIS_PASSWORD', null),
            'port' => getEnvData('REDIS_PORT', 6379),
            'database' => getEnvData('REDIS_DB', 0),
        ],
        
        'cache' => [
            'host' => getEnvData('REDIS_HOST', '127.0.0.1'),
            'password' =>  getEnvData('REDIS_PASSWORD', null),
            'port' => getEnvData('REDIS_PORT', 6379),
            'database' => getEnvData('REDIS_CACHE_DB', 1),
        ]

    ],
];
