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
      'template' => 'tempName'
    ],

    'db' => [
      'driver' => 'mysql',
      'host' => 'localhost',
      'database' => 'dbName',
      'username' => 'mysql',
      'password' => 'mysql',
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => ''
    ],

    'plugins' => [
      'jquery' => [
        'public' => 'all',
        'admin' => '',
      ],
      'jquery.form' => [
        'public' => 'all',
        'admin' => '',
      ],
      'siteDatatables' => [
        'public' => 'all',
        'admin' => '',
      ],
      'adminDatatables' => [
        'public' => '',
        'admin' => 'all',
      ],
      'summernote' => [
        'public' => '',
        'admin' => 'all',
      ],      
      'codemirror' => [
        'public' => '',
        'admin' => 'all'
      ]
    ],
  ],
];
