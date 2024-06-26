<?php

return [

    /**
     * Specify the path for the markdown documentation.
     */
    'doc_path' => env('DOC_PATH', 'docs'),

    /**
     * Specify the template name for generating HTML files. View all files within the `templates` folder.
     */
    'template' => env('TEMPLATE', 'laravel'),

    /**
     * Specify the template name for generating HTML files. View all files within the `templates` folder.
     */
    'template_path' => env('TEMPLATE_PATH', 'templates'),

    /**
     * Specify the folder where HTML files will be generated.
     */
    'publish_path' => env('PUBLISH_PATH', 'public'),

    /**
     * Specify the default version of the documentation. This version will be displayed when the root domain is visited.
     */
    'default_version' => env('DEFAULT_VERSION'),

    /**
     * Specify the default documentation. This documentation will be displayed when the root documentation path is visited.
     */
    'default_doc' => env('DEFAULT_DOC', 'installation.md'),

    /**
     * Specify all documentation versions. These must exactly match the Git branch names.
     */
    'versions' => array_map('trim', explode(',', env('DOC_VERSIONS'))),

    /**
     * Specify all files not to be copied and published, such as `.gitignore` or configuration files.
     */
    'excludes' => array_map('trim', explode(',', env('EXCLUDES_FILES'))),

    /**
     * Set the app url for document root.
     */
    'app_url' => env('APP_URL', 'https://document2.test'),

    /**
     * Set the original domain link to another website, such as `/api/master`, rather than a documentation.
     */
    'original_url' => env('ORIGINAL_URL', 'https://www.laravel.com'),
];
