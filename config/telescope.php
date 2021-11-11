<?php

use Laravel\Telescope\Http\Middleware\Authorize;
use Laravel\Telescope\Watchers;

return [

    /*
    |--------------------------------------------------------------------------
    | Telescope Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where Telescope will be accessible from. If the
    | setting is null, Telescope will reside under the same domain as the
    | application. Otherwise, this value will be used as the subdomain.
    |
    */

    'domain' => getEnvData('TELESCOPE_DOMAIN', null),

    /*
    |--------------------------------------------------------------------------
    | Telescope Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Telescope will be accessible from. Feel free
    | to change this path to anything you like. Note that the URI will not
    | affect the paths of its internal API that aren't exposed to users.
    |
    */

    'path' => getEnvData('TELESCOPE_PATH', 'telescope'),

    /*
    |--------------------------------------------------------------------------
    | Telescope Storage Driver
    |--------------------------------------------------------------------------
    |
    | This configuration options determines the storage driver that will
    | be used to store Telescope's data. In addition, you may set any
    | custom options as needed by the particular driver you choose.
    |
    */

    'driver' => getEnvData('TELESCOPE_DRIVER', 'database'),

    'storage' => [
        'database' => [
            'connection' => getEnvData('DB_CONNECTION', 'mysql'),
            'chunk' => 1000,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Telescope Master Switch
    |--------------------------------------------------------------------------
    |
    | This option may be used to disable all Telescope watchers regardless
    | of their individual configuration, which simply provides a single
    | and convenient way to enable or disable Telescope data storage.
    |
    */

    'enabled' => false, //env('TELESCOPE_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Telescope Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every Telescope route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => [
        'web',
        Authorize::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Ignored Paths & Commands
    |--------------------------------------------------------------------------
    |
    | The following array lists the URI paths and Artisan commands that will
    | not be watched by Telescope. In addition to this list, some Laravel
    | commands, like migrations and queue commands, are always ignored.
    |
    */

    'ignore_paths' => [
        'nova-api*',
    ],

    'ignore_commands' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Telescope Watchers
    |--------------------------------------------------------------------------
    |
    | The following array lists the "watchers" that will be registered with
    | Telescope. The watchers gather the application's profile data when
    | a request or task is executed. Feel free to customize this list.
    |
    */

    'watchers' => [
        Watchers\CacheWatcher::class => getEnvData('TELESCOPE_CACHE_WATCHER', true),

        Watchers\CommandWatcher::class => [
            'enabled' => getEnvData('TELESCOPE_COMMAND_WATCHER', true),
            'ignore' => [],
        ],

        Watchers\DumpWatcher::class => getEnvData('TELESCOPE_DUMP_WATCHER', true),

        Watchers\EventWatcher::class => [
            'enabled' => getEnvData('TELESCOPE_EVENT_WATCHER', true),
            'ignore' => [],
        ],

        Watchers\ExceptionWatcher::class => getEnvData('TELESCOPE_EXCEPTION_WATCHER', true),
        Watchers\JobWatcher::class => getEnvData('TELESCOPE_JOB_WATCHER', true),
        Watchers\LogWatcher::class => getEnvData('TELESCOPE_LOG_WATCHER', true),
        Watchers\MailWatcher::class => getEnvData('TELESCOPE_MAIL_WATCHER', true),

        Watchers\ModelWatcher::class => [
            'enabled' => getEnvData('TELESCOPE_MODEL_WATCHER', true),
            'events' => ['eloquent.*'],
        ],

        Watchers\NotificationWatcher::class => getEnvData('TELESCOPE_NOTIFICATION_WATCHER', true),

        Watchers\QueryWatcher::class => [
            'enabled' => getEnvData('TELESCOPE_QUERY_WATCHER', true),
            'ignore_packages' => true,
            'slow' => 100,
        ],

        Watchers\RedisWatcher::class => getEnvData('TELESCOPE_REDIS_WATCHER', true),

        Watchers\RequestWatcher::class => [
            'enabled' => getEnvData('TELESCOPE_REQUEST_WATCHER', true),
            'size_limit' => getEnvData('TELESCOPE_RESPONSE_SIZE_LIMIT', 64),
        ],

        Watchers\GateWatcher::class => [
            'enabled' => getEnvData('TELESCOPE_GATE_WATCHER', true),
            'ignore_abilities' => [],
            'ignore_packages' => true,
        ],

        Watchers\ScheduleWatcher::class => getEnvData('TELESCOPE_SCHEDULE_WATCHER', true),

        Watchers\ViewWatcher::class => getEnvData('TELESCOPE_VIEW_WATCHER', true),
    ],
];
