<?

namespace App\Modules\Shorts\ModelFilterBuilder;

use App\Modules\_Source\ModelFilterBuilder\AFilter;
use App\Modules\Shorts\Models\Short;

class ShortFilter extends AFilter{

  public function __construct($content, $short, $container) {
    parent::__construct($content, $short, $container);
  }

  public function __toString() {
    $text = htmlspecialchars_decode(Short::find($this->short[1])->text);
    return str_replace($this->shortcode, $text, $this->content);
  }

  public static function get( $id, $mode=false ) {
    $result = htmlspecialchars_decode(Short::find($id)->text);

    if ($mode) {
      $result = self::mode($mode, $result);
    }

    return $result;
  }

}