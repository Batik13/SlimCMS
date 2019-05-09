<?

namespace App\Functions;

class Functions {

  protected $container;

  public function __construct( $container ) {
    $this->container = $container;
    $_SESSION['root'] = $this->request_url();
  }
  
  /**
   * Преобразует шорткоды из шаблона
   *
   * @param string $tpl шаблон
   * @param array $values массив шорткодов 
   * @return string $tpl отфильтрованный шаблон
   */
  public function fillTemplate( $tpl, $values ) {
    foreach ($values as $key => $val) {
      $tpl = str_replace('{{' . $key . '}}', $val, $tpl);
    }

    return $tpl;
  }

  public function getMode( $request ) {
    $route = $request->getAttribute('route');
    $argument = $route->getArguments()['id'];

    if ($argument) {
      return ['edit', $argument];
    }

    return ['add'];
  }

  public function autocomplete( $model, $field ) {
    $result;
    foreach ($model::distinct()->get([$field]) as $value) {
      $result .= "'".$value->{$field} . "',";
    }
    $result = substr($result, 0, -1);

    return $result;
  }

  public function currentModule( $path ) {
    $moduleName = array_reverse(explode(DIRECTORY_SEPARATOR, pathinfo($path)['dirname']))[0];
    return $moduleName;
  }

  public static function root() {
    return $_SESSION['root'];
  }

  public function request_url() {
    $result = '';
    $default_port = 80;
    
    // https:/site.ru/
    // http://localhost/site.ru/
    
    $rootPath = $this->container->request->getUri()->getBasePath();
    if (!$rootPath) {
      
      if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
        $result .= 'https://';
        $default_port = 443;
      }
      else {
        $result .= 'http://';
      }

      $result .= $_SERVER['SERVER_NAME'];
      if ($_SERVER['SERVER_PORT'] != $default_port) {
        $result .= ':'.$_SERVER['SERVER_PORT'];
      }
      // $result .= $_SERVER['REQUEST_URI'];

      $rootPath = $result;
    }
    
    return $rootPath . '/';
  }

  public static function convert( $value, $mode ) {
    $cyr  = array('а','б','в','г','д','е', 'ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ь', 'э', 'ы', 'ю','я','А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ь','Э','Ы','Ю','Я',' ', ',', '.', '/', '(', ')','«','»');
    $lat = array('a','b','v','g','d','e','jo','zh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','ts','ch','sh','sht','','','je','ji','yu','ya','A','B','V','G','D','E','Jo','Zh','Z','I','Y','K','L','M','N','O','P','R','S','T','U','F','H','Ts','Ch','Sh','Sht','','','Je','Ji','Yu','Ya','-','', '', '-', '', '','-','-');

    if ($mode === "ru_en") {
      $value = str_replace($cyr, $lat, $value);
    }

    if ($mode === "en_ru") {
      $value = str_replace($lat, $cyr, $value);
    }

    return $value;
  }
  

}