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
    'session' => [
        'save' => 'files'
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
    ]
];
