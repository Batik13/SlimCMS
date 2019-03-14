<?

namespace App\Modules\Options\Controllers\Admin;

use Illuminate\Database\QueryException;
use Respect\Validation\Validator as v;
use App\Modules\Options\Models\Option;
use App\Controllers\Controller;

class AdminOptionsController extends Controller {

  public function __construct( $container ) {
    parent::__construct( $container );
    $this->view->setTemplatePath('app/Modules/Options/views/');
  }

  public function home( $request, $response ) {
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    return $this->view->render($response, 'home.phtml', ['data' => $data]);
  }


  public function getAdd( $request, $response ) {
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    return $this->view->render($response, 'inner.phtml', ['data' => $data]);
  }

  public function postAdd( $request, $response ) {
    $message;

    $validation = $this->validator->validate( $request, [
      'namespace' => v::notEmpty(),
      'tab' => v::notEmpty(),
      'name' => v::notEmpty(),
      'description' => v::notEmpty(),
      'type' => v::notEmpty(),
      'code' => v::notEmpty(),
    ]);

    if ($validation->failed()) {
      return $response->withRedirect($this->router->pathFor('admin.option.add'));
    }
    
    try {
      $element = Option::create([
        'namespace' => $request->getParam('namespace'),
        'tab' => $request->getParam('tab'),
        'name' => $request->getParam('name'),
        'description' => $request->getParam('description'),
        'value' => $request->getParam('value'),
        'type' => $request->getParam('type'),
        'code' => $request->getParam('code'),
        'values' => $request->getParam('values'),
      ]);
      
    } catch (QueryException $e) {
      $pos = strpos($e->getMessage(), "Duplicate entry");
      if ($pos !== false) {
        $message = 'Страница с такой ссылкой уже существует!';
      }

      $this->flash->addMessage('error', $message);
      return $response->withRedirect($this->router->pathFor('admin.option.add'));
    }

    return $response->withRedirect($this->router->pathFor('admin.option.edit', ['id' => $element->id]));
  }




  public function getEdit( $request, $response ) {
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    return $this->view->render($response, 'inner.phtml', ['data' => $data]);
  }

  public function postEdit( $request, $response ) {
    $message;
    $route = $request->getAttribute('route');
    $argument = $route->getArguments()['id'];

    $validation = $this->validator->validate( $request, [
      'namespace' => v::notEmpty(),
      'tab' => v::notEmpty(),
      'name' => v::notEmpty(),
      'description' => v::notEmpty(),
      'type' => v::notEmpty(),
      'code' => v::notEmpty(),
    ]);

    if ($validation->failed()) {
      return $response->withRedirect($this->router->pathFor('admin.option.edit', ['id' => $argument]));
    }
    
    try {
      Option::find($argument)
        ->update([
          'namespace' => $request->getParam('namespace'),
          'tab' => $request->getParam('tab'),
          'name' => $request->getParam('name'),
          'description' => $request->getParam('description'),
          'value' => $request->getParam('value'),
          'type' => $request->getParam('type'),
          'code' => $request->getParam('code'),
          'values' => $request->getParam('values'),
        ]);
        
    } catch (QueryException $e) {
      $pos = strpos($e->getMessage(), "Duplicate entry");
      if ($pos !== false) {
        $message = 'Страница с такой ссылкой уже существует!';
      }

      $this->flash->addMessage('error', $message);
    }

    return $response->withRedirect($this->router->pathFor('admin.option.edit', ['id' => $argument]));
  }



  public function postDelete( $request, $response ) {

    $id = $request->getParsedBody()['id'];
    Option::find($id)->delete();

    return $id;
  }

}
