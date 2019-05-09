<?

namespace App\Modules\Shorts\Controllers\Admin;

use Illuminate\Database\QueryException;
use App\Modules\Shorts\Models\Short;
use App\Controllers\Controller;

class AdminShortsController extends Controller {

  public function __construct( $container ) {
    parent::__construct( $container );
    $this->view->setTemplatePath('app/Modules/Shorts/views/');
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
      $element = Short::create([
        'name' => htmlspecialchars($request->getParam('name')),
        'text' => htmlspecialchars($request->getParam('text')),
        'art' => htmlspecialchars($request->getParam('art')),
      ]);
      
    } catch (QueryException $e) {

      $this->flash->addMessage('error', $e->getMessage());
      return $response->withRedirect($this->router->pathFor('admin.short.add'));
    }

    return $response->withRedirect($this->router->pathFor('admin.short.edit', ['id' => $element->id]));
  }




  public function getEdit( $request, $response ) {
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    return $this->view->render($response, 'inner.phtml', ['data' => $data]);
  }

  public function postEdit( $request, $response ) {
    $route = $request->getAttribute('route');
    $argument = $route->getArguments()['id'];

    try {
      Short::find($argument)
        ->update([
          'name' => htmlspecialchars($request->getParam('name')),
          'text' => htmlspecialchars($request->getParam('text')),
          'art' => htmlspecialchars($request->getParam('art')),
        ]);
        
    } catch (QueryException $e) {
      $this->flash->addMessage('error', $e->getMessage());
    }

    return $response->withRedirect($this->router->pathFor('admin.short.edit', ['id' => $argument]));
  }



  public function postDelete( $request, $response ) {

    $id = $request->getParsedBody()['id'];
    Short::find($id)->delete();

    return $id;
  }

}
