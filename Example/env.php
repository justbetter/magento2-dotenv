<?php
return [
    'backend' => [
        'frontName' => $_ENV['BACKEND_NAME']
    ],
    'crypt' => [
        'key' => $_ENV['CRYPT_KEY']
    ],
    'db' => [
        'table_prefix' => $_ENV['DB_TABLE_PREFIX'],
        'connection' => [
            'default' => [
                'unix_socket' => $_ENV['DB_SOCKET'],
                'host' => $_ENV['DB_PORT'] ? $_ENV['DB_HOST'].':'.$_ENV['DB_PORT'] : $_ENV['DB_HOST'],
                'dbname' => $_ENV['DB_DATABASE'],
                'username' => $_ENV['DB_USERNAME'],
                'password' => $_ENV['DB_PASSWORD'],
                'model' => 'mysql4',
                'engine' => 'innodb',
                'initStatements' => 'SET NAMES utf8;',
                'active' => '1',
                'profiler' => [
                    'class' => 'Magento\\Framework\\DB\\Profiler',
                    'enabled' => $_ENV['DB_DEBUG']
                ]
            ]
        ]
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => $_ENV['MAGE_MODE'],
    'deployment' => [
        'blue_green' => [
            'enabled' => $_ENV['BLUE_GREEN_DEPLOYMEMT'] ?? $_ENV['APP_ENV'] === 'production',
        ]
    ],
    'session' => [
        // possible: files, redis, db, memcache
        'save' => $_ENV['SESSION_DRIVER'] ?? 'files',
        'save_path' => $_ENV['SESSION_SAVE_PATH'] ?? null,
        'db_connection' => $_ENV['SESSION_DATABASE_CONNECTION'] ?? 'default',
        'table' => $_ENV['SESSION_DATABASE_TABLE'] ?? 'session',
        'gc_probability' => 1,
        'gc_divisor' => 10000,
        'gc_maxlifetime' => 1440,
        'redis' => [
            'host' => $_ENV['REDIS_SESSION_HOST'] ?? '127.0.0.1',
            'port' => $_ENV['REDIS_SESSION_PORT'] ?? '6379',
            'server' => $_ENV['REDIS_SESSION_SERVER'] ?? null,
            'timeout' => $_ENV['REDIS_SESSION_TIMEOUT'] ?? '2.5',
            'persistent_identifier' => '',
            'database' => $_ENV['REDIS_SESSION_DATABASE'] ?? '0',
            'compression_threshold' => '2048',
            'compression_library' => 'gzip',
            'log_level' => '1',
            'max_concurrency' => $_ENV['REDIS_SESSION_MAX_CONCURRENCY'] ?? '18',
            'break_after_frontend' => '5',
            'break_after_adminhtml' => '30',
            'first_lifetime' => '600',
            'bot_first_lifetime' => '60',
            'bot_lifetime' => '7200',
            'disable_locking' => $_ENV['REDIS_SESSION_DISABLE_LOCKING'] ?? '0',
            'min_lifetime' => '60',
            'max_lifetime' => '2592000'
        ],
    ],
    'cache_types' => [
        'config' => 1,
        'layout' => $_ENV['APP_ENV'] === 'production',
        'block_html' => $_ENV['APP_ENV'] === 'production',
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'full_page' => $_ENV['APP_ENV'] === 'production',
        'config_webservice' => 1,
        'translate' => 1,
        'compiled_config' => 1,
        'amasty_shopby' => 1,
        'ec_cache' => 1,
        'vertex' => 1,
        'google_product' => 1
    ],
    'install' => [
        'date' => 'Fri, 4 Sept 2020 12:00:00 +0000'
    ],
    'db_logger' => [
        'output' => $_ENV['DB_LOGGER'] ? 'enabled' : 'disabled',
        'log_everything' => 1,
        'query_time_threshold' => '0.001',
        'include_stacktrace' => 1
    ],
    'queue' => [
        'consumers_wait_for_messages' => $_ENV['QUEUE_CONSUMERS_WAIT_FOR_MESSAGES'] ?? 0,
    ],
    'graphql' => [
        'disable_introspection' => $_ENV['APP_ENV'] === 'production',
    ],
];
