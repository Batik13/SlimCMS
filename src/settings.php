<?

return [
  'settings' => [

    // set to false in production
    'displayErrorDetails' => true,

    // Allow the web server to send the content-length header
    'addContentLengthHeader' => false,

    'determineRouteBeforeAppMiddleware' => true,

    'extension' => '.html',

    'path' => [
      'view' => 'resources/views/',
      'plugins' => 'resources/plugins/',
    ],

    'public' => [
      'template' => 'templateName'
    ],

    'db' => [
      'driver' => 'mysql',
      'host' => 'localhost',
      'database' => 'slimcms',
      'username' => 'mysql',
      'password' => 'mysql',
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
    ],

    'plugins' => [
      'datatables' => [
        'public' => '',
        'admin' => 'all',
      ],
      'summernote' => [
        'public' => '',
        'admin' => 'all',
      ],
      'jqueryui' => [
        'public' => 'all',
        'admin' => '',
      ],
      'codemirror' => [
        'public' => '',
        'admin' => 'all'
      ]
    ],
  ],
];
