$(function(){

  // base64 convert to blob

  function b64toBlob(b64Data, contentType, sliceSize) {
    contentType = contentType || '';
    sliceSize = sliceSize || 512;

    var byteCharacters = atob(b64Data);
    var byteArrays = [];

    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
      var slice = byteCharacters.slice(offset, offset + sliceSize);

      var byteNumbers = new Array(slice.length);
      for (var i = 0; i < slice.length; i++) {
        byteNumbers[i] = slice.charCodeAt(i);
      }

      var byteArray = new Uint8Array(byteNumbers);

      byteArrays.push(byteArray);
    }

    var blob = new Blob(byteArrays, {type: contentType});
    return blob;
  }




  // file change

  $('#file').on('change', function(){

    var file = $(this)[0].files[0];

    var reader = new FileReader();
    reader.readAsDataURL(file);

    reader.onload = function () {
      /*var fileData = reader.result,
          parts, type, base64Data;
      parts = fileData.split(',');
      type = parts[0];
      base64Data = parts[1];
      type = type.split(';')[0].split(':')[1];
      blobImage = b64toBlob(base64Data, type);*/

      $('#fileHidden').val(reader.result)
    };

    reader.onerror = function (error) {
      return 'Not file!';
    };

  });


  // form submit

  $('#feedback').submit(function() {
    $(this).ajaxSubmit({
      method: 'POST',
      beforeSubmit : function(arr, $form, options){
        // arr.push({name: 'file4234', value: blobImage});
      },
      success: function( data ) {
        if (data) {
          alert('Ваша заявка принята!');
          window.location.reload();
        }
        else {
          console.log("Error send message...");
        }        
      },
    });

    return false;
  });


  // fixed menu

  $(window).on('scroll', function () {
    if ($(window).scrollTop() > 100) {
      $('#header').addClass('page-header--fixed');
    } else {
      $('#header').removeClass('page-header--fixed');
    }
  });

  if ($(window).scrollTop() > 100) {
    $('#header').addClass('page-header--fixed');
  } else {
    $('#header').removeClass('page-header--fixed');
  }
  

});