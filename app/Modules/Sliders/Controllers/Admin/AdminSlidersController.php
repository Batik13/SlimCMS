<?

namespace App\Modules\Sliders\Controllers\Admin;

use App\Modules\Sliders\Models\Slider;
use App\Modules\Options\Models\Option;
use Illuminate\Database\QueryException;
use App\Controllers\Controller;

class AdminSlidersController extends Controller {

  public function __construct( $container ) {
    parent::__construct( $container );
    $this->view->setTemplatePath('app/Modules/Sliders/views/');
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
      $element = Slider::create([
        'publish' => htmlspecialchars($request->getParam('publish')),
        'img' => htmlspecialchars($request->getParam('img')),
        'name' => htmlspecialchars($request->getParam('name')),
        'text' => htmlspecialchars($request->getParam('text')),
        'btn' => htmlspecialchars($request->getParam('btn')),
        'href' => htmlspecialchars($request->getParam('href')),
        'art' => htmlspecialchars($request->getParam('art')),
      ]);
      
    } catch (QueryException $e) {

      $this->flash->addMessage('error', $e->getMessage());
      return $response->withRedirect($this->router->pathFor('admin.slider.add'));
    }

    return $response->withRedirect($this->router->pathFor('admin.slider.edit', ['id' => $element->id]));
  }




  public function getEdit( $request, $response ) {
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    return $this->view->render($response, 'inner.phtml', ['data' => $data]);
  }

  public function postEdit( $request, $response ) {
    $route = $request->getAttribute('route');
    $argument = $route->getArguments()['id'];

    try {
      Slider::find($argument)
        ->update([
          'publish' => htmlspecialchars($request->getParam('publish')),
          'img' => htmlspecialchars($request->getParam('img')),
          'name' => htmlspecialchars($request->getParam('name')),
          'text' => htmlspecialchars($request->getParam('text')),
          'btn' => htmlspecialchars($request->getParam('btn')),
          'href' => htmlspecialchars($request->getParam('href')),
          'art' => htmlspecialchars($request->getParam('art')),
        ]);
        
    } catch (QueryException $e) {
      $this->flash->addMessage('error', $e->getMessage());
    }

    return $response->withRedirect($this->router->pathFor('admin.slider.edit', ['id' => $argument]));
  }



  public function postDelete( $request, $response ) {

    $id = $request->getParsedBody()['id'];
    Slider::find($id)->delete();

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

    return $response->withRedirect($this->router->pathFor('admin.slider.settings'));
  }

}
