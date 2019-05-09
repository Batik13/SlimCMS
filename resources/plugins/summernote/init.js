$(document).ready( function () {
  $('.summernote').summernote({
    lang: 'ru-RU',
    imageTitle: {
      specificAltField: true,
    },
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'image', 'video']],
        ['view', ['fullscreen', 'codeview']],
        ['insert', ['picture', 'gallery']],
      ],
      placeholder: 'enter directions here...',
      height: 150,
      callbacks: {
        onImageUpload: function(files, editor, welEditable) {
          for (var i=files.length-1; i>=0; i--) {
            sendFile(files[i], this);
          }
        },
        onInit: function() {
          $(this).data('image_dialog_images_url', vars.get('path').plugins + "summernote/img-template.php?path="+vars.get('path').root);
          $(this).data('image_dialog_title', "Галерея изображений");
          $(this).data('image_dialog_close_btn_text', "Отмена");
          $(this).data('image_dialog_ok_btn_text', "Принять");
        }
      }
    });

    function sendFile(file, el) {
      var form_data = new FormData(), moduleName;
      form_data.append('file', file);

      moduleName = document.location.href.match(/admin\/[a-z]+\//gm)[0].split('/')[1];

      $.ajax({
        data:form_data,
        type: "POST",
        url: vars.get('path').plugins + 'summernote/editor-upload.php?path=' + vars.get('path').root + '&moduleName=' + moduleName,
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
          console.log("Файл успешно загружен на сервер...");
        }
      });
    }

});