<?php

return [

    'doc_path' => env('DOC_PATH', 'docs'),

    'template' => env('TEMPLATE', 'laravel'),

    'publish_path' => env('PUBLISH_PATH', 'public'),

    'default_version' => env('DEFAULT_VERSION'),

    'default_doc' => env('DEFAULT_DOC', 'installation'),

    'versions' => [
        '20.x' => '20.x',
        '10.x' => '10.x',
    ],

    'excludes' => [

    ]

];
