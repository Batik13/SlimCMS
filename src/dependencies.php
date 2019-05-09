<?
use App\Modules\ModuleManager;
$mm = new ModuleManager();

$container = $app->getContainer();

$container['f'] = function( $container ) {
  return new App\Functions\Functions( $container );
};

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();


$container['db'] = function( $container ) use ($capsule) {
  return $capsule;
};

$container['auth'] = function( $container ) {
  return new \App\Auth\Auth;
};

$container['pagination'] = function( $container ) {
  return new \App\Pagination\Pagination;
};

$container['flash'] = function($container) {
  return new \Slim\Flash\Messages;
};

$container['path'] = function( $container ) {
  $pathList = $container->get('settings')['path'];
  $pathList["root"] = $container->f->request_url();
  return $pathList;
};

$container['view'] = function( $container ) {
  $view = new Slim\Views\PhpRenderer($container->path['view']);

  $view->addAttribute('auth', [
    'check' => $container->auth->check(),
    'user' => $container->auth->user(),
  ]);

  $view->addAttribute('flash', $container->flash);

  return $view;
};

$container['HomeController'] = function( $container ) {
  return new \App\Controllers\HomeController($container);
};

$container['AuthController'] = function( $container ) {
  return new \App\Controllers\Auth\AuthController($container);
};

$container['validator'] = function( $container ) {
  return new App\Validation\Validator;
};

$container['csrf'] = function( $container ) {
  return new \Slim\Csrf\Guard;
};

$container['plugin'] = function( $container ) {
  return new App\Plugins\ManagerPlugin( $container );
};

$container['breadcrumbs'] = function( $container ) {
  return new App\Breadcrumbs\Breadcrumbs;
};

$container['element'] = function( $container ) {
  return new App\Functions\Element;
};

$container['mm'] = function( $container ) {
  return new App\Modules\ModuleManager;
};

$container['AdminBuilder'] = function( $container ) {
  return new App\Design\AdminBuilder;
};

$container['PublicBuilder'] = function( $container ) {
  return new App\Design\PublicBuilder;
};

// admin
$container['AdminController'] = function( $container ) {  
  return new \App\Controllers\Admin\AdminController($container);
};

$container['notFoundHandler'] = function ( $container ) {
  return function ($request, $response) use ( $container ) {
    $data = (object) ['app' => $container, 'request' => $request, 'response' => $response];

    $url_404 = $container->router->pathFor('page', ['slug' => '404']);
    return $response->withRedirect( $url_404 );
  };
};


foreach ($mm->get() as $value) {
  $container[$value['adminController']] = function( $container ) use ($value) {
    $controllerClassName = '\App\Modules\\'.$value['dirName'].'\Controllers\Admin\\'.$value['adminController'];
    return new $controllerClassName($container);
  };

  $container[$value['siteController']] = function( $container ) use ($value) {
    $controllerClassName = '\App\Modules\\'.$value['dirName'].'\Controllers\Site\\'.$value['siteController'];
    return new $controllerClassName($container);
  };
}


$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);
