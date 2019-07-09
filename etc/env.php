<?php
return [
    'backend' => [
        'frontName' => 'admin'
    ],
    'crypt' => [
        'key' => 'd9fda1d35703d59d9b12680fb500a97f'
    ],
    'db' => [
        'table_prefix' => 'pref_',
        'connection' => [
            'default' => [
                'host' => 'm57.sty',
                'dbname' => 'student2_mg232ce',
                'username' => 'student2',
                'password' => 'iepox5Ey',
                'active' => '1'
            ]
        ]
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'developer',
    'session' => [
        'save' => 'files'
    ],
    'cache' => [
        'frontend' => [
            'default' => [
                'id_prefix' => '809_'
            ],
            'page_cache' => [
                'id_prefix' => '809_'
            ]
        ]
    ],
    'lock' => [
        'provider' => 'db',
        'config' => [
            'prefix' => NULL
        ]
    ],
    'cache_types' => [
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'compiled_config' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'full_page' => 1,
        'config_webservice' => 1,
        'translate' => 1,
        'vertex' => 1
    ],
    'install' => [
        'date' => 'Wed, 26 Jun 2019 07:10:30 +0000'
    ]
];
