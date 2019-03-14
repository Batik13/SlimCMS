<?

namespace App\Controllers\Admin;

use App\Modules\Options\Models\Option;
use App\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller {

  public function home($request, $response) {
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    return $this->view->render($response, 'admin/templates/home.phtml', ['data' => $data]);
  }

  public function getSettings($request, $response) {
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    return $this->view->render($response, 'admin/templates/settings.phtml', ['data' => $data]);
  }

  public function postSettings($request, $response) {
    try {
      Option::updateDynamicField($request);
    }
    catch (QueryException $e) {
      $this->flash->addMessage('error', $e->getMessage());
    }

    return $response->withRedirect($this->router->pathFor('admin.settings'));
  }
}
