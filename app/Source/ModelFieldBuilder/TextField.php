<?

namespace App\Source\ModelFieldBuilder;

class TextField extends AField{

  public function __construct( $obj ) {
    parent::__construct($obj);
  }

  public function __toString() {
    $format = '
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="%1$s">%2$s</label>
            <input class="form-control" id="%1$s" type="text" name="%1$s" value="%3$s">
            <div><small>%4$s</small></div>
          </div>
        </div>
      </div>';

    return sprintf($format, $this->obj->code, $this->obj->name, $this->obj->value, $this->obj->description);
  }

}