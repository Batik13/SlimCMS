<?

namespace App\Source\ModelFieldBuilder;

class HiddenField extends AField{

  public function __construct( $obj ) {
    parent::__construct($obj);
  }

  public function __toString() {
    $format = '<input class="form-control" type="hidden" name="%1$s" value="%2$s">';
    return sprintf($format, $this->obj->code, $this->obj->value);
  }

}