<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------------------------------------------------
    |
    | Laravel's queue API supports an assortment of back-ends via a single
    | API, giving you convenient access to each back-end using the same
    | syntax for every one. Here you may define a default connection.
    |
    */

    'default' => env('QUEUE_CONNECTION', 'sync'),

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection information for each server that
    | is used by your application. A default configuration has been added
    | for each back-end shipped with Laravel. You are free to add more.
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis", "null"
    |
    */

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver'       => 'database',
            'table'        => 'jobs',
            'queue'        => 'default',
            'retry_after'  => 90,
            'after_commit' => false,
        ],

        'beanstalkd' => [
            'driver'       => 'beanstalkd',
            'host'         => 'localhost',
            'queue'        => 'default',
            'retry_after'  => 90,
            'block_for'    => 0,
            'after_commit' => false,
        ],

        'sqs' => [
            'driver'       => 'sqs',
            'key'          => env('AWS_ACCESS_KEY_ID'),
            'secret'       => env('AWS_SECRET_ACCESS_KEY'),
            'prefix'       => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue'        => env('SQS_QUEUE', 'default'),
            'suffix'       => env('SQS_SUFFIX'),
            'region'       => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'after_commit' => false,
        ],

        'redis' => [
            'driver'       => 'redis',
            'connection'   => 'default',
            'queue'        => env('REDIS_QUEUE', 'default'),
            'retry_after'  => 90,
            'block_for'    => null,
            'after_commit' => false,
        ],

        'rabbitmq' => [
            'driver'   => 'rabbitmq',
            'host'     => env('RABBITMQ_HOST', 'rabbitmq'),
            'port'     => env('RABBITMQ_PORT', 5672),
            'vhost'    => env('RABBITMQ_VHOST', '/'),
            'login'    => env('RABBITMQ_LOGIN', 'guest'),
            'password' => env('RABBITMQ_PASSWORD', 'guest'),
            'options'  => [
                'exchange' => [
                    // Exchange 1: Orders
                    'orders' => [
                        'name'        => env('RABBITMQ_EXCHANGE_ORDERS_NAME', 'orders_exchange'),
                        'type'        => env('RABBITMQ_EXCHANGE_ORDERS_TYPE', 'direct'),
                        'declare'     => env('RABBITMQ_EXCHANGE_ORDERS_DECLARE', true),
                        'durable'     => env('RABBITMQ_EXCHANGE_ORDERS_DURABLE', true),
                        'auto_delete' => env('RABBITMQ_EXCHANGE_ORDERS_AUTODELETE', false),
                    ],
                    // Exchange 2: Notifications
                    'notifications' => [
                        'name'        => env('RABBITMQ_EXCHANGE_NOTIFICATIONS_NAME', 'notifications_exchange'),
                        'type'        => env('RABBITMQ_EXCHANGE_NOTIFICATIONS_TYPE', 'topic'),
                        'declare'     => env('RABBITMQ_EXCHANGE_NOTIFICATIONS_DECLARE', true),
                        'durable'     => env('RABBITMQ_EXCHANGE_NOTIFICATIONS_DURABLE', true),
                        'auto_delete' => env('RABBITMQ_EXCHANGE_NOTIFICATIONS_AUTODELETE', false),
                    ],
                    // Exchange 3: Emails
                    'emails' => [
                        'name'        => env('RABBITMQ_EXCHANGE_EMAILS_NAME', 'emails_exchange'),
                        'type'        => env('RABBITMQ_EXCHANGE_EMAILS_TYPE', 'fanout'),
                        'declare'     => env('RABBITMQ_EXCHANGE_EMAILS_DECLARE', true),
                        'durable'     => env('RABBITMQ_EXCHANGE_EMAILS_DURABLE', true),
                        'auto_delete' => env('RABBITMQ_EXCHANGE_EMAILS_AUTODELETE', false),
                    ],
                ],
                'queue' => [
                    // Queue 1: Orders Queue
                    'orders' => [
                        'name'        => env('RABBITMQ_QUEUE_ORDERS_NAME', 'order_queue'),
                        'binding_key' => env('RABBITMQ_QUEUE_ORDERS_BINDING_KEY', 'order.process'),
                    ],
                    // Queue 2: Notifications Queue
                    'notifications' => [
                        'name'        => env('RABBITMQ_QUEUE_NOTIFICATIONS_NAME', 'notification_queue'),
                        'binding_key' => env('RABBITMQ_QUEUE_NOTIFICATIONS_BINDING_KEY', 'notification.*'),
                    ],
                    // Queue 3: Emails Queue
                    'emails' => [
                        'name'        => env('RABBITMQ_QUEUE_EMAILS_NAME', 'email_queue'),
                        'binding_key' => env('RABBITMQ_QUEUE_EMAILS_BINDING_KEY', 'email.send'),
                    ],
                ],
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Failed Queue Jobs
    |--------------------------------------------------------------------------
    |
    | These options configure the behavior of failed queue job logging so you
    | can control which database and table are used to store the jobs that
    | have failed. You may change them to any database / table you wish.
    |
    */

    'failed' => [
        'driver'   => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'mysql'),
        'table'    => 'failed_jobs',
    ],

];
