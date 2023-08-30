<?php

return [
    'app' => [
        'site_title' => 'SITE_TITLE',
        'base_dir' => __DIR__ . '/../../',
        'site_url' => '',
        'base_url' => '',
        'templates_dir' => __DIR__ . '/../../frontend/templates/',
        'pages_dir' => __DIR__ . '/../../frontend/pages/'
    ],
    'database' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'DB_NAME',
        'port' => 3306
    ],
    'disk' => [],
    'roles' => [
        [
            'name' => 'PUBLIC',
            'value' => 'PUBLIC',
            'template' => 'public'
        ],[
            'name' => 'SUPER_ADMIN',
            'value' => 'SUPER_ADMIN',
            'template' => 'super-admin'
        ]
    ]
];
