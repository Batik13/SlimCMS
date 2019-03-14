<?

namespace App\Plugins;

use App\Plugins\Plugin;

class ManagerPlugin extends Plugin {

  public function addCss() {
    $links;

    foreach ($this->container->get('settings')['plugins'] as $key => $value) {
      if ($this->pluginsList()[$key]) {
        foreach ($this->pluginsList()[$key]['css'] as $cssPath) {
          if ($cssPath) {
            $url = $this->container->request->getUri()->getPath();
            $pos = strpos($url, "admin");

            if ($pos !== false) {
              if (!empty($value['admin'])) {
                if ($this->filter($value['admin'])) {
                  $links .= '<link rel="stylesheet" type="text/css" href="'. $cssPath .'">';
                }
              }
            }
            else {
              if (!empty($value['public'])) {
                if ($this->filter($value['public'])) {
                  $links .= '<link rel="stylesheet" type="text/css" href="'. $cssPath .'">';
                }
              }
              
            }
          }
        }
      }
    }

    return $links;
  }

  public function addJs() {
    $scripts;

    foreach ($this->container->get('settings')['plugins'] as $key => $value) {
      if ($this->pluginsList()[$key]) {
        foreach ($this->pluginsList()[$key]['js'] as $jsPath) {
          if ($jsPath) {
            $url = $this->container->request->getUri()->getPath();
            $pos = strpos($url, "admin");

            if ($pos !== false) {
              if (!empty($value['admin'])) {
                if ($this->filter($value['admin'])) {
                  $scripts .= '<script type="text/javascript" charset="utf8" src="'. $jsPath .'"></script>';
                }
              }
            }
            else {
              if (!empty($value['public'])) {
                if ($this->filter($value['public'])) {
                  $scripts .= '<script type="text/javascript" charset="utf8" src="'. $jsPath .'"></script>';
                }
              }
            }
            
          }          
        }
      }
    }

    return $scripts;
  }


  function filter( $pages ) {
    $result = false; 

    $currentPage = $this->container->request->getUri()->getPath();
    $listPages = explode(',', $pages);

    for ($i=0; $i < count($listPages); $i++) {
      if (strpos($currentPage, $listPages[$i]) !== false) {
        $result = true;
        break;
      }
    }

    if ($listPages[0] === 'all') {
      $result = true;
    }

    return $result;
  }

}
