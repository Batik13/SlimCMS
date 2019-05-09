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
              imageTitle: {
                specificAltField: true,
              },
              toolbar: [
                  [\'style\', [\'style\']],
                  [\'font\', [\'bold\', \'italic\', \'underline\', \'clear\']],
                  [\'fontname\', [\'fontname\']],
                  [\'color\', [\'color\']],
                  [\'para\', [\'ul\', \'ol\', \'paragraph\']],
                  [\'table\', [\'table\']],
                  [\'insert\', [\'link\', \'image\', \'video\']],
                  [\'view\', [\'fullscreen\', \'codeview\']],
                  [\'insert\', [\'picture\', \'gallery\']],
                ],
                placeholder: \'enter directions here...\',
                height: 150,
                callbacks: {
                  onImageUpload: function(files, editor, welEditable) {
                    for (var i=files.length-1; i>=0; i--) {
                      sendFile(files[i], this);
                    }
                  },
                  onInit: function() {
                    $(this).data(\'image_dialog_images_url\', vars.get(\'path\').plugins + "summernote/img-template.php?path="+vars.get(\'path\').root);
                    $(this).data(\'image_dialog_title\', "Галерея изображений");
                    $(this).data(\'image_dialog_close_btn_text\', "Отмена");
                    $(this).data(\'image_dialog_ok_btn_text\', "Принять");
                  }
                }
              });

              function sendFile(file, el) {
                var form_data = new FormData(), moduleName;
                form_data.append(\'file\', file);

                moduleName = document.location.href.match(/admin\/[a-z]+\//gm)[0].split(\'/\')[1];

                $.ajax({
                  data:form_data,
                  type: "POST",
                  url: vars.get(\'path\').plugins + \'summernote/editor-upload.php?path=\' + vars.get(\'path\').root + \'&moduleName=\' + moduleName,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function(url) {
                    console.log("Файл успешно загружен на сервер...");
                  }
                });
              }

          });
        </script>';
    }

    return $str;
  }

}