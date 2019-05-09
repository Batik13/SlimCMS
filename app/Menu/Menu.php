<?

namespace App\Menu;

use App\Functions\Functions as f;
use App\Modules\Pages\Models\Page;

class Menu {

  protected $data;
  protected $mode;

  public function __construct( $data, $mode ) {
    $this->data = $data;
    $this->mode = $mode;
  }

  public function __toString() {
    $tempPath = $this->data->app->path['root'] . $this->data->app->path['view'] . 'public/'. $this->data->app->settings['public']['template'] .'/';
    $itemFormat;
    $items;

    switch ($this->mode) {
      case 'footer1':
        $itemFormat = '<li><a href="%1$s">%2$s</a></li>';
        break;

      case 'footer2':
        $itemFormat = '<li><a href="%1$s">%2$s</a></li>';
        break;
      
      default:
        $itemFormat = '<li class="main-nav__item"><a class="main-nav__link" href="%1$s">%2$s</a></li>';
        break;
    }

    foreach (Page::where('art', 'like', '%' . $this->mode . '%')
              ->where('publish', '1')
              ->orderBy('sort', 'desc')
              ->get() as $value) {

      $url = $this->data->app->router->pathFor('page', ['slug' => $value->url]);
      $items .= sprintf($itemFormat, $url, $value->name);
    }

    return $items;
  }

}