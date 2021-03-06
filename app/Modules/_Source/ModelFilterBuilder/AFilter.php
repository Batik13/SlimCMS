<?

namespace App\Modules\_Source\ModelFilterBuilder;

class AFilter {

  protected $container;
  protected $content;
  protected $shortcode;
  protected $short;

  public function __construct( $content, $short, $container ) {
    $this->container = $container;
    $this->content = $content;
    $this->short = $short;

    $this->shortcode = '{{';
    for ($i=0; $i<count($short); $i++) {
      $separator = ($i == count($short)-1) ? '' : ' ';
      $this->shortcode .= $short[$i] . $separator;
    }
    $this->shortcode .= '}}';    
  }

  public static function mode( $mode, $result ) {
    switch ($mode) {
      case 'src':
        $result = self::src($result);
        break;
      case 'clear':
        $result = self::clear($result);
        break;      
      default:
        break;
    }

    return $result;
  }

  public static function test( $value ) {

    die($value);

    return $value;
  }

  public static function src( $result ) {
    return self::between( 'src="', '"', $result);
  }

  public static function clear( $result ) {
    return preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $result);
  }

  static function between( $after, $before, $string ) {
    return self::before($before, self::after($after, $string));
  }

  static function after( $after, $string ) {
    if (!is_bool(strpos($string, $after))) {
      return substr($string, strpos($string, $after) + strlen($after));
    }
  }

  static function before( $before, $string ) {
    return substr($string, 0, strpos($string, $before));
  }

}