<?

namespace App\Source\ModelFilterBuilder;

use App\Modules\Shorts\Models\Short;

class ShortFilter extends AFilter{

  public function __construct($content, $short) {
    parent::__construct($content, $short);
  }

  public function __toString() {
    $text = Short::find($this->short[1])->text;
    return str_replace($this->short[2], $text, $this->content);
  }

  public static function get( $id, $mode=false ) {
    $result = Short::find($id)->text;

    if ($mode) {
      $result = self::mode($mode, $result);
    }

    return $result;
  }

}