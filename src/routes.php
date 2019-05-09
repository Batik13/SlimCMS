<?

use App\Middleware\AuthMiddleware;
use App\Modules\ModuleManager;
$mm = new ModuleManager();

$EXT = $settings['settings']['extension'];

// public
$app->get('/', 'HomeController:index')->setName('home');
$app->get('/ajax', 'HomeController:ajax')->setName('ajax');
$app->post('/ajax', 'HomeController:ajax');
$app->get('/{slug}'.$EXT, 'HomeController:page')->setName('page');

$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
$app->post('/auth/signup', 'AuthController:postSignUp');

$app->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
$app->post('/auth/signin', 'AuthController:postSignIn');

// routes modules site
foreach ($mm->get() as $value) {
  $singularName = strtolower($value['config']->name);
  $dirName = strtolower($value['dirName']);

  if ($value['config']->site) {
    $app->get('/'.$dirName.'/ajax/', $value['siteController'].':ajax')->setName($singularName.'.ajax');
    $app->get('/'.$dirName.'/search'.$EXT, $value['siteController'].':search')->setName($singularName.'.search');
    $app->get('/'.$dirName.'/{slug}'.$EXT, $value['siteController'].':inner')->setName($singularName);
    $app->get('/'.$dirName.'/page/{slug}'.$EXT, $value['siteController'].':pagination')->setName($singularName.'.pagination');
    $app->get('/'.$dirName.'/category/{category}'.$EXT, $value['siteController'].':category')->setName($singularName.'.category');
    $app->get('/'.$dirName.'/search/page/{slug}'.$EXT, $value['siteController'].':search')->setName($singularName.'.search.pagination');
    $app->get('/'.$dirName.'/{category}/{slug}'.$EXT, $value['siteController'].':product')->setName($singularName.'.product');
    $app->get('/'.$dirName.'/category/{category}/page/{slug}'.$EXT, $value['siteController'].':category')->setName($singularName.'.category.pagination');
  }
}


// admin
$app->group('', function() use ( $mm ) {
	$this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
  $this->get('/admin', 'AdminController:home')->setName('admin.home');
  $this->get('/admin/settings', 'AdminController:getSettings')->setName('admin.settings');
  $this->post('/admin/settings', 'AdminController:postSettings');

  // routes modules admin
  foreach ($mm->get() as $value) {
    $singularName = strtolower($value['config']->name);
    $dirName = strtolower($value['dirName']);

    $this->get('/admin/'.$dirName, $value['adminController'].':home')->setName('admin.'.$dirName);
    $this->get('/admin/'.$singularName.'/add', $value['adminController'].':getAdd')->setName('admin.'.$singularName.'.add');
    $this->post('/admin/'.$singularName.'/add', $value['adminController'].':postAdd');
    $this->get('/admin/'.$singularName.'/settings', $value['adminController'].':getSettings')->setName('admin.'.$singularName.'.settings');
    $this->post('/admin/'.$singularName.'/settings', $value['adminController'].':postSettings');
    $this->get('/admin/'.$singularName.'/{id}', $value['adminController'].':getEdit')->setName('admin.'.$singularName.'.edit');
    $this->post('/admin/'.$singularName.'/{id}', $value['adminController'].':postEdit');
    $this->get('/admin/'.$singularName.'/delete/{id}', $value['adminController'].':getDelete')->setName('admin.'.$singularName.'.delete');
    $this->post('/admin/'.$singularName.'/delete/{id}', $value['adminController'].':postDelete');
  }

})->add(new AuthMiddleware($container));
