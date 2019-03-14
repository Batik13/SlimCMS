<?

namespace App\Functions;

class Functions {

  protected $container;

  public function __construct( $container ) {
    $this->container = $container;
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

}