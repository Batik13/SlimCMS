<?

namespace App\Breadcrumbs;

use App\Functions\Functions as f;

class Breadcrumbs {

  public function get( $breadcrumbs ) {
    $items;

    $numItems = count($breadcrumbs['left']);
    $i = 0;
    foreach ($breadcrumbs['left'] as $key => $value) {
      if (++$i === $numItems) {
        $items .= '
          <li class="breadcrumb-item">'. $key .'</li>';
      } 
      else {
        $items .= '
          <li class="breadcrumb-item">
            <a href="'. $value .'">'. $key .'</a>
          </li>';
      }
    }

    if ($breadcrumbs['right']) {
      $numItems = count($breadcrumbs['right']);
      foreach ($breadcrumbs['right'] as $key => $value) {
        $items .= '
          <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
              <a class="btn" href="'. $value .'">'. $key .'</a>
            </div>
          </li>';
      }
    }
    

    return f::fillTemplate($this->template()[0], [
      "items" => $items
    ]);
  }

    


  public function last( $data, $tableName ) {
    $lastCrumb;

    $route = $data->request->getAttribute('route');
    $argument = $route->getArguments();

    if (!$argument) {
      $lastCrumb = 'Новый';
    }
    else {
      $lastCrumb = $data->app->db->table($tableName)->find($argument)->name;
    }

    return $lastCrumb;
  }
  

  function template() {
    return [
      '<ol class="breadcrumb">{{items}}</ol>',
    ];
  }

}
