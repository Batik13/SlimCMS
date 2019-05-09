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
        'publish' => htmlspecialchars($request->getParam('publish')),
        'name' => htmlspecialchars($request->getParam('name')),
        'sort' => htmlspecialchars($request->getParam('sort')),
        'url' => htmlspecialchars($request->getParam('url')),
        'art' => htmlspecialchars($request->getParam('art')),
        'text' => htmlspecialchars($request->getParam('text')),
        'title' => htmlspecialchars($request->getParam('title')),
        'description' => htmlspecialchars($request->getParam('description')),
        'keywords' => htmlspecialchars($request->getParam('keywords')),
        'min_text' => htmlspecialchars($request->getParam('min_text')),
        'seo_title' => htmlspecialchars($request->getParam('seo_title')),
        'seo_text' => htmlspecialchars($request->getParam('seo_text')),
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
    $route = $request->getAttribute('route');
    $slug = $route->getArguments()['id'];
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    $data->slug = $slug;
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
          'publish' => htmlspecialchars($request->getParam('publish')),
          'name' => htmlspecialchars($request->getParam('name')),
          'sort' => htmlspecialchars($request->getParam('sort')),
          'url' => htmlspecialchars($request->getParam('url')),
          'art' => htmlspecialchars($request->getParam('art')),
          'text' => htmlspecialchars($request->getParam('text')),
          'title' => htmlspecialchars($request->getParam('title')),
          'description' => htmlspecialchars($request->getParam('description')),
          'keywords' => htmlspecialchars($request->getParam('keywords')),
          'min_text' => htmlspecialchars($request->getParam('min_text')),
          'seo_title' => htmlspecialchars($request->getParam('seo_title')),
          'seo_text' => htmlspecialchars($request->getParam('seo_text')),
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


  public function getSettings( $request, $response ) {
    $route = $request->getAttribute('route');
    $slug = $route->getArguments()['id'];
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    $data->slug = $slug;

    return $this->view->render($response, 'settings.phtml', ['data' => $data]);
  }

  public function postSettings( $request, $response ) {
    try {
      Option::updateDynamicField($request);
    }
    catch (QueryException $e) {
      $this->flash->addMessage('error', $e->getMessage());
    }

    return $response->withRedirect($this->router->pathFor('admin.page.settings'));
  }

}
