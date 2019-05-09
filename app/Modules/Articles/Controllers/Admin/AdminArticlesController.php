<?

namespace App\Modules\Articles\Controllers\Admin;

use App\Modules\Articles\Models\Article;
use App\Modules\Options\Models\Option;
use Illuminate\Database\QueryException;
use App\Controllers\Controller;

class AdminArticlesController extends Controller {

  public function __construct( $container ) {
    parent::__construct( $container );
    $this->view->setTemplatePath('app/Modules/Articles/views/');
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
        
    try {
      $element = Article::create([
        'publish' => htmlspecialchars($request->getParam('publish')),
        'name' => htmlspecialchars($request->getParam('name')),
        'href' => htmlspecialchars($request->getParam('href')),
        'date' => htmlspecialchars($request->getParam('date')),
        'text' => htmlspecialchars($request->getParam('text')),
        'min_text' => htmlspecialchars($request->getParam('min_text')),
        'art' => htmlspecialchars($request->getParam('art')),
        'art_href' => htmlspecialchars($request->getParam('art_href')),
        'img' => htmlspecialchars($request->getParam('img')),
        'thumb' => htmlspecialchars($request->getParam('thumb')),
        'label' => htmlspecialchars($request->getParam('label')),
        'title' => htmlspecialchars($request->getParam('title')),
        'description' => htmlspecialchars($request->getParam('description')),
        'keywords' => htmlspecialchars($request->getParam('keywords')),
      ]);
      
    } catch (QueryException $e) {

      $this->flash->addMessage('error', $e->getMessage());
      return $response->withRedirect($this->router->pathFor('admin.article.add'));
    }

    return $response->withRedirect($this->router->pathFor('admin.article.edit', ['id' => $element->id]));
  }




  public function getEdit( $request, $response ) {
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    return $this->view->render($response, 'inner.phtml', ['data' => $data]);
  }

  public function postEdit( $request, $response ) {
    $route = $request->getAttribute('route');
    $argument = $route->getArguments()['id'];

    try {
      Article::find($argument)
        ->update([
          'publish' => htmlspecialchars($request->getParam('publish')),
          'name' => htmlspecialchars($request->getParam('name')),
          'href' => htmlspecialchars($request->getParam('href')),
          'date' => htmlspecialchars($request->getParam('date')),
          'text' => htmlspecialchars($request->getParam('text')),
          'min_text' => htmlspecialchars($request->getParam('min_text')),
          'art' => htmlspecialchars($request->getParam('art')),
          'art_href' => htmlspecialchars($request->getParam('art_href')),
          'img' => htmlspecialchars($request->getParam('img')),
          'thumb' => htmlspecialchars($request->getParam('thumb')),
          'label' => htmlspecialchars($request->getParam('label')),
          'title' => htmlspecialchars($request->getParam('title')),
          'description' => htmlspecialchars($request->getParam('description')),
          'keywords' => htmlspecialchars($request->getParam('keywords')),
        ]);
        
    } catch (QueryException $e) {
      $this->flash->addMessage('error', $e->getMessage());
    }

    return $response->withRedirect($this->router->pathFor('admin.article.edit', ['id' => $argument]));
  }



  public function postDelete( $request, $response ) {

    $id = $request->getParsedBody()['id'];
    Article::find($id)->delete();

    return $id;
  }



  public function getSettings( $request, $response ) {
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    return $this->view->render($response, 'settings.phtml', ['data' => $data]);
  }

  public function postSettings( $request, $response ) {
    try {
      Option::updateDynamicField($request);
    }
    catch (QueryException $e) {
      $this->flash->addMessage('error', $e->getMessage());
    }

    return $response->withRedirect($this->router->pathFor('admin.article.settings'));
  }

}
