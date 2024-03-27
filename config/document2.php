<?php

return [

    'doc_path' => env('DOC_PATH', getcwd().DIRECTORY_SEPARATOR.'docs'),

    'publish_path' => env('PUBLISH_PATH', getcwd().DIRECTORY_SEPARATOR.'public'),

    'default_version' => env('DEFAULT_VERSION'),

    'default_doc' => env('DEFAULT_DOC', 'installation'),

    'versions' => [],

];
