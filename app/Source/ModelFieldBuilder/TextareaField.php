<?

namespace App\Source\ModelFieldBuilder;

class TextareaField extends AField{

  public function __construct( $obj ) {
    parent::__construct($obj);
  }

  public function __toString() {
    $format = '
      <div class="form-group">
        <label for="%1$s">%2$s</label>
        <textarea class="form-control" id="%1$s" name="%1$s" rows="7">%3$s</textarea>
        <div><small>%4$s</small></div>
      </div>';

    $format .= $this->pluginEditor();

    return sprintf($format, $this->obj->code, $this->obj->name, $this->obj->value, $this->obj->description);
  }

  function pluginEditor() {
    $str;
    if ($this->obj->values == 'codemirror') {
      $str = '
        <script>
          $(document).ready( function () {
            CodeMirror.fromTextArea(document.getElementById(\''. $this->obj->code .'\'), {
              // lineNumbers: true,
              theme: "monokai",
              mode: "text/html",
              tabSize: 2,
              height: 200,
            });
          });
        </script>';
    }

    if ($this->obj->values == 'summernote') {
      $str = '
        <script>
          $(document).ready( function () {
            $(\'#'. $this->obj->code .'\').summernote({
              lang: \'ru-RU\',
              height: 150
            });
          });
        </script>';
    }

    return $str;
  }

}