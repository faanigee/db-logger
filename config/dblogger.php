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
    'connection' => env('LOG_DB_CONNECTION', 'log_db'),

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
    'connections' => [
        'log_db' => [
            'driver' => 'mysql',
            'host' => env('LOG_DB_HOST', '127.0.0.1'),
            'port' => env('LOG_DB_PORT', '3306'),
            'database' => env('LOG_DB_DATABASE', 'logs_database'),
            'username' => env('LOG_DB_USERNAME', 'root'),
            'password' => env('LOG_DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
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
    'retention_days' => env('LOG_RETENTION_DAYS', 30),

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
];
