<?php 

return [
    'transport' => [
        'dsn'           => env('ENQUEUE_DSN', 'amqp://guest:guest@rabbitmq:5672/%2f'),   // Thay đổi nếu có user/pass khác
        'queue'         => env('RABBITMQ_QUEUE', 'email_queue'),                             // Tên queue mặc định
        'exchange'      => 'app.exchange',                        // Tên exchange
        'exchange_type' => 'direct',                              // Kiểu exchange: direct, fanout, topic,...
        'routing_key'   => 'app.routing',                         // Routing key mặc định
    ]
];
