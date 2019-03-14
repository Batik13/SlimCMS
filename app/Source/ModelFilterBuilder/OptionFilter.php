<?

namespace App\Source\ModelFilterBuilder;

use App\Modules\Options\Models\Option;

class OptionFilter extends AFilter{

  public function __construct($content, $short) {
    parent::__construct($content, $short);
  }

  public function __toString() {
    $text = Option::find($this->short[1])->value;

    return str_replace($this->short[2], $text, $this->content);
  }

  public static function get( $id, $mode=false ) {
    $result = Option::find($id)->value;

    if ($mode) {
      $result = self::mode($mode, $result);
    }

    return $result;
  }

  public static function code( $code ) {
    return Option::where('code', $code)->take(1)->get()[0]->value;
  }

}