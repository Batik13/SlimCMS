<?

namespace App\Menu;

use App\Functions\Functions as f;
use App\Modules\Pages\Models\Page;

class Menu {

  protected $data;

  public function __construct( $data ) {
    $this->data = $data;
  }

  public function __toString() {
    $items;
    foreach (Page::where('art', '=', 'inner')->get() as $value) {
      $url = $this->data->app->router->pathFor('page', ['slug' => $value->url]);
      $items .= '<li><a href="'. $url .'">'. $value->name .'</a></li>';
    }

    return sprintf('<ul>%1$s</ul>', $items);
  }

}