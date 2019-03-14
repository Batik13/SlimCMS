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


// admin
$app->group('', function() use ( $mm ) {
	$this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
  $this->get('/admin', 'AdminController:home')->setName('admin.home');
  $this->get('/admin/settings', 'AdminController:getSettings')->setName('admin.settings');
  $this->post('/admin/settings', 'AdminController:postSettings');

  
  foreach ($mm->get() as $value) {
    $singularName = strtolower($value['config']->name);
    $dirName = strtolower($value['dirName']);

    $this->get('/admin/'.$dirName, $value['controller'].':home')->setName('admin.'.$dirName);
    $this->get('/admin/'.$singularName.'/add', $value['controller'].':getAdd')->setName('admin.'.$singularName.'.add');
    $this->post('/admin/'.$singularName.'/add', $value['controller'].':postAdd');
    $this->get('/admin/'.$singularName.'/settings', $value['controller'].':getSettings')->setName('admin.'.$singularName.'.settings');
    $this->post('/admin/'.$singularName.'/settings', $value['controller'].':postSettings');
    $this->get('/admin/'.$singularName.'/{id}', $value['controller'].':getEdit')->setName('admin.'.$singularName.'.edit');
    $this->post('/admin/'.$singularName.'/{id}', $value['controller'].':postEdit');
    $this->get('/admin/'.$singularName.'/delete/{id}', $value['controller'].':getDelete')->setName('admin.'.$singularName.'.delete');
    $this->post('/admin/'.$singularName.'/delete/{id}', $value['controller'].':postDelete');
  }


})->add(new AuthMiddleware($container));
