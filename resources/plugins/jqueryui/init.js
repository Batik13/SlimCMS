$(document).ready( function () {
  var wrapModal, dialog, $data = {};
  
  dialog = $( "#modal-feedback" ).dialog({
    autoOpen: false,
    height: 'auto',
    closeText: "Закрыть",
    width: 400,
    modal: true,
    appendTo: "#wrap-dialog",
    open: function( event, ui ) {
      wrapModal = $(this).closest('[role=dialog]').addClass('wrapModal');
    },
    buttons: {
      'Отправить': function() {

        dialog.find( "form" ).find('input, textearea, select').each(function() {
          $data[this.name] = $(this).val();
        });

        $.ajax({
          url: $data.action,
          type: "POST",
          data: "csrf_name="+$data.csrf_name+"&csrf_value="+$data.csrf_value+"&data="+ JSON.stringify($data),
          success: function(data){

            alert('Ваша заявка принята!');
            dialog.dialog( "close" );

            window.location.reload();
          }
        });

      },
    },
    close: function() {}
  });

  $( ".btn-modal" ).button().on( "click", function() {
    dialog.dialog( "open" );
  });

});