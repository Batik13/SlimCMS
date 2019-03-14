<?

namespace App\Modules\Reviews\Controllers\Admin;

use App\Modules\Reviews\Models\Review;
use App\Modules\Options\Models\Option;
use Illuminate\Database\QueryException;
use App\Controllers\Controller;

class AdminReviewsController extends Controller {

  public function __construct( $container ) {
    parent::__construct( $container );
    $this->view->setTemplatePath('app/Modules/Reviews/views/');
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
      $element = Review::create([
        'img' => $request->getParam('img'),
        'name' => $request->getParam('name'),
        'post' => $request->getParam('post'),
        'title' => $request->getParam('title'),
        'text' => $request->getParam('text'),
      ]);
      
    } catch (QueryException $e) {

      $this->flash->addMessage('error', $e->getMessage());
      return $response->withRedirect($this->router->pathFor('admin.review.add'));
    }

    return $response->withRedirect($this->router->pathFor('admin.review.edit', ['id' => $element->id]));
  }




  public function getEdit( $request, $response ) {
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    return $this->view->render($response, 'inner.phtml', ['data' => $data]);
  }

  public function postEdit( $request, $response ) {
    $route = $request->getAttribute('route');
    $argument = $route->getArguments()['id'];

    try {
      Review::find($argument)
        ->update([
          'img' => $request->getParam('img'),
          'name' => $request->getParam('name'),
          'post' => $request->getParam('post'),
          'title' => $request->getParam('title'),
          'text' => $request->getParam('text'),
        ]);
        
    } catch (QueryException $e) {
      $this->flash->addMessage('error', $e->getMessage());
    }

    return $response->withRedirect($this->router->pathFor('admin.review.edit', ['id' => $argument]));
  }



  public function postDelete( $request, $response ) {

    $id = $request->getParsedBody()['id'];
    Review::find($id)->delete();

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

    return $response->withRedirect($this->router->pathFor('admin.review.settings'));
  }

}
