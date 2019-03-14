<?

namespace App\Modules\Pages\Controllers\Admin;

use Illuminate\Database\QueryException;
use Respect\Validation\Validator as v;
use App\Modules\Pages\Models\Page;
use App\Controllers\Controller;

class AdminPagesController extends Controller {

  public function __construct( $container ) {
    parent::__construct( $container );
    $this->view->setTemplatePath('app/Modules/Pages/views/');
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
      'name' => v::notEmpty(),
      'url' => v::notEmpty()->noWhitespace(),
    ]);

    if ($validation->failed()) {
      return $response->withRedirect($this->router->pathFor('admin.page.add'));
    }
    
    try {
      $element = Page::create([
        'name' => $request->getParam('name'),
        'url' => $request->getParam('url'),
        'art' => $request->getParam('art'),
        'text' => $request->getParam('text'),
        'title' => $request->getParam('title'),
        'description' => $request->getParam('description'),
        'keywords' => $request->getParam('keywords'),
      ]);
      
    } catch (QueryException $e) {
      $pos = strpos($e->getMessage(), "Duplicate entry");
      if ($pos !== false) {
        $message = 'Страница с такой ссылкой уже существует!';
      }

      $this->flash->addMessage('error', $message);
      return $response->withRedirect($this->router->pathFor('admin.page.add'));
    }

    return $response->withRedirect($this->router->pathFor('admin.page.edit', ['id' => $element->id]));
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
      'name' => v::notEmpty(),
      'url' => v::notEmpty()->noWhitespace(),
    ]);

    if ($validation->failed()) {
      return $response->withRedirect($this->router->pathFor('admin.page.edit', ['id' => $argument]));
    }
    
    try {
      Page::find($argument)
        ->update([
          'name' => $request->getParam('name'),
          'url' => $request->getParam('url'),
          'art' => $request->getParam('art'),
          'text' => $request->getParam('text'),
          'title' => $request->getParam('title'),
          'description' => $request->getParam('description'),
          'keywords' => $request->getParam('keywords'),
        ]);
        
    } catch (QueryException $e) {
      $pos = strpos($e->getMessage(), "Duplicate entry");
      if ($pos !== false) {
        $message = 'Страница с такой ссылкой уже существует!';
      }

      $this->flash->addMessage('error', $message);
    }

    return $response->withRedirect($this->router->pathFor('admin.page.edit', ['id' => $argument]));
  }



  public function postDelete( $request, $response ) {

    $id = $request->getParsedBody()['id'];
    Page::find($id)->delete();

    return $id;
  }

}
