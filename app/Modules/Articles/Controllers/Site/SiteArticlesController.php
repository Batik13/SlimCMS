<?

namespace App\Modules\Articles\Controllers\Site;

use App\Modules\Articles\Models\Article;
use App\Modules\Options\Models\Option;
use Illuminate\Database\QueryException;
use App\Controllers\Controller;

class SiteArticlesController extends Controller {

  public function __construct( $container ) {
    parent::__construct( $container );
  }

  public function inner( $request, $response ) {
    $route = $request->getAttribute('route');
    $slug = $route->getArguments()['slug'];

    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];
    $data->moduleName = Article::getName()[0];
    $data->model = Article::where('href', '=', $slug)->get()[0];

    return $this->view->render($response, 'public/articles_product.phtml', ['data' => $data]);
  }

  public function ajax( $request, $response ) {
    return true;
  }

  public function pagination( $request, $response ) {
    $route = $request->getAttribute('route');
    $slug = $route->getArguments()['slug'];
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];

    return $this->view->render($response, 'public/articles.phtml', ['data' => $data]);
  }

  public function category( $request, $response ) {
    $route = $request->getAttribute('route');
    $slug = $route->getArguments()['slug'];
    $data = (object) ['app' => $this, 'request' => $request, 'response' => $response];

    return $this->view->render($response, 'public/articles_category.phtml', ['data' => $data]);
  }

  public function product( $request, $response ) {
    return true;
  }

  public function search( $request, $response ) {
    return true;
  }

}