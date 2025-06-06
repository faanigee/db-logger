<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Logging Database Connection
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below should be used
    | for logging. This allows logs to be stored in a separate database from
    | your application database.
    |
    */
    'connection' => env('DB_LOGGER_CONNECTION', 'log_db'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are the database connections used by your application. The 'log_db'
    | connection is specifically for storing logs separate from your main
    | application database.
    |
    */

    'log_db' => [
        'driver' => 'mysql',
        'host' => env('DB_LOGGER_HOST', env('DB_HOST', '127.0.0.1')),
        'port' => env('DB_LOGGER_PORT', env('DB_PORT', '3306')),
        'database' => env('DB_LOGGER_DATABASE', env('DB_DATABASE', 'logging_db')),
        'username' => env('DB_LOGGER_USERNAME', env('DB_USERNAME', 'root')),
        'password' => env('DB_LOGGER_PASSWORD', env('DB_PASSWORD', '')),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => null,
    ],


    /*
    |--------------------------------------------------------------------------
    | Log Retention Policy
    |--------------------------------------------------------------------------
    |
    | Define how long logs should be kept in the database. Logs older than this
    | period will be automatically cleaned up by the package.
    |
    */
    'retention' => [
        'days' => env('DB_LOGGER_RETENTION_DAYS', 90),
        'levels' => [
            'emergency' => 365,
            'alert' => 180,
            'critical' => 180,
            'error' => 90,
            'warning' => 60,
            'notice' => 30,
            'info' => 30,
            'debug' => 15,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Level
    |--------------------------------------------------------------------------
    |
    | This option controls the minimum "level" that will be logged by this logger.
    | This allows you to control which logs are stored in the database vs which
    | are ignored. Options: debug, info, notice, warning, error, critical, alert, emergency
    |
    */
    'level' => env('LOG_LEVEL', 'debug'),

    /*
    |--------------------------------------------------------------------------
    | Log queue
    |--------------------------------------------------------------------------
    
    */
    'queue' => [
        'enabled' => env('DB_LOGGER_QUEUE_ENABLED', false),
        'connection' => env('DB_LOGGER_QUEUE_CONNECTION', 'redis'),
        'queue' => env('DB_LOGGER_QUEUE_NAME', 'logs'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Log batch
    |--------------------------------------------------------------------------
    
    */

    'batch' => [
        'size' => env('DB_LOGGER_BATCH_SIZE', 100),
        'timeout' => env('DB_LOGGER_BATCH_TIMEOUT', 30),
    ],

    /*
    |--------------------------------------------------------------------------
    | Log batch
    |--------------------------------------------------------------------------
    | Two Option Available for frest dark, light
    */
    'myStyle' => env('DB_LOGGER_STYLE', 'light'),

    /*
    |--------------------------------------------------------------------------
    | UI Settings
    |--------------------------------------------------------------------------
    |
    | Configuration for the user interface of the logger.
    |
    */
    'enable_filters' => env('DB_LOGGER_ENABLE_FILTERS', true),
    'per_page' => env('DB_LOGGER_PER_PAGE', 100),
    'date_format' => env('DB_LOGGER_DATE_FORMAT', 'Y-m-d H:i:s'),
    'dark_mode' => env('DB_LOGGER_DARK_MODE', false),
];
