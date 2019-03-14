<?

namespace App\Source\ModelFieldBuilder;

class SelectField extends AField{

  public function __construct( $obj ) {
    parent::__construct($obj);
  }

  public function __toString() {
    $options = '<option value="">Выберите поле</option>';
    $values = explode(';', $this->obj->values);

    foreach ($values as $value) {
      $element = explode(':', $value);
      $options .= sprintf('<option value="%1$s">%2$s</option>', $element[0], $element[1]);
    }

    $format = '
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="%1$s">%2$s</label>
            <select class="form-control select" name="%1$s" id="%1$s" value="%3$s">
              %5$s
            </select>
            <div><small>%4$s</small></div>            
          </div>
        </div>
      </div>';

    return sprintf($format, $this->obj->code, $this->obj->name, $this->obj->value, $this->obj->description, $options);
  }

}